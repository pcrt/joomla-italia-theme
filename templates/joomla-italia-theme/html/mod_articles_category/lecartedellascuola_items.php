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
<div class="owl-carousel owl-theme" id="carosello-documenti">
    <?php foreach ($items as $item) : ?>
    <div>
        <div class="redbrown card card-large card-bg card-icon card-icon-main rounded my-3">
            <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>">
                <div class="card-body card-body-min-height">
                    <svg class="icon icon-xs d-inline-block">
                        <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-file-pdf"></use>
                    </svg>
                    <div class="card-icon-content">
                    <h3><?php echo $item->title; ?></h3>
                    <?php if ($params->get('show_introtext')) : ?>
                        <p>
                            <?php echo $item->displayIntrotext; ?>
                        </p>
                    <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="col-12 text-center">
    <a href="<?php echo Route::_(RouteHelper::getCategoryRoute($items[0]->parent_id, $items[0]->parent_language)); ?>" class="btn btn-redbrown mt-4" title="Vai alle carte della scuola">Tutti i documenti</a>
</div>
