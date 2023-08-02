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


$time  = strtotime($value);
$day   = date('d', $time);
$month = date('M', $time);
$year  = date('Y', $time);


?>


<div class="calendar-date-day purplelight">
    <small><?php echo $year; ?></small>
    <p class="mb-0"><?php echo $day; ?></p>
    <small><?php echo $month; ?></small>
</div>


