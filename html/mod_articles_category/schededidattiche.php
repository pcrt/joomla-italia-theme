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

<div class="bg-bluelectricdark py-5">
    <div class="container mod-schededidattiche">
    <?php if ((bool) $module->showtitle) : ?>
    <h3 class="text-white text-center mb-3"><?php echo $module->title; ?></h3>
<?php endif; ?>
        <div class="row">
                <?php $items = $list; ?>
                <?php require_once ModuleHelper::getLayoutPath('mod_articles_category', $params->get('layout', 'default') . '_items'); ?>
        </div>
    </div>
</div>