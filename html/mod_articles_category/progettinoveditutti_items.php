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


//print_r($items[0]->parent_title);
//echo $items[0]->parent_id;
//echo $items[0]->parent_language;
//echo $items[0]->parent_title;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

?>

<?php foreach ($items as $item) : ?>
    <div class="col-12 col-lg-4 pb-3 mb-3">
        <div class="card card-bg card-icon rounded h-100">
            <div class="card-body">
                <div class="card-icon-content d-flex align-items-center">
                    <div class="card-news-img me-3">
                        <figure class="figure">
                            <a href="<?php echo $item->link; ?>" itemprop="url" title="<?php echo $item->title; ?>">
                                <?php if (empty(json_decode($item->images)->image_intro)) : ?>
                                    <img src="<?= $baseImagePath ?>imgsegnaposto.jpg" class="img-fluid" alt="<?php echo $item->title; ?>">
                                <?php else : ?>
                                    <img src="<?php echo json_decode($item->images)->image_intro; ?>" class="img-fluid" alt="<?php echo $item->title; ?>" />
                                <?php endif; ?>
                            </a>
                        </figure>
                    </div>
                    <div class="article-details">
                        <a href="<?php echo $item->link; ?>" class="" data-focus-mouse="false">
                            <div class="blogitem-header">
                                <p class="mb-2 lh100">
                                    <strong><?php echo $item->title; ?></strong>
                                </p>
                            </div>
                            <?php if ($params->get('show_introtext')) : ?>
                                <small><?php echo $item->displayIntrotext; ?></small>
                            <?php endif; ?>
                        </a>
                        <!-- Mostra la data di pubblicazione -->
                        <div class="publication-date mt-2">
                            <small>
                                <strong>Pubblicato:</strong> <?php echo JHtml::_('date', $item->publish_up, 'd F Y'); ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!--<div class="col-12 text-center">
    <a href="<?php //echo Route::_(RouteHelper::getCategoryRoute($items[0]->parent_id, $items[0]->parent_language)); ?>" class="view-all" title="Vedi tutti"><strong>Vedi tutti</stonrg></a>
</div>-->
