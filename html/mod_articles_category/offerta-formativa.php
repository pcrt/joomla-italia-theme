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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\CMS\Uri\Uri;

if (!$list) {
    return;
}

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

?>
<section class="section section-padding py-0 bg-bluelectric section-tabs-bg">
    <div class="container">
        <div class="title-large pt-5">
            <?php if ((bool) $module->showtitle) : ?>
                <h1 class="h3"><?php echo $module->title; ?></h1>
            <?php endif; ?>
            <h2 class="h4 text-white label-didattica">La nostra offerta formativa</h2>
        </div>
        <div class="responsive-tabs responsive-tabs-aside r-tabs">
            <div class="tabs-img">
                <img class="img-fluid" src="<?= $baseImagePath ?>img-didattica.png" title="I cicli" alt="La didattica">
            </div>
            <div class="r-tabs-nav nav nav-tabs nav-tabs-vertical" id="nav-vertical-tab" role="tablist" aria-orientation="vertical">
                <ul>
                    <div class="title-small mb-5">
                        <div class="h5 text-center">Presentazione della scuola</div>
                    </div>
                    <?php
                    $z1 = 0;
                    foreach ($list as $groupName => $items) {
                        $idgroupName = str_replace(' ', '', $groupName);
                        ?>
                        <li><a href="#t-<?php echo $idgroupName ;?>" class="nav-link <?php if ($z1 == 0): ?>active<?php endif; ?>" id="t-<?php echo $idgroupName ;?>-tab" data-bs-toggle="tab" role="tab" aria-controls="t-<?php echo $idgroupName ;?>" aria-selected="false"><?php echo Text::_($groupName); ?></a></li>
                        <?php
                        $z1++;
                    }
                    ?>
                </ul>

            </div>
            <div class="accordion-large accordion-wrapper responsive-tabs-wrapper">
                <div class="pb-3 pb-lg-0">
                    <div class="tab-content" id="nav-vertical-tabContent">
                        <?php
                        $z2 = 0;
                        foreach ($list as $groupName => $items) {
                            $id2groupName = str_replace(' ', '', $groupName);

                            ?>
                            <button class="btn bttabacc d-lg-none d-block" type="button" data-bs-toggle="collapse" data-bs-target="#t-<?php echo $id2groupName ;?>" aria-expanded="false" aria-controls="<?php echo $id2groupName ;?>">
                                <?php echo Text::_($groupName); ?>
                                <svg class="icon icon-tab">
                                    <use href="<?= $baseImagePath ?>sprites.svg#it-expand"></use>
                                </svg>
                            </button>
                            <div class="collapse tab-pane <?php if ($z2 == 0): ?>active<?php endif; ?>" id="t-<?php echo $id2groupName ;?>" role="tabpanel" aria-labelledby="t-<?php echo $id2groupName ;?>-tab">
                                <div class="responsive-tabs-content accordion accordion-left-icon">
                                    <?php foreach ($items as $item) : ?>
                                        <div class="accordion-large accordion-wrapper">
                                            <div class="accordion-large-title accordion-header accordion-in active">
                                                <h3 class="mb-0">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $item->id; ?>" aria-expanded="false" aria-controls="collapse1l">
                                                        <?php echo $item->title; ?>
                                                    </button>
                                                </h3>
                                            </div>
                                            <div id="collapse<?php echo $item->id; ?>" class="accordion-collapse collapse accordion-content" data-bs-parent="accordion<?php echo $item->parent_id; ?>" role="region" aria-labelledby="heading1l">

                                                <p><?php echo $item->displayIntrotext; ?></p>
                                                
                                                <?php
                                                $attributes = ['class' => 'btn ' . $item->active];
                                                $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false);
                                                $title = 'Per saperne di più'
                                                ?>
                                                <p><?php echo HTMLHelper::_('link', $link, $title, $attributes); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php
                            $z2++;
                        }
                        ?>
                        <?php
                        // Otteniamo l'ID della categoria "percorsi-di-studio"
                        $db = JFactory::getDBO();
                        $query = $db->getQuery(true)
                        ->select($db->quoteName('id'))
                        ->from($db->quoteName('#__categories'))
                        ->where($db->quoteName('alias') . ' = ' . $db->quote('percorsi-di-studio'));
                        $db->setQuery($query);
                        $categoryId = $db->loadResult();
                        // Se l'ID della categoria è stato trovato, generiamo il link
                        if ($categoryId) {
                            $categoryUrl = Route::_(RouteHelper::getCategoryRoute($categoryId, $category->language));
                            ?>
                            <div class="text-center text-sm-left mb-5">
                                <a class="btn btn-redbrown mt-4 mb-2" href="<?php echo $categoryUrl; ?>" 
                                    data-focus-mouse="false">Tutti i Percorsi di studio</a></div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
