<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die;

if (!$list) {
    return;
}

$countcat=0;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

?>
<div class="mod-rows">
    <div class="container">
        <div class="row justify-content-between pt-5 mx-0">
            <div class="col-12 col-lg-7 textmodulorows pb-5"><?php echo JHtml::_('content.prepare', '{loadposition textmodulorows}'); ?></div>
            <div class="col-12 col-lg-auto menumodulorows d-none d-lg-block"><?php echo JHtml::_('content.prepare', '{loadposition menumodulorows}'); ?></div>
        </div>
        <div class="row mx-0">
        <?php
            if ($module->showtitle) {
                echo '<div class="col-12"><h3 class="sbuttitle">'.$module->title.'</h3></div>';
            }
?>
            <?php foreach ($list as $item) : ?>
                <div class="col-12 py-4">
                    <div class="scheda-item modulorows" itemscope itemtype="https://schema.org/Article">
                        <div class="row m-0">
                            <div class="col p-0">
                                <div class="row m-0 align-items-center cardbandi">
                                    <div class="col-auto d-none d-lg-flex ps-4">
                                        <img src="<?= $baseImagePath ?>megafono.svg" alt="immagine-megafono">
                                    </div>
                                    <div class="col py-4 px-3">
                                        <div class="categoria-ico my-2">
                                            <svg class="icon icon-xs d-inline-block">
                                                <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-calendar"></use>
                                            </svg>
                                            <a href="index.php/<?php echo $item->category_route; ?>" title="<?php echo $item->category_title; ?>"><?php echo $item->category_title; ?></a>
                                        </div>
                                        <a href="<?php echo $item->link; ?>" itemprop="url" title="<?php echo $item->title; ?>" class="d-block my-2">
                                            <span itemprop="name" class="mod-news-title">
                                                <?php echo $item->title; ?>
                                            </span>
                                        </a>
                                        <p><?php echo JHTML::_('string.truncate', $item->introtext, 200, false, false) ; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto p-0 d-none d-lg-flex">
                                <div class="cta-ocb px-5">
                                <a class="leggimore text-uppercase" title="<?php echo $item->title; ?>" href="<?php echo $item->link; ?>">
                                    <svg class="icon icon-lg d-inline-block">
                                        <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-chevron-right"></use>
                                    </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    foreach ($list as $item) :
        if($countcat == 0) {
            echo '<div class="text-center py-4"><a href="index.php/'.$item->category_route.'" class="btn btn-outline-primary text-uppercase">Vedi elenco completo dei bandi</a></div>';
        }
        ++$countcat;
    endforeach;
?>
    </div>
</div>
