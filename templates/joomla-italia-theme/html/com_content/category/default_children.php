<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Sottocategorie della voce di menu "Elenco categoria" (issue #93): una scheda per ogni
 * sottocategoria, con icona cartella, numero di articoli, descrizione ed eventuali
 * sottocategorie annidate, come nel modello delle scuole. Le opzioni della voce di menu
 * (numero di articoli, descrizione, livelli) valgono come prima.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$user   = Factory::getApplication()->getIdentity();
$groups = $user->getAuthorisedViewLevels();

$baseImagePath = Uri::root(false) . 'media/templates/site/joomla-italia-theme/images/';
?>

<?php if (count($this->children[$this->category->id]) > 0) : ?>
    <div class="sottocategorie-elenco">
    <?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
        <?php // Check whether category access level allows access to subcategories. ?>
        <?php if (in_array($child->access, $groups)) : ?>
            <?php if ($this->params->get('show_empty_categories') || $child->getNumItems(true) || count($child->getChildren())) : ?>
            <div class="com-content-category__children card card-bg rounded mb-3">
                <div class="card-body d-flex align-items-start">
                    <svg class="icon icon-primary me-3 flex-shrink-0" aria-hidden="true">
                        <use xlink:href="<?php echo $baseImagePath; ?>sprites.svg#it-folder"></use>
                    </svg>
                    <div class="flex-grow-1">
                        <h3 class="h5 page-header item-title mb-2">
                            <a href="<?php echo Route::_(RouteHelper::getCategoryRoute($child->id, $child->language)); ?>"><?php echo $this->escape($child->title); ?></a>
                            <?php if ($this->params->get('show_cat_num_articles', 1)) : ?>
                                <span class="badge bg-secondary ms-2" title="<?php echo HTMLHelper::_('tooltipText', 'COM_CONTENT_NUM_ITEMS'); ?>">
                                    <span class="visually-hidden"><?php echo Text::_('COM_CONTENT_NUM_ITEMS'); ?> </span><?php echo $child->getNumItems(true); ?>
                                </span>
                            <?php endif; ?>
                            <?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
                                <a href="#category-<?php echo $child->id; ?>" data-bs-toggle="collapse" class="btn btn-sm float-end" aria-expanded="false" aria-controls="category-<?php echo $child->id; ?>" aria-label="<?php echo Text::_('JGLOBAL_EXPAND_CATEGORIES'); ?>"><span class="icon-plus" aria-hidden="true"></span></a>
                            <?php endif; ?>
                        </h3>
                        <?php if ($this->params->get('show_subcat_desc') == 1) : ?>
                            <?php if ($child->description) : ?>
                                <div class="category-desc">
                                    <?php echo HTMLHelper::_('content.prepare', $child->description, '', 'com_content.category'); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
                        <div class="collapse fade mt-3" id="category-<?php echo $child->id; ?>">
                            <?php
                            $this->children[$child->id] = $child->getChildren();
                            $this->category = $child;
                            $this->maxLevel--;
                            echo $this->loadTemplate('children');
                            $this->category = $child->getParent();
                            $this->maxLevel++;
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
