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
            $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false);
            $title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false); 
         ?>
        <a href="<?php echo $link; ?>" class="mod-news-title <?php echo $item->active; ?>">
            <h3 class="h6"><?php echo $title; ?></h3>
        
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
<?php endforeach; ?>
