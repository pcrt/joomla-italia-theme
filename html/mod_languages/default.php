<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_languages
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('mod_languages', 'mod_languages/template.css');
?>
<div class="mod-lingua">
<?php if ($headerText) : ?>
    <div class="mod-languages__pretext pretext"><p><?php echo $headerText; ?></p></div>
<?php endif; ?>
<?php if ($params->get('dropdown', 0)) : ?>
    <div class="nav-item dropdown">
        <?php foreach ($list as $language) : ?>
            <?php if ($language->active) : ?>
                <a href="#" id="language_btn_<?php echo $module->id; ?>" data-bs-toggle="dropdown" class="nav-link dropdown-toggle" aria-expanded="false">
                    <span class="visually-hidden" id="language_picker_des_<?php echo $module->id; ?>"><?php echo Text::_('MOD_LANGUAGES_DESC'); ?></span>
                    <?php if ($params->get('dropdownimage', 1) && ($language->image)) : ?>
                        <?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $params->get('full_name') ? ' ' : $language->title_native, null, true); ?>
                    <?php endif; ?>
                    <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef); ?>
                    <svg class="icon d-none d-lg-block">
                        <use href="<?= $baseImagePath ?>sprites.svg#it-expand"></use>
                    </svg>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="dropdown-menu">
            <div class="row">
                <div class="col-12">
                    <div class="link-list-wrapper">
                        <ul class="link-list">
                            <?php foreach ($list as $language) : ?>
                                <?php
                                    $lbl = '';
                                if ($params->get('full_name') === 0) {
                                    $lbl = 'aria-label="' . $language->title_native . '"';
                                }
                                ?>
                                <?php if (!$language->active) : ?>
                                    <li>
                                    <a class="dropdown-item list-item" <?php echo $lbl; ?> href="<?php echo htmlspecialchars_decode(htmlspecialchars($language->link, ENT_QUOTES, 'UTF-8'), ENT_NOQUOTES); ?>">
                                            <span>
                                                <?php if ($params->get('dropdownimage', 1) && ($language->image)) : ?>
                                                    <?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $params->get('full_name') ? '' : $language->title_native, null, true); ?>
                                                <?php endif; ?>
                                                <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef); ?>
                                            </span>
                                        </a>
                                    </li>
                                <?php elseif ($params->get('show_active', 1)) : ?>
                                    <?php $base = Uri::getInstance(); ?>
                                    <li class="lang-active">
                                        <a class="dropdown-item list-item" aria-current="true" <?php echo $lbl; ?> href="<?php echo htmlspecialchars_decode(htmlspecialchars($base, ENT_QUOTES, 'UTF-8'), ENT_NOQUOTES); ?>">
                                        <span>
                                            <?php if ($params->get('dropdownimage', 1) && ($language->image)) : ?>
                                                <?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $params->get('full_name') ? '' : $language->title_native, null, true); ?>
                                            <?php endif; ?>
                                            <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef); ?>
                                        </span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <ul aria-labelledby="language_picker_des_<?php echo $module->id; ?>" class="mod-languages__list <?php echo $params->get('inline', 1) ? 'lang-inline' : 'lang-block'; ?>">

    <?php foreach ($list as $language) : ?>
        <?php
            $lbl = '';
        if ((($params->get('full_name') === 0) && ($params->get('image') === 0)) || (!$language->image)) {
            $lbl = 'aria-label="' . $language->title_native . '"';
        }
        ?>
        <?php if (!$language->active) : ?>
            <li>
            <a class="list-item" <?php echo $lbl; ?> href="<?php echo htmlspecialchars_decode(htmlspecialchars($language->link, ENT_QUOTES, 'UTF-8'), ENT_NOQUOTES); ?>">
                    <span><?php if ($params->get('image', 1)) : ?>
                        <?php if ($language->image) : ?>
                            <?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, ['title' => $language->title_native], true); ?>
                        <?php else : ?>
                            <span class="label" title="<?php echo $language->title_native; ?>"><?php echo strtoupper($language->sef); ?></span>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef); ?>
                    <?php endif; ?>
                    </span>
                </a>
            </li>
        <?php elseif ($params->get('show_active', 1)) : ?>
            <?php $base = Uri::getInstance(); ?>
            <li class="lang-active">
                <span><a aria-current="true" <?php echo $lbl; ?> href="<?php echo htmlspecialchars_decode(htmlspecialchars($base, ENT_QUOTES, 'UTF-8'), ENT_NOQUOTES); ?>">
                    <?php if ($params->get('image', 1)) : ?>
                        <?php if ($language->image) : ?>
                            <?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $language->title_native, ['title' => $language->title_native], true); ?>
                        <?php else : ?>
                            <span class="badge bg-secondary" title="<?php echo $language->title_native; ?>"><?php echo strtoupper($language->sef); ?></span>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php echo $params->get('full_name', 1) ? $language->title_native : strtoupper($language->sef); ?>
                    <?php endif; ?>
                </span>
                </a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php if ($footerText) : ?>
    <div class="mod-languages__posttext posttext"><p><?php echo $footerText; ?></p></div>
<?php endif; ?>
</div>
