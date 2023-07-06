<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_fields
 *
 * @copyright   (C) 2016 Open Source Matters, Inc.
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

// Aggiungo ID per il menu indice
switch ($label) :
    case 'Modalità di accesso':
        $idelm = 'id="art-par-05"';
        break;
    default:
        $idelm = 'id="art-par-'.$fieldid.'"';
endswitch;

?>
<?php if ($showLabel == 1) : ?>
    <h2 class="h4 <?php echo $labelClass; ?>" <?php echo $idelm; ?>><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?> </h2>
<?php endif; ?>
<div class="card card-servizi card-bg card-icon rounded h-100">
    <div class="card-body">
        <svg class="icon">
            <use xlink:href="<?= $baseImagePath ?>/templates/joomla-italia-theme/svg/sprites.svg#it-pa"></use>
        </svg>
        <div class="card-icon-content">
            <?php echo $value; ?>
        </div>
    </div>
</div>
<div class="mt-5"></div>