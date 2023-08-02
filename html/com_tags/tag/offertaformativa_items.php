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

    <?php if (empty($this->items)) : ?>
        <div class="alert alert-info">
            <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
            <?php echo Text::_('COM_TAGS_NO_ITEMS'); ?>
        </div>
    <?php else :

        foreach ($this->items as $m => $item_tag) :

            $db2 = Factory::getContainer()->get('DatabaseDriver');
            $query2 = $db2->getQuery(true);
            $query2->select($db2->quoteName(array('tagmap.content_item_id', 'tagmap.tag_id', 'tags.title')))
            ->from($db2->quoteName('#__contentitem_tag_map', "tagmap"))
            ->leftJoin($db2->quoteName("#__content", "content") . ' ON ' . $db2->quoteName("tagmap.content_item_id") . " = " . $db2->quoteName("content.id"))
            ->leftJoin($db2->quoteName("#__tags", "tags") . ' ON ' . $db2->quoteName("tags.id") . " = " . $db2->quoteName("tagmap.tag_id"))
            ->where($db2->quoteName('content.id') . ' = '. $item_tag->id);
            $db2->setQuery($query2);
            $items2 = $db2->loadObjectList();
            $items3[$items2[0]->content_item_id]= $items2[0];

        endforeach;

        $tagOLD = '';
        $arrray = [];

        foreach($this->items as $articolo):
            $arr_art[$items3[$articolo->id]->tag_id][] = $articolo;
        endforeach;

        ?>
        <div class="responsive-tabs responsive-tabs-aside r-tabs">
            <div class="tabs-img">
                <img class="img-fluid" src="<?= $baseImagePath ?>img-didattica.png" title="I cicli" alt="La didattica">
            </div>
            <div class="r-tabs-nav nav nav-tabs nav-tabs-vertical" id="nav-vertical-tab" role="tablist" aria-orientation="vertical">
                <ul class="m-0 p-0">
                    <?php
                            $z1 = 0;
        foreach($items3 as $tag):
            if($tagOLD == $tag->tag_id) {
                $tagOLD = $tag->tag_id;
                break;
            }
            ?>
                    <li>
                        <a href="#nav-vertical-<?php echo $tag->tag_id; ?>" class="nav-link <?php if ($z1 == 0): ?>active<?php endif; ?>" id="nav-vertical-<?php echo $tag->tag_id; ?>-tab" data-bs-toggle="tab" role="tab" aria-controls="nav-vertical-<?php echo $tag->tag_id; ?>" aria-selected="false"><?php echo $tag->title; ?></a>
                    </li>
                <?php
            $tagOLD = $tag->tag_id;
            $z1++;
        endforeach;?>
                </ul>
            </div>
            <div class="accordion-large accordion-wrapper responsive-tabs-wrapper">
                <div class="pb-3 pb-lg-0">
                <div class="tab-content" id="nav-vertical-tabContent">
                    <?php
            $z2 = 0;
foreach($items3 as $tag):
    /*if($tagOLD == $tag->tag_id){
            continue;
        } */
    ?>
                    <!--<h2><?php echo $tag->title; ?></h2>-->


                        <button class="btn bttabacc d-lg-none d-block" type="button" data-bs-toggle="collapse" data-bs-target="#nav-vertical-<?php echo $tag->tag_id; ?>" aria-expanded="false" aria-controls="nav-vertical-<?php echo $tag->tag_id; ?>">
                            <?php echo $tag->title; ?>
                            <svg class="icon icon-tab">
                                <use href="<?= $baseImagePath ?>sprites.svg#it-expand"></use>
                            </svg>
                        </button>

                        <div class="collapse tab-pane <?php if ($z2 == 0): ?>active<?php endif; ?>" id="nav-vertical-<?php echo $tag->tag_id; ?>" role="tabpanel" aria-labelledby="nav-vertical-<?php echo $tag->tag_id; ?>-tab">

                            <div class="responsive-tabs-content accordion accordion-left-icon">
                                <?php foreach ($arr_art[$tag->tag_id] as $item) : ?>
                                    <div class="accordion-large accordion-wrapper">
                                        <div class="accordion-large-title accordion-header accordion-inactive">
                                            <h3 class="mb-0">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $item->id; ?>" aria-expanded="false" aria-controls="collapse1l">
                                                    <?php echo $this->escape($item->core_title); ?>
                                                </button>
                                            </h3>
                                        </div>
                                        <div id="collapse<?php echo $item->id; ?>" class="accordion-collapse collapse accordion-content" data-bs-parent="accordion<?php echo $tag->tag_id; ?>" role="region" aria-labelledby="heading1l">
                                            <?php echo HTMLHelper::_('string.truncate', $item->core_body, $this->params->get('tag_list_item_maximum_characters')); ?>
                                            <p>
                                                <a href="<?php echo Route::_($item->link); ?>" class="btn">Per saperne di più</a>
                                            </p>
                                        </div>
                                    </div>
                                    <?php //$tagOLD = $tag->tag_id?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php
    $z2++;
endforeach;
?>
                </div>
            </div>
        </div>
    <?php endif; ?>
