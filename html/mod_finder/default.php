<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_finder
 * @author  	web-eau.net
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Module\Finder\Site\Helper\FinderHelper;
use Joomla\CMS\Uri\Uri;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

$lang = $app->getLanguage();
$lang->load('com_finder', JPATH_SITE);

echo '<div class="it-search-wrapper mod-finder_nolightbox">';


$input = '<input type="text" name="q" id="mod-finder-searchword' . $module->id . '" class="p-3 shadow-4 js-finder-search-query form-control" value="' . htmlspecialchars($app->input->get('q', '', 'string'), ENT_COMPAT, 'UTF-8') . '"'
    . ' placeholder="Cerca nel sito..." aria-label="Search" />';

$showLabel  = $params->get('show_label', 1);
$labelClass = (!$showLabel ? 'visually-hidden ' : '') . 'finder';
$label      = '<label for="mod-finder-searchword' . $module->id . '" class="text-center text-whit pt-4 d-none d-sm-block h4 ' . $labelClass . '">' . $params->get('alt_label', Text::_('JSEARCH_FILTER_SUBMIT')) . '</label>';

$output = '';

if ($params->get('show_button', 0)) {
    $output .= $label;
    $output .= '<div class="mod-finder__search input-group ">';
    $output .= $input;
    $output .= '<div class="input-group-append">
                    <button class="btn" type="submit" aria-label="'. Text::_('JSEARCH_FILTER_SUBMIT').'">
                        <svg class="icon icon-sm">
                            <use href="' . $baseImagePath . 'sprites.svg#it-search"></use>
                        </svg>
                    </button>
                </div>';
    $output .= '</div>';
} else {
    $output .= $label;
    $output .= $input;
}

Text::script('MOD_FINDER_SEARCH_VALUE', true);

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('com_finder');

/*
 * This segment of code sets up the autocompleter.
 */
if ($params->get('show_autosuggest', 1)) {
    $wa->usePreset('awesomplete');
    $app->getDocument()->addScriptOptions('finder-search', array('url' => Route::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component')));
}

$wa->useScript('com_finder.finder');

?>

<form class="mx-auto form-control-lg mod-finder js-finder-searchform form-search w-100 searchforminheader" action="<?php echo Route::_($route); ?>" method="get" role="search">
	<?php echo $output; ?>

	<?php $show_advanced = $params->get('show_advanced', 0); ?>
	<?php if ($show_advanced == 2) : ?>
		<br>
		<a href="<?php echo Route::_($route); ?>" class="mod-finder__advanced-link"><?php echo Text::_('COM_FINDER_ADVANCED_SEARCH'); ?></a>
	<?php elseif ($show_advanced == 1) : ?>
		<div class="mod-finder__advanced js-finder-advanced">
			<?php echo HTMLHelper::_('filter.select', $query, $params); ?>
		</div>
	<?php endif; ?>
	<?php echo FinderHelper::getGetFields($route, (int) $params->get('set_itemid', 0)); ?>
</form>
<a class="pe-0 pe-md-5 d-lg-none d-block search-link rounded-icon" aria-label="Cerca nel sito" href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchmodal">
	<svg class="icon">
		<use href="<?= $baseImagePath ?>sprites.svg#it-search"></use>
	</svg>
</a>
</div>




<!--- modale -->

<div class="modal fade" tabindex="-1" role="dialog" id="searchmodal" aria-labelledby="searchmodalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="container">
      <div class="modal-header">
        <h2 class="modal-title h5 no_toc" id="searchmodal"><?php echo $label?></h2>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
          <svg class="icon">
              <use href="<?= $baseImagePath ?>sprites.svg#it-close"></use>
          </svg>
        </button>
      </div>
      <div class="modal-body p-0">
	  <form class="mx-auto form-control-lg mod-finder js-finder-searchform form-search w-100" action="<?php echo Route::_($route); ?>" method="get" role="search">
		<?php echo $output; ?>

		<?php $show_advanced = $params->get('show_advanced', 0); ?>
		<?php if ($show_advanced == 2) : ?>
			<br>
			<a href="<?php echo Route::_($route); ?>" class="mod-finder__advanced-link"><?php echo Text::_('COM_FINDER_ADVANCED_SEARCH'); ?></a>
		<?php elseif ($show_advanced == 1) : ?>
			<div class="mod-finder__advanced js-finder-advanced">
				<?php echo HTMLHelper::_('filter.select', $query, $params); ?>
			</div>
		<?php endif; ?>
		<?php echo FinderHelper::getGetFields($route, (int) $params->get('set_itemid', 0)); ?>
		</form>
      </div>
      <div class="modal-footer"></div>
      </div>
    </div>
  </div>
</div>
