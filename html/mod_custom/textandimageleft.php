<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId = 'mod-custom' . $module->id;


?>
<div class="container">
<div id="<?php echo $modId; ?>" class="mod-textimgageleft">
        <div class="row align-item-center">
            <div class="col-12 order-2 order-lg-1 col-lg-6 pe-lg-5 align-self-center">
                <h3><?php echo $module->title; ?></h3>
                <?php echo $module->content; ?>
            </div>
            <div class="col-12 order-1 order-lg-2 col-lg-6">
            <figure class="left primopiano-foto img-fit-cover">
                <img src="<?php  echo Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url; ?>" alt="" />
            </figure>
            </div>
        </div>
    </div>
</div>
