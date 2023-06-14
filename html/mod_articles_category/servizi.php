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
<section class="section bg-purplelight bg-purplegradient py-5 position-relative d-flex align-items-center overflow-hidden">
    <div class="purple-oval-forms">
		<svg width="100%" height="100%" viewBox="0 0 578 359" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" role="img" aria-label="purple oval forms">
              <g id="Group-2">
	              <path id="Oval-2" d="M578,359c0,-159.61 -129.39,-289 -289,-289c-159.61,0 -289,129.39 -289,289l578,0Z" style="fill:url(#_Linear1);fill-rule:nonzero;"></path>
	              <path id="Oval-2-Copy" d="M578,0c0,159.61 -129.39,289 -289,289c-159.61,0 -289,-129.39 -289,-289l578,0Z" style="fill:url(#_Linear2);fill-rule:nonzero;"></path>
              </g>
			<defs>
				<linearGradient id="_Linear1" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(1.76961e-14,289,-289,1.76961e-14,289,70)">
					<stop offset="0" style="stop-color:#610e0e;stop-opacity:1"></stop>
					<stop offset="1" style="stop-color:#b21dd0;stop-opacity:0.61"></stop>
				</linearGradient>
				<linearGradient id="_Linear2" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(-578,-7.07846e-14,7.07846e-14,-578,578,144.5)">
					<stop offset="0" style="stop-color:#590e61;stop-opacity:0"></stop>
					<stop offset="1" style="stop-color:#b21dd0;stop-opacity:1"></stop>
				</linearGradient>
			</defs>
        </svg>
	</div>

    <div class="container">
        <div class="title-section pb-4">
            <h2 class="fs-1"><?php echo $module->title; ?></h2>
        </div>
    </div>
</section>
    <div class="container slided-top pb-5">
        <div class="row">
                <?php $items = $list; ?>
                <?php require_once ModuleHelper::getLayoutPath('mod_articles_category', $params->get('layout', 'default') . '_items'); ?>
        </div>
    </div>
