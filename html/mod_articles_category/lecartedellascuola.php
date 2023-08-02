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

<?php

//print_r($list);

//echo $list[0]->parent_title;

?>
<div class="bg-white py-5 sectioncartescuola">
    <div class="container mod-schededidattiche">

        <div class="row justify-content-center">        
            <?php if ((bool) $module->showtitle) : ?>
                <div class="col-12 text-center titlecartescuola">
                    <h2><?php echo $module->title; ?></h2>
                    <p>I documenti recenti</p>
                </div>
            <?php endif; ?>
            <div class="col-md-10">
                <?php $items = $list; ?>
                <?php require ModuleHelper::getLayoutPath('mod_articles_category', $params->get('layout', 'default') . '_items'); ?>
            </div>
        </div>
    </div>
</div>