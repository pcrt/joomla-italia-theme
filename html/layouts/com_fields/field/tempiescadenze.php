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

<?php
// Aggiungo data element
    switch ($label) :
        case 'Cos\'è':
            $dtelm = 'data-element="service-what-is"';
            break;
        case 'A cosa serve':
            $dtelm = 'data-element="used-for"';
            break;
        case 'Cosa serve':
            $dtelm = 'data-element="service-needed"';
            break;
        case 'Tempi e scadenze':
            $dtelm = 'data-element="service-calendar-text"';
            break;
        case 'Ulteriori informazioni':
            $dtelm = 'data-element="service-more-info"';
            break;
        default:
            $dtelm = '';
    endswitch;

// Aggiungo ID per il menu indice
switch ($label) :
    case 'Cos\'è':
        $idelm = 'id="art-par-01"';
        break;
    case 'Cosa serve':
        $idelm = 'id="art-par-03"';
        break;
    case 'Tempi e scadenze':
        $idelm = 'id="art-par-04"';
        break;
    case 'Ulteriori informazioni':
        $idelm = 'id="art-par-06"';
        break;
    default:
        $idelm = '';
endswitch;

?>

<div class="cosae">
    <h2 class="h4 <?php echo $labelClass; ?>" <?php echo $idelm; ?>><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></h2>    
    <p <?php echo $dtelm; ?>>
        <?php if ($prefix) : ?>
            <span class="field-prefix"><?php echo htmlentities($prefix, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></span>
        <?php endif; ?>
        <?php echo $value; ?>
        <?php if ($suffix) : ?>
            <span class="field-suffix"><?php echo htmlentities($suffix, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></span>
        <?php endif; ?>
    </p>
</div>
