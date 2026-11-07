<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Voce di menu "Lista di tutti i tag" (issue #95): intestazione, descrizione ed elenco dei
 * tag come schede, con la grafica di Bootstrap Italia. Le opzioni della voce di menu valgono
 * come nel layout del core.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

/** @var \Joomla\Component\Tags\Site\View\Tags\HtmlView $this */

$description      = $this->params->get('all_tags_description');
$descriptionImage = $this->params->get('all_tags_description_image');
?>
<div class="container py-5">
    <div class="com-tags tag-category argomenti-elenco">
        <?php if ($this->params->get('show_page_heading')) : ?>
            <h1 class="mb-4">
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            </h1>
        <?php endif; ?>
        <?php if ($this->params->get('all_tags_show_description_image') && !empty($descriptionImage)) : ?>
            <div class="com-tags__image mb-4">
                <?php echo HTMLHelper::_('image', $descriptionImage, empty($this->params->get('all_tags_description_image_alt')) && empty($this->params->get('all_tags_description_image_alt_empty')) ? false : $this->params->get('all_tags_description_image_alt')); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($description)) : ?>
            <div class="com-tags__description lead mb-4">
                <?php echo $description; ?>
            </div>
        <?php endif; ?>
        <?php echo $this->loadTemplate('items'); ?>
    </div>
</div>
