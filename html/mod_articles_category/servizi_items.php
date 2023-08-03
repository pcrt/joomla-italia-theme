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

<?php foreach ($items as $item) : ?>

<div class="col-12 col-lg-4 px-4 py-2">
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



    <?php if ($params->get('show_introtext')) : ?>
        <p class="mod-articles-category-introtext">
            <?php echo $item->displayIntrotext; ?>
        </p>
    <?php endif; ?>

    </div>
</div>
<?php endforeach; ?>

<div class="col-12 text-center">
    <a href="<?php echo Route::_(RouteHelper::getCategoryRoute($items[0]->parent_id, $items[0]->parent_language)); ?>" class="btn btn-outline-purplelight mt-4" title="Vedi tutti"><strong>Scopri di più</strong></a>
</div>
