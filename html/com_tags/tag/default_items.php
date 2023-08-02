<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Tags\Site\Helper\RouteHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('com_tags.tag-default');

// Get the user object.
$user = Factory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
// Do we really have to make it so people can see unpublished tags???
$canEdit      = $user->authorise('core.edit', 'com_tags');
$canCreate    = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

?>

<section class="bg-gray-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 pt84">
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-info">
                        <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                        <?php echo Text::_('COM_TAGS_NO_ITEMS'); ?>
                    </div>
                <?php else : ?>
                    <?php foreach ($this->items as $i => $item) : ?>
                        <article class="card card-bg card-article card-article-redbrown">
                            <div class="card-body">
                                <div class="card-article-img d-none d-lg-block">
                                    <?php $images  = json_decode($item->core_images); ?>
                                    <a href="<?php echo Route::_(RouteHelper::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
                                    <?php if($images->image_intro ==''): ?>
                                        <figure>
                                            <img src="<?= $baseImagePath ?>imgsegnaposto.jpg" class="img-fluid" alt="immagine-segnaposto"/>
                                        </figure>
                                    <?php else:?>
                                        <?php echo HTMLHelper::_('image', $images->image_intro, $images->image_intro_alt); ?>
                                    <?php endif; ?>
                                    </a>
                                </div>
                                <div class="card-article-content">
                                    <h2 class="h3">
                                        <a href="<?php echo Route::_($item->link); ?>" aria-label="<?php echo $this->escape($item->core_title); ?>">
                                            <?php echo $this->escape($item->core_title); ?>
                                        </a>
                                    </h2>
                                    <p><?php echo HTMLHelper::_('string.truncate', $item->core_body, $this->params->get('tag_list_item_maximum_characters')); ?></p>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
