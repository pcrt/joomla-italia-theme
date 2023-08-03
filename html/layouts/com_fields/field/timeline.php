<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_fields
 *
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

if (!array_key_exists('field', $displayData)) {
    return;
}

$field = $displayData['field'];
$label = Text::_($field->label);
$value = $field->value;
$showLabel = $field->params->get('showlabel');
$prefix = Text::plural($field->params->get('prefix'), $value);
$suffix = Text::plural($field->params->get('suffix'), $value);
$labelClass = $field->params->get('label_render_class');
$valueClass = $field->params->get('value_render_class');

// Ottengo l'ID del campo
$fieldid = $field->id;

if ($value == '') {
    return;
}

?>

<div class="bg-blue-dark section section-padding timeline">
    <div class="container">

        <div class="it-carousel-wrapper it-carousel-landscape-abstract-three-cols it-carousel-landscape-abstract-three-cols-arrow-visible splide" data-bs-carousel-splide>
            <?php if ($showLabel == 1) : ?>
            <div class="it-header-block">
                <div class="it-header-block-title text-center">
                    <h3 class="mb-4"><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></h2>
                </div>
            </div>
            <?php endif; ?>
            <div class="splide__track ps-lg-3 pe-lg-3">
                <ul class="splide__list it-carousel-all">
                <?php foreach($field->subform_rows as $row) { ?>
                    <li class="splide__slide">
                        <div class="it-single-slide-wrapper">
                            <div class="card-wrapper card-space" style="background:unset!important;">
                                <div class="card card-serif card-bg" style="background:unset!important;">
                                    <div class="card-body">

                                        <?php
                                            $i=0;
                    foreach((array) $row as $subrow): ?>
                                                <?php if($i == 0): ?>
                                                    <div class="h5"><?php echo $subrow->value; ?></div>
                                                <?php elseif($i == 1): ?>
                                                    <h3><?php echo $subrow->value; ?></h3>
                                                <?php elseif($i == 2): ?>
                                                    <p><?php echo $subrow->value; ?></p>
                                                <?php endif; ?>
                                                    
                                        <?php
                    $i++;
                    endforeach;
                    ?>

  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>  
                <?php } ?>
                </ul>
            </div>      
        </div>
    </div>
</div>
