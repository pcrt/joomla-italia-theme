<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Language\Text;

// Create a shortcut for params.
$params = $this->item->params;
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (Associations::isEnabled() && $params->get('show_associations'));

$currentDate   = Factory::getDate()->format('Y-m-d H:i:s');
$isUnpublished = ($this->item->state == ContentComponent::CONDITION_UNPUBLISHED || $this->item->publish_up > $currentDate)
    || ($this->item->publish_down < $currentDate && $this->item->publish_down !== null);



$introimg = json_decode($this->item->images);


$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";


?>


<div class="card card-servizi card-bg card-icon rounded h-100">
    <?php if ($isUnpublished) : ?>
        <div class="system-unpublished">
    <?php endif; ?>


     <a href="<?php echo Route::_(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>" itemprop="url" data-element="service-link">
        <div class="card-body">
            <svg class="icon">
                <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-flag"></use>
            </svg>
            <div class="card-icon-content">
                <?php echo LayoutHelper::render('joomla.content.blog_style_j4a_sottocategoria_item_title', $this->item); ?>
                <?php echo $this->item->event->afterDisplayTitle; ?>

                <?php if ($canEdit) : ?>
                    <?php echo LayoutHelper::render('joomla.content.icons', ['params' => $params, 'item' => $this->item]); ?>
                <?php endif; ?>
                    <small><?php echo JHTML::_('string.truncate', $this->item->introtext, 200, false, false) ; ?></small>


                <?php if ($params->get('show_readmore') && $this->item->readmore) :
                    if ($params->get('access-view')) :
                        $link = Route::_(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
                    else :
                        $menu = Factory::getApplication()->getMenu();
                        $active = $menu->getActive();
                        $itemId = $active->id;
                        $link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
                        $link->setVar('return', base64_encode(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
                    endif; ?>

                    <?php echo LayoutHelper::render('joomla.content.readmore', ['item' => $this->item, 'params' => $params, 'link' => $link]); ?>

                <?php endif; ?>
                <?php if ($isUnpublished) : ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </a>
</div>
