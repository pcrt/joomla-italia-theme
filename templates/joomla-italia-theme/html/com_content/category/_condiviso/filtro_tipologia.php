<?php

/**
 * Filtro "Tipologia" delle pagine di categoria — versione accessibile.
 *
 * Si aspetta:
 *   $filtroTipologiaVoci  array di categorie (oggetti con id, title, language)
 *   $catactive            titolo della categoria attualmente aperta
 *
 * PERCHE' SONO COLLEGAMENTI E NON RADIO
 * Prima questo filtro usava <input type="radio" onchange="window.open(...)">.
 * In un gruppo di radio la tastiera si sposta con le frecce direzionali, e con
 * quell'onchange ogni spostamento faceva cambiare pagina: chi naviga da tastiera
 * non riusciva mai a raggiungere la seconda opzione (violazione WCAG 2.1 - 3.2.2
 * "On Input"). Quel markup aveva inoltre un "name" diverso per ogni radio (quindi
 * non erano nemmeno un gruppo), "id" contenenti spazi (HTML non valido, 4.1.1) e
 * il titolo della categoria stampato senza escape.
 *
 * Selezionare una tipologia porta a un'altra pagina: il controllo corretto e'
 * quindi un collegamento. Funziona da tastiera, funziona senza JavaScript e
 * comunica la pagina corrente con aria-current.
 *
 * NB: qui i nomi delle classi sono COMPLETI perche' le istruzioni "use" valgono
 * solo nel file in cui sono scritte e un file incluso non le eredita.
 */
defined('_JEXEC') or die;

$filtroTipologiaVoci = $filtroTipologiaVoci ?? [];
$filtroTipologiaAttiva = $catactive ?? null;
?>
<ul class="filtro-tipologia">
    <?php foreach ($filtroTipologiaVoci as $filtroVoce) : ?>
        <?php $filtroAttivo = ($filtroTipologiaAttiva !== null && $filtroTipologiaAttiva === $filtroVoce->title); ?>
        <li class="catsamelevel my-0">
            <a class="filtro-tipologia-link<?php echo $filtroAttivo ? ' is-active' : ''; ?>"
               href="<?php echo \Joomla\CMS\Router\Route::_(\Joomla\Component\Content\Site\Helper\RouteHelper::getCategoryRoute($filtroVoce->id, $filtroVoce->language)); ?>"
               <?php echo $filtroAttivo ? 'aria-current="page"' : ''; ?>><?php echo $this->escape($filtroVoce->title); ?></a>
        </li>
    <?php endforeach; ?>
</ul>
