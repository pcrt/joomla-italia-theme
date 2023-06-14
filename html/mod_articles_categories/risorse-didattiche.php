<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_categories
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

if (!$list) {
    return;
}

?>
<section class="py-5 bluelectric">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-4">
                <div class="h6">Didattica</div>
                <h2 class="text-large mb-4 pr-4"><?php echo $module->title; ?></h2>
            </div>
            <div class="col-xl-9 col-lg-8">
                <?php require_once ModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default') . '_items'); ?>
            </div>
    </div>
</section>
