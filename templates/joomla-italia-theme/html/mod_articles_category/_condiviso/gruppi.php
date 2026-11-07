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

?>
<?php foreach ($items as $item) : ?>
    <div class="card card-bg card-icon card-icon-main rounded mt-3">
        <div class="scheda-item">
        <?php 
            $attributes = ['class' => 'mod-news-title ' . $item->active];
            $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false);
            $title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false); 
         ?>
        <h3 class="h6"><?php echo HTMLHelper::_('link', $link, $title, $attributes); ?></h3>
        <?php if ($params->get('show_introtext')) : ?>
            <p><?php echo $item->displayIntrotext; ?></p>
        <?php endif; ?>
        <?php if (!empty($item->displayDate)) : ?>
            <?php // Issue #81: data di pubblicazione, solo se nel modulo "Mostra data" e' attivo ?>
            <p class="mod-articles-category-date small mb-0"><strong><?php echo Text::_('TPL_PCRT_MOD_PUBLISHED'); ?></strong> <?php echo $item->displayDate; ?></p>
        <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
