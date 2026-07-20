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

<li>
<?php if ($showLabel == 1) : ?>
    <div class="location-title">
        <span><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></span>
    </div>
    <?php endif; ?>
    <div class="location-content">
        <p><?php echo str_replace(['<p>', '</p>'], '', $value); ?></p>
    </div>
</li>

