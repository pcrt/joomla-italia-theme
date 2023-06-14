<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

if (!$list) {
    return;
}
$countcat =0;

?>

<div class="container mod-news pt-4 pb-5">
    <?php if ((bool) $module->showtitle) : ?>
        <div class="title-section pb-4">
            <h2><?php echo $module->title; ?></h2>
        </div>
    <?php endif; ?>
    
        <?php if ($grouped) : ?>
            <?php foreach ($list as $groupName => $items) : ?>
                
                    <div class="title-section">
                        <h2><?php echo Text::_($groupName); ?></h2>
                    </div>
                    <?php require_once ModuleHelper::getLayoutPath('mod_articles_category', $params->get('layout', 'default') . '_gruppi');

                $m=0;
                foreach ($list[$groupName] as $link_group):
                    if($m == 0): ?>
                        <a href="<?php echo $link_group->category_route; ?>" title="Vai alla pagina <?php echo Text::_($groupName); ?>" class="view-all d-block py-3"><strong>Vedi tutti</strong></a>
                    <?php
                    endif;
                    $m++;
                endforeach;?>
        <?php endforeach; ?>
        <?php else : ?>
            <?php $items = $list; ?>
            <?php require_once ModuleHelper::getLayoutPath('mod_articles_category', $params->get('layout', 'default') . '_items'); ?>
        <?php endif; ?>
    
</div>