<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

// Create a shortcut for params.
$params  = $displayData->params;
$canEdit = $displayData->params->get('access-edit');

$currentDate = Factory::getDate()->format('Y-m-d H:i:s');
$link = RouteHelper::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language);
?>
<?php if ($displayData->state == 0 || $params->get('show_title') || ($params->get('show_author') && !empty($displayData->author))) : ?>
    <div class="blogitem-header">
        <?php if ($params->get('show_title')) : ?>

                <?php if ($params->get('link_titles') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>

                    <p class="mb-0 lh100">
                        <strong><?php echo $this->escape($displayData->title); ?></strong>
                    </p>
  
                <?php else : ?>
                    <p class="mb-0 lh100">
                        <strong><?php echo $this->escape($displayData->title); ?></strong>
                    </p>
                <?php endif; ?>

        <?php endif; ?>

        <?php if ($displayData->state == 0) : ?>
            <span class="badge bg-warning"><?php echo Text::_('JUNPUBLISHED'); ?></span>
        <?php endif; ?>

        <?php if ($displayData->publish_up > $currentDate) : ?>
            <span class="badge bg-warning"><?php echo Text::_('JNOTPUBLISHEDYET'); ?></span>
        <?php endif; ?>

        <?php if ($displayData->publish_down !== null && $displayData->publish_down < $currentDate) : ?>
            <span class="badge bg-warning"><?php echo Text::_('JEXPIRED'); ?></span>
        <?php endif; ?>
    </div>
<?php endif; ?>


