<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app   = Factory::getApplication();
$input = $app->getInput();
$wa    = $this->getWebAssetManager();
$menu  = $app->getMenu()->getActive();
$isHomePage = ($menu->home);
$credits = '<a href="https://www.protocollicreativi.it" target="_blank" rel="nofollow" title="Protocolli Creativi is a Joomla Provider">Made with love Italia Theme for Joomla by Protocolli Creativi</a>';
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

$this->setMetaData('viewport', 'width=device-width, initial-scale=1, minimum-scale=1');
$this->setMetaData('theme-color', '#ffffff');

// Favicon: quella impostata nei parametri del template (issue #60) o quella predefinita di Joomla
require __DIR__ . '/includes/favicon.php';

$wa->registerAndUseStyle('template.css.editor', 'media/templates/site/joomla-italia-theme/css/editor.css');

$wa->usePreset('template.joomla-italia-theme')
	 ->useStyle('css.fontawesome')
	 ->useStyle('css.fonts')
	 ->useStyle('template.css.pcrt-main')
	 ->useStyle('template.css.pcrt-menu')
	 ->useStyle('template.css.pcrt-jit')
	 ->useStyle('css.table')
	 ->useScript('template.js.jquery362');

// user.css e user.js del sito, se esistono (issue #47)
require __DIR__ . '/includes/user_assets.php';
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
