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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Uri\Uri;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

$input  = $app->getInput();
$option = $input->getCmd('option');
$view   = $input->getCmd('view');
$id     = $input->getInt('id');
?>
<div class="row">
    <?php foreach ($list as $item) : ?>
    <div class="col-lg-6">
        <div class="card card-bg card-icon card-icon-main rounded mt-3">
            <a href="<?php echo Route::_(RouteHelper::getCategoryRoute($item->id, $item->language)); ?>">
            <div class="card-body">
                <svg class="icon">
                    <use href="<?= $baseImagePath ?>sprites.svg#it-files"></use>
                </svg>
                <div class="card-icon-content">
                    <p><strong><?php echo $item->title; ?></strong></p>
                </div>
            </div>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
