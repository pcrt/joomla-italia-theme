<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Uri\Uri;

$lang   = Factory::getLanguage();
$user   = Factory::getUser();
$groups = $user->getAuthorisedViewLevels();

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";
?>

<?php if (count($this->children[$this->category->id]) > 0) : ?>
    <ul class="list-group mb-5">
        <?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
            <?php // Verifica se il livello di accesso della categoria consente l'accesso alle sottocategorie. ?>
            <?php if (in_array($child->access, $groups)) : ?>
                <?php if ($this->params->get('show_empty_categories') || $child->getNumItems(true) || count($child->getChildren())) : ?>
                    <li class="list-group-item mt-1">
                        <h5 class="mb-3">
                            <svg class="icon" width="20" height="20">
                                <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-folder"></use>
                            </svg>
                            <?php if ($this->params->get('show_cat_num_articles', 1)) : ?>
                                <span class="badge bg-info tip hasTooltip" title="<?php echo HTMLHelper::_('tooltipText', 'COM_CONTENT_NUM_ITEMS'); ?>">
                                    <?php echo $child->getNumItems(true); ?>
                                </span>
                            <?php endif; ?>
                            <a href="<?php echo Route::_(RouteHelper::getCategoryRoute($child->id, $child->language)); ?>">
                                <?php echo $this->escape($child->title); ?>
                            </a>
                            <?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
                                <a href="#category-<?php echo $child->id; ?>" data-bs-toggle="collapse" class="btn btn-sm float-end" aria-label="<?php echo Text::_('JGLOBAL_EXPAND_CATEGORIES'); ?>">
                                    <span class="icon-plus" aria-hidden="true"></span>
                                </a>
                            <?php endif; ?>
                        </h5>
                        <?php if ($this->params->get('show_subcat_desc') == 1 && $child->description) : ?>
                            <p class="mb-3"><?php echo HTMLHelper::_('content.prepare', $child->description, '', 'com_content.category'); ?></p>
                        <?php endif; ?>
                        <?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
                            <div class="collapse fade" id="category-<?php echo $child->id; ?>">
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
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
