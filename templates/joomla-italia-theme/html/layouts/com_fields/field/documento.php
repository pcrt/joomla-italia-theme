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
use Joomla\CMS\Uri\Uri;

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

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

?>

<div class="col-12 col-lg-6 mb-4">
    <div class="card card-documento card-bg card-icon rounded h-100">
            <div class="card-body">
                <svg class="icon">
                    <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-file-pdf"></use>
                </svg>
                <div class="card-icon-content">
                    <strong><?php echo $value; ?></strong>
                </div>
            </div>
    </div>
</div>
