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
use Joomla\CMS\Router\Route;
use Joomla\Component\Tags\Site\Helper\RouteHelper;
use Joomla\Registry\Registry;

$authorised = Factory::getUser()->getAuthorisedViewLevels();

?>
<?php if (!empty($displayData)) : ?>

        <?php foreach ($displayData as $i => $tag) : ?>
            <?php if (in_array($tag->access, $authorised)) : ?>
                <?php $tagParams = new Registry($tag->params); ?>
                <?php $link_class = $tagParams->get('tag_link_class', 'btn-info'); ?>

                    <a href="<?php echo Route::_(RouteHelper::getComponentTagRoute($tag->tag_id . ':' . $tag->alias, $tag->language)); ?>" data-element="topic-list" class="badge rounded-pill badge-outline">
                        <?php echo $this->escape($tag->title); ?>
                    </a>

            <?php endif; ?>
        <?php endforeach; ?>

<?php endif; ?>
