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

// Ottengo l'ID del campo
$fieldid = $field->id;

if ($value == '') {
    return;
}

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

?>
<?php if ($showLabel == 1) : ?>
    <h4 id="art-par-<?php echo $fieldid; ?>" class="mb-3"><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></h4>
<?php endif; ?>
<div class="row mb-5">
    <div class="col-lg-9">
        <div class="big-data-rounded-icon">
            <div class="big-data-rounded-icon-wrapper">
                <svg>
                    <use xlink:href="<?= $baseImagePath ?>sprites.svg#it-map-marker"></use>
                </svg>
            </div>
            <div class="big-data-rounded-icon-content">

                <?php echo $value; ?>
            </div>
        </div>
    </div>
</div>
