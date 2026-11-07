<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Elenco dei tag della voce di menu "Lista di tutti i tag" (issue #95): una scheda per ogni
 * tag con icona cartella, titolo, descrizione e, se richiesto, il numero di visite.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Tags\Site\Helper\RouteHelper;

/** @var \Joomla\Component\Tags\Site\View\Tags\HtmlView $this */
$app = Factory::getApplication();

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->useScript('com_tags.tags-default');

// Livelli di accesso dell'utente corrente (senza passare da proprietà deprecate della vista)
$livelliAccesso = $app->getIdentity()->getAuthorisedViewLevels();

$baseImagePath = Uri::root(false) . 'media/templates/site/joomla-italia-theme/images/';
$n             = count($this->items);
?>

<div class="com-tags__items">
    <form action="<?php echo htmlspecialchars(Uri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
        <?php if ($this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <?php if ($this->params->get('filter_field')) : ?>
                    <div class="com-tags-tags__filter input-group mb-2" style="max-width: 420px;">
                        <label class="filter-search-lbl visually-hidden" for="filter-search">
                            <?php echo Text::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>
                        </label>
                        <input
                            type="text"
                            name="filter-search"
                            id="filter-search"
                            value="<?php echo $this->escape($this->state->get('list.filter')); ?>"
                            class="form-control"
                            placeholder="<?php echo Text::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>"
                        >
                        <button type="submit" name="filter_submit" class="btn btn-primary"><?php echo Text::_('JGLOBAL_FILTER_BUTTON'); ?></button>
                        <button type="reset" name="filter-clear-button" class="btn btn-outline-secondary"><?php echo Text::_('JSEARCH_FILTER_CLEAR'); ?></button>
                    </div>
                <?php endif; ?>
                <?php if ($this->params->get('show_pagination_limit')) : ?>
                    <div class="mb-2 ms-auto">
                        <label for="limit" class="visually-hidden">
                            <?php echo Text::_('JGLOBAL_DISPLAY_NUM'); ?>
                        </label>
                        <?php echo $this->pagination->getLimitBox(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <input type="hidden" name="limitstart" value="">
            <input type="hidden" name="task" value="">
        <?php endif; ?>
    </form>

    <?php if (!$this->items || $n === 0) : ?>
        <div class="alert alert-info">
            <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
            <?php echo Text::_('COM_TAGS_NO_TAGS'); ?>
        </div>
    <?php else : ?>
        <div class="argomenti-schede">
        <?php foreach ($this->items as $i => $item) : ?>
            <?php $images = !empty($item->images) ? json_decode($item->images) : null; ?>
            <div class="card card-bg rounded mb-3">
                <div class="card-body d-flex align-items-start">
                    <svg class="icon icon-primary me-3 flex-shrink-0" aria-hidden="true">
                        <use xlink:href="<?php echo $baseImagePath; ?>sprites.svg#it-folder"></use>
                    </svg>
                    <div class="flex-grow-1">
                        <?php if ((!empty($item->access)) && in_array($item->access, $livelliAccesso)) : ?>
                            <h2 class="h5 mb-2">
                                <a href="<?php echo Route::_(RouteHelper::getComponentTagRoute($item->id . ':' . $item->alias, $item->language)); ?>">
                                    <?php echo $this->escape($item->title); ?>
                                </a>
                            </h2>
                        <?php else : ?>
                            <h2 class="h5 mb-2"><?php echo $this->escape($item->title); ?></h2>
                        <?php endif; ?>

                        <?php if ($this->params->get('all_tags_show_tag_image') && !empty($images->image_intro)) : ?>
                            <div class="item-image mb-2">
                                <?php echo HTMLHelper::_('image', $images->image_intro, $images->image_intro_alt ?? '', ['class' => 'img-fluid']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->params->get('all_tags_show_tag_description', 1) && !empty($item->description)) : ?>
                            <p class="mb-2"><?php echo HTMLHelper::_('string.truncate', $item->description, $this->params->get('all_tags_tag_maximum_characters')); ?></p>
                        <?php endif; ?>
                        <?php if ($this->params->get('all_tags_show_tag_hits')) : ?>
                            <span class="badge bg-secondary"><?php echo Text::sprintf('JGLOBAL_HITS_COUNT', $item->hits); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php // Add pagination links ?>
    <?php if (!empty($this->items)) : ?>
        <?php if (($this->params->def('show_pagination', 2) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
            <div class="com-tags__pagination w-100 mt-4">
                <?php if ($this->params->def('show_pagination_results', 1)) : ?>
                    <p class="counter float-end pt-3 pe-2">
                        <?php echo $this->pagination->getPagesCounter(); ?>
                    </p>
                <?php endif; ?>
                <?php echo $this->pagination->getPagesLinks(); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
