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

// Aggiungo il data element
switch ($label) :
    case 'Come si accede al servizio':
        $dtelm = 'data-element="service-generic-access"';
        break;
    default:
        $dtelm = '';
endswitch;

// Aggiungo ID per il menu indice
switch ($label) :
    case 'Come si accede al servizio':
        $idelm = 'id="art-par-02"';
        break;
    default:
        $idelm = 'id="art-par-'.$fieldid.'"';
endswitch;

?>
<div>


<?php if ($showLabel == 1) : ?>
    <h2 class="h4 <?php echo $labelClass; ?>" <?php echo $idelm; ?>><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></h2>   
<?php endif; ?>
<?php if ($prefix) : ?>
    <span class="field-prefix"><?php echo htmlentities($prefix, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></span>
<?php endif; ?>
<p <?php echo $dtelm; ?>><?php echo $value; ?></p>
<?php if ($suffix) : ?>
    <span class="field-suffix"><?php echo htmlentities($suffix, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></span>
<?php endif; ?>
</div>
