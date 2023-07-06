<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Uri\Uri;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

if (!$list) {
    return;
}

$countcat=0;

?>
<div class="container mod-news">
    <?php
    if ($module->showtitle) {
        echo '<div class="headerbelow px-2"><div class=""><h3>'.$module->title.'</h3></div>';
        foreach ($list as $item) :
            if($countcat == 0) {
                echo '<div><a href="index.php/'.$item->category_route.'">Vedi tutti</a><svg class="icon icon-xs d-inline-block"><use xlink:href="' . $baseImagePath . 'sprites.svg#it-arrow-right"></use></svg></div></div>';
            }
            ++$countcat;
        endforeach;
    }
?>
    <div class="row">
        <?php foreach ($list as $item) : ?>
            <div class="col-12 col-lg-4 px-4 py-4">
                <div class="scheda-item" itemscope itemtype="https://schema.org/Article">
                    <div class="categoria-ico my-2">
                        <svg class="icon icon-xs d-inline-block">
                            <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-calendar"></use>
                        </svg>
                        <a href="index.php/<?php echo $item->category_route; ?>" title="<?php echo $item->category_title; ?>"><?php echo $item->category_title; ?></a>
                    </div>
                    <a href="<?php echo $item->link; ?>" itemprop="url" title="<?php echo $item->title; ?>">
                        <span itemprop="name" class="mod-news-title">
                            <?php echo $item->title; ?>
                        </span>
                    </a>
                    <div class="article-info text-muted py-2">
                    <?php echo JHTML::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
                    </div>
                    <p><?php echo JHTML::_('string.truncate', $item->introtext, 200, false, false) ; ?></p>
                    <a class="leggimore text-uppercase" title="<?php echo $item->title; ?>" href="<?php echo $item->link; ?>"><?php echo Text::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?></a>
                    <svg class="icon icon-xs d-inline-block">
                        <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-arrow-right"></use>
                    </svg>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
