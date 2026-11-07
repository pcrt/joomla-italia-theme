<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Menu principale del tema (Bootstrap Italia): tendine a più livelli e, per le voci di
 * primo livello con classe CSS "megamenu", una tendina a colonne.
 *
 * Issue #89: la vecchia versione gestiva il megamenu con contatori separati dal resto del
 * ciclo e non prevedeva voci di terzo livello dentro il megamenu: quelle voci sparivano, la
 * colonna veniva chiusa prima del tempo e tutte le voci successive del menu finivano dentro
 * la tendina rotta (nel sito si vedeva solo la prima voce). Ora il ciclo segue le proprietà
 * deeper/shallower/level_diff che Joomla calcola per ogni voce, come nel layout del core,
 * e il megamenu aggiunge soltanto le colonne al secondo livello.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu.min.js', [], ['type' => 'module']);
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu-es5.min.js', [], ['nomodule' => true, 'defer' => true]);

$id = '';

if ($tagId = $params->get('tag_id', '')) {
    $id = ' id="' . $tagId . '"';
}

// Numero di figli diretti di ogni voce: serve al megamenu per dividere le voci in colonne.
$figli = [];

foreach ($list as $item) {
    $figli[$item->parent_id] = ($figli[$item->parent_id] ?? 0) + 1;
}

// Stato del megamenu che stiamo percorrendo: id della voce di primo livello (0 = nessuno),
// numero di figli diretti, quanti ne abbiamo già stampati e quante voci stanno in una colonna.
$megaId         = 0;
$megaTotale     = 0;
$megaStampati   = 0;
$megaPerColonna = 0;

// data-element della tendina di primo livello, per l'App di valutazione dei modelli.
$dataElementTendina = [
    'Scuola'    => 'school-submenu',
    'Servizi'   => 'services-submenu',
    'Didattica' => 'teaching-submenu',
    'Novità'    => 'news-submenu',
];

?>
<ul<?php echo $id; ?> class="navbar-nav <?php echo $class_sfx; ?>" data-element="menu">
<?php foreach ($list as $i => $item) :
    $itemParams = $item->getParams();
    $class      = 'nav-item item-' . $item->id;

    if ($item->id == $default_id) {
        $class .= ' default';
    }

    if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id)) {
        $class .= ' current';
    }

    if (in_array($item->id, $path)) {
        $class .= ' active';
    } elseif ($item->type === 'alias') {
        $aliasToId = $itemParams->get('aliasoptions');

        if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
            $class .= ' active';
        } elseif (in_array($aliasToId, $path)) {
            $class .= ' alias-parent-active';
        }
    }

    if ($item->type === 'separator') {
        $class .= ' divider';
    }

    if ($item->deeper) {
        $class .= ' deeper dropdown';
    }

    if ($item->parent) {
        $class .= ' parent';
    }

    if ($item->level == 1) {
        // Voce di primo livello: è un megamenu se ha la classe CSS "megamenu" e dei figli.
        $isMega = $item->deeper && in_array('megamenu', preg_split('/\s+/', trim((string) $item->anchor_css)), true);
        $megaId = $isMega ? (int) $item->id : 0;

        if ($isMega) {
            $megaTotale     = $figli[$item->id] ?? 0;
            $megaStampati   = 0;
            $megaPerColonna = $megaTotale <= 8 ? 4 : (int) ceil($megaTotale / 3);
            $class         .= ' level1 megamenu';
        }
    } elseif ($megaId) {
        $class .= ' level' . $item->level . ($item->anchor_css !== '' ? ' ' . $item->anchor_css : '');

        if ($item->level == 2) {
            // Secondo livello del megamenu: apre una nuova colonna ogni $megaPerColonna voci.
            if ($megaStampati > 0 && $megaStampati % $megaPerColonna === 0) {
                echo '</ul></div></div>';
            }

            if ($megaStampati % $megaPerColonna === 0) {
                $classeColonna = ($megaStampati === 0 && $megaTotale <= 8) ? ' pe-lg-5' : '';
                echo '<div class="col-12 col-lg-4' . $classeColonna . '"><div class="link-list-wrapper"><ul class="link-list">';
            }

            $megaStampati++;
        }
    }

    echo '<li class="' . $class . '">';

    switch ($item->type) :
        case 'separator':
        case 'component':
        case 'heading':
        case 'url':
            require ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
            break;

        default:
            require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
            break;
    endswitch;

    if ($item->deeper) {
        // La voce successiva è più profonda: si apre un elenco figlio.
        if ($item->level == 1) {
            if ($megaId) {
                echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown' . $item->id . '"><div class="row">';
            } else {
                $dataElement = $dataElementTendina[$item->title] ?? 'custom-submenu';
                echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown' . $item->id . '"><div class="link-list-wrapper"><ul class="link-list" data-element="' . $dataElement . '">';
            }
        } else {
            echo '<div><div class="link-list-wrapper"><ul class="link-list">';
        }
    } elseif ($item->shallower) {
        // La voce successiva è meno profonda: si chiude un elenco per ogni livello risalito.
        echo '</li>';

        for ($d = 0; $d < $item->level_diff; $d++) {
            $livelloChiuso = $item->level - $d;

            if ($megaId && $livelloChiuso == 2) {
                // Fine del megamenu: colonna, riga, tendina e voce di primo livello.
                echo '</ul></div></div></div></div></li>';
                $megaId = 0;
            } else {
                echo '</ul></div></div></li>';
            }
        }
    } else {
        // La voce successiva è allo stesso livello.
        echo '</li>';
    }
endforeach; ?>
</ul>
