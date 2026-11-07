<?php

/**
 * CSS e JavaScript personalizzati del sito (issue #47).
 *
 * Se esistono, carica media/templates/site/joomla-italia-theme/css/user.css e js/user.js
 * dopo tutti gli asset del tema. I due file non fanno parte del pacchetto: gli aggiornamenti
 * del tema non li toccano. Richiamato da index.php, component.php, error.php e offline.php.
 *
 * Variabile attesa: $wa (il WebAssetManager del documento).
 */

defined('_JEXEC') or die;

$userAssetsDir = 'media/templates/site/joomla-italia-theme/';

if (is_file(JPATH_ROOT . '/' . $userAssetsDir . 'css/user.css')) {
    $wa->registerAndUseStyle('template.css.user', $userAssetsDir . 'css/user.css', ['version' => 'auto']);
}

if (is_file(JPATH_ROOT . '/' . $userAssetsDir . 'js/user.js')) {
    $wa->registerAndUseScript('template.js.user', $userAssetsDir . 'js/user.js', ['version' => 'auto'], ['defer' => true]);
}
