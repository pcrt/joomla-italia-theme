<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$input = $app->getInput();
$wa = $this->getWebAssetManager();
$menu = $app->getMenu()->getActive();
$isHomePage = ($menu->home);
$credits = '<a href="https://www.protocollicreativi.it" target="_blank" rel="nofollow" title="Protocolli Creativi is a Joomla Provider">Made with love Joomla Italia Theme by Protocolli Creativi</a>';
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

$this->setMetaData('viewport', 'width=device-width, initial-scale=1, minimum-scale=1');
$this->setMetaData('theme-color', '#ffffff');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

$wa->registerAndUseStyle('template.css.editor', 'media/templates/site/joomla-italia-theme/css/editor.css');

$wa->usePreset('template.joomla-italia-theme')
     ->useStyle('css.fontawesome')
     ->useStyle('css.fonts')
     ->useStyle('template.css.pcrt-main')
     ->useStyle('template.css.pcrt-menu')
     ->useStyle('template.css.pcrt-jit')
     ->useStyle('css.table')
     ->useScript('template.js.jquery362');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
  <body class="<?php echo $pageclass ? htmlspecialchars($pageclass) : ''; ?>">
    <jdoc:include type="message" />
    <jdoc:include type="component" />
  </body>
</html>
