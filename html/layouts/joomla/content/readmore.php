<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2014 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$params    = $displayData['params'];
$item      = $displayData['item'];
$direction = Factory::getLanguage()->isRtl() ? 'left' : 'right';

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";
?>

<div class="readmore">
    <?php if (!$params->get('access-view')) : ?>
        <a class="leggimore text-uppercase" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo Text::_('JGLOBAL_REGISTER_TO_READ_MORE') . ' ' . $this->escape($item->title); ?>">
            <?php echo Text::_('JGLOBAL_REGISTER_TO_READ_MORE'); ?>
            <svg class="icon icon-xs d-inline-block">
                <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-arrow-right"></use>
            </svg>
        </a>
    <?php elseif ($readmore = $item->alternative_readmore) : ?>
        <a class="leggimore" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo $this->escape($readmore . ' ' . $item->title); ?>">
            <?php echo $readmore; ?>
            <?php if ($params->get('show_readmore_title', 0) != 0) : ?>
                <?php echo HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
            <?php endif; ?>
            <svg class="icon icon-xs d-inline-block">
                <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-arrow-right"></use>
            </svg>
        </a>
    <?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
        <a class="leggimore text-uppercase" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo Text::sprintf('JGLOBAL_READ_MORE_TITLE', $this->escape($item->title)); ?>">
            <?php echo Text::_('JGLOBAL_READ_MORE'); ?>
            <svg class="icon icon-xs d-inline-block">
                <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-arrow-right"></use>
            </svg>
        </a>
    <?php else : ?>
        <a class="leggimore" href="<?php echo $displayData['link']; ?>" aria-label="<?php echo Text::sprintf('JGLOBAL_READ_MORE_TITLE', $this->escape($item->title)); ?>">
            <?php echo Text::sprintf('JGLOBAL_READ_MORE_TITLE', HTMLHelper::_('string.truncate', $item->title, $params->get('readmore_limit'))); ?>
            <svg class="icon icon-xs d-inline-block">
                <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-arrow-right"></use>
            </svg>
        </a>
    <?php endif; ?>
    </div>
