<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   (C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Uri\Uri;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

//print_r($items[0]->parent_title);
//echo $items[0]->parent_id;
//echo $items[0]->parent_language;
//echo $items[0]->parent_title;

?>
<div class="owl-carousel owl-theme" id="carosello-didattica">
    <?php foreach ($items as $item) : ?>
        <div class="scheda-item">
        <?php if ($item->displayCategoryTitle) : ?>
            <div class="categoria-ico">
                <svg class="icon icon-xs d-inline-block">
                    <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-calendar"></use>
                </svg>
                <?php echo $item->displayCategoryTitle; ?>

            </div>
        <?php endif; ?>
        <?php if ($params->get('link_titles') == 1) : ?>
            <?php $attributes = ['class' => 'mod-news-title ' . $item->active]; ?>
            <?php $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false); ?>
            <?php $title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false); ?>
            <?php echo HTMLHelper::_('link', $link, $title, $attributes); ?>
        <?php else : ?>
            <span class="mod-news-title"><?php echo $item->title; ?></span>
        <?php endif; ?>

        <?php if ($item->displayHits) : ?>
            <span class="mod-articles-category-hits">
                (<?php echo $item->displayHits; ?>)
            </span>
        <?php endif; ?>

        <?php if ($params->get('show_author')) : ?>
            <span class="mod-articles-category-writtenby">
                <?php echo $item->displayAuthorName; ?>
            </span>
        <?php endif; ?>

        <?php if ($item->displayDate) : ?>
            <div class="article-info text-muted"><?php echo $item->displayDate; ?></div>
        <?php endif; ?>

        <?php if ($params->get('show_tags', 0) && $item->tags->itemTags) : ?>
            <div class="mod-articles-category-tags">
                <?php echo LayoutHelper::render('joomla.content.tags', $item->tags->itemTags); ?>
            </div>
        <?php endif; ?>

        <?php if ($params->get('show_introtext')) : ?>
            <p class="mod-articles-category-introtext">
                <?php echo $item->displayIntrotext; ?>
            </p>
        <?php endif; ?>

        <?php if ($params->get('show_readmore')) : ?>
            <div>
                <a class="leggimore text-uppercase <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
                    <?php if ($item->params->get('access-view') == false) : ?>
                        <?php echo Text::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
                    <?php elseif ($item->alternative_readmore) : ?>
                        <?php echo $item->alternative_readmore; ?>
                        <?php echo HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
                            <?php if ($params->get('show_readmore_title', 0)) : ?>
                                <?php echo HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
                            <?php endif; ?>
                    <?php elseif ($params->get('show_readmore_title', 0)) : ?>
                        <?php echo Text::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
                        <?php echo HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
                    <?php else : ?>
                        <?php echo Text::_('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
                    <?php endif; ?>
                    <svg class="icon icon-xs d-inline-block">
                        <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-arrow-right"></use>
                    </svg>
                </a>
            </div>
        <?php endif; ?>
        </div>

    <?php endforeach; ?>
</div>
<div class="col-12 text-center text-white">
    <a href="<?php echo Route::_(RouteHelper::getCategoryRoute($items[0]->parent_id, $items[0]->parent_language)); ?>">Vedi tutti</a>
</div>
