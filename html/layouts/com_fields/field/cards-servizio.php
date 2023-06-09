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

if ($value == '') {
    return;
}

?>

<div class="card card-bg card-servizio purplelight rounded mb-3">
    <div class="card-body pb-0">
        <?php if ($showLabel == 1) : ?>
            <span class="field-label <?php echo $labelClass; ?>"><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?>: </span>
        <?php endif; ?>
        <?php if ($prefix) : ?>
            <span class="field-prefix"><?php echo htmlentities($prefix, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></span>
        <?php endif; ?>
       <?php echo $value; ?>
        <?php if ($suffix) : ?>
            <span class="field-suffix"><?php echo htmlentities($suffix, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></span>
        <?php endif; ?>
     </div>
</div>