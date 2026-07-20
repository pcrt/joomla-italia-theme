<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Layout dedicato alla home (tema joomla-italia-theme), usato SOLO dal modulo
 * "[Home] Notizie, Circolari, eventi".
 *
 * Mostra SEMPRE una colonna per ogni categoria configurata nel modulo (anche se
 * vuota) e, per ognuna, i suoi ultimi articoli pubblicati (il piu recente per
 * primo). Interroga ogni categoria in modo indipendente: cosi le colonne non
 * dipendono dal conteggio "condiviso" del modulo e nessuna categoria puo sparire.
 *
 * Il "Numero di articoli" del modulo e' il TOTALE mostrato in home, distribuito a
 * giro fra le colonne da sinistra a destra: 3 = uno per colonna, 4 = due nella
 * prima e uno nelle altre, 6 = due per colonna. Se una categoria ha meno articoli
 * di quanti gliene toccherebbero, i posti avanzati vanno alle altre colonne.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\Database\ParameterType;

// Totale articoli da mostrare in home: il "Numero di articoli" del modulo
// (Opzioni ▸ Numero di articoli). Vengono distribuiti fra le colonne piu sotto.
$total = (int) $params->get('count', 3);

if ($total < 1) {
    $total = 3;
}

// Categorie da mostrare: quelle configurate nel modulo (Opzioni ▸ Categoria).
$catIds = array_values(array_filter(array_map('intval', (array) $params->get('catid', []))));

if (empty($catIds)) {
    return;
}

$introLimit = (int) $params->get('introtext_limit', 100);

// Ordinamento fisso: l'ultimo articolo pubblicato di ogni categoria per primo.
// Non segue "Ordinamento articoli" del modulo apposta: salvando il modulo dal
// pannello quel campo torna al default e la home perderebbe l'ordine voluto.
$orderCol = 'a.publish_up';
$orderDir = 'DESC';

$app    = Factory::getApplication();
$user   = $app->getIdentity();
$levels = $user->getAuthorisedViewLevels();
$now    = Factory::getDate()->toSql();
$langs  = [$app->getLanguage()->getTag(), '*'];

$db = Factory::getContainer()->get('DatabaseDriver');

// Titoli/lingua delle categorie (servono anche per le colonne vuote).
$query = $db->getQuery(true)
    ->select($db->quoteName(['id', 'title', 'language']))
    ->from($db->quoteName('#__categories'))
    ->whereIn($db->quoteName('id'), $catIds);
$db->setQuery($query);
$cats = $db->loadObjectList('id');

$columns = [];

foreach ($catIds as $cid) {
    if (!isset($cats[$cid])) {
        // categoria inesistente/eliminata: la salto
        continue;
    }

    // Ultimi articoli pubblicati e visibili di questa categoria, il piu recente per
    // primo. Ne prendo fino a $total: se le altre colonne sono vuote, questa da
    // sola puo doverli mostrare tutti.
    $query = $db->getQuery(true)
        ->select($db->quoteName(['a.id', 'a.title', 'a.alias', 'a.introtext', 'a.catid', 'a.language']))
        ->from($db->quoteName('#__content', 'a'))
        ->where($db->quoteName('a.catid') . ' = :cid')
        ->where($db->quoteName('a.state') . ' = 1')
        ->whereIn($db->quoteName('a.access'), $levels)
        ->whereIn($db->quoteName('a.language'), $langs, ParameterType::STRING)
        ->where('(' . $db->quoteName('a.publish_up') . ' IS NULL OR ' . $db->quoteName('a.publish_up') . ' <= :now1)')
        ->where('(' . $db->quoteName('a.publish_down') . ' IS NULL OR ' . $db->quoteName('a.publish_down') . ' >= :now2)')
        ->order($db->quoteName($orderCol) . ' ' . $orderDir)
        ->bind(':cid', $cid, ParameterType::INTEGER)
        ->bind(':now1', $now)
        ->bind(':now2', $now);
    $db->setQuery($query, 0, $total);
    $rows = $db->loadObjectList();

    $items = [];

    foreach ($rows as $row) {
        $lang = ($row->language === '*') ? 0 : $row->language;

        $it                   = new stdClass();
        $it->title            = $row->title;
        $it->active           = '';
        $it->link             = Route::_(RouteHelper::getArticleRoute($row->id . ':' . $row->alias, $row->catid, $lang));

        $text = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($row->introtext ?? ''), ENT_QUOTES, 'UTF-8')));

        if ($introLimit > 0 && mb_strlen($text) > $introLimit) {
            $text = mb_substr($text, 0, $introLimit) . '…';
        }

        $it->displayIntrotext = $text;

        $items[] = $it;
    }

    $catLang = ($cats[$cid]->language === '*') ? 0 : $cats[$cid]->language;

    $columns[] = [
        'title' => $cats[$cid]->title,
        'route' => Route::_(RouteHelper::getCategoryRoute($cid, $catLang)),
        'pool'  => $items,
        'items' => [],
    ];
}

// Ordino le colonne per titolo (Circolari, Eventi, Notizie): l'ordine finale delle
// colonne deve essere gia deciso qui, perche la distribuzione va da sinistra a destra.
usort($columns, static function ($a, $b) {
    return strcmp(Text::_($a['title']), Text::_($b['title']));
});

// Distribuzione a giro: un articolo per colonna da sinistra a destra, poi si
// ricomincia, finche non ho piazzato $total articoli o non ne restano piu.
// Le colonne senza articoli vengono semplicemente saltate, cosi i posti che
// avanzano finiscono alle altre.
$remaining = $total;

while ($remaining > 0) {
    $roundPlaced = false;

    foreach ($columns as $i => $column) {
        if ($remaining < 1) {
            break;
        }

        if (empty($columns[$i]['pool'])) {
            continue;
        }

        $columns[$i]['items'][] = array_shift($columns[$i]['pool']);
        $remaining--;
        $roundPlaced = true;
    }

    // Nessuna colonna aveva piu articoli: ho finito il materiale, esco.
    if (!$roundPlaced) {
        break;
    }
}

?>
<div class="container mod-news pt-4 pb-5">
<?php if ((bool) $module->showtitle) : ?>
    <div class="title-section pb-4">
        <h2><?php echo $module->title; ?></h2>
    </div>
<?php endif; ?>
    <div class="row">
        <?php foreach ($columns as $column) : ?>
            <?php $items = $column['items']; ?>
            <div class="col-12 col-lg-4">
                <div class="title-section">
                    <h2><?php echo Text::_($column['title']); ?></h2>
                </div>
                <?php if (!empty($items)) : ?>
                    <?php require ModuleHelper::getLayoutPath('mod_articles_category', 'news_gruppi'); ?>
                <?php endif; ?>
                <a href="<?php echo $column['route']; ?>" title="Vai alla pagina <?php echo Text::_($column['title']); ?>" class="view-all d-block py-3"><strong>Vedi tutti</strong></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
