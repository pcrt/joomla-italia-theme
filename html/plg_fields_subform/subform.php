<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Subform
 *
 * @copyright   (C) 2019 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;

$document = JFactory::getDocument();
$document->addScript('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js');
$document->addStyleSheet('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');


if (!$context || empty($field->subform_rows)) {
    return;
}

$result = '';
$resultdefault = '';
// Titolo del subform
$label = $field->label;


$subformContainerClass = $field->params->get('prefix', '');

$subformResultClass = $field->params->get('suffix', '');

// Iterate over each row that we have
foreach ($field->subform_rows as $subform_row) {
    // Placeholder array to generate this rows output
    $row_output = [];

    // Iterate over each sub field inside of that row
    foreach ($subform_row as $subfield) {
        $class   = trim($subfield->params->get('render_class', ''));
        $layout  = trim($subfield->params->get('layout', 'render'));
        $content = trim(
            FieldsHelper::render(
                $context,
                'field.' . $layout, // normally just 'field.render'
                ['field' => $subfield]
            )
        );

        // Skip empty output
        if ($content === '') {
            continue;
        }

        // Generate the output for this sub field and row
        $row_output[] = $content;
    }

    // Skip empty rows
    if (count($row_output) == 0) {
        continue;
    }

    $resultdefault .= implode('', $row_output);

    $result .= sprintf('<div class="calendar-date %s">%s</div>', ($subformResultClass ? (' ' . $subformResultClass) : ''), implode('', $row_output));
}


// determino le coordinate GPS (l'etichetta custom field deve chiamarsi GPS)
foreach ($subform_row as $subfield) {
    if (strtolower($subfield->title) == 'gps') {
        $gps = $subfield->value;
    }
    if (strtolower($subfield->title) == 'nome sede') {
        $nomeluogo = $subfield->value;
    }
}



?>

<?php if (trim($result) != '') : ?>
    <?php if($label == 'Calendario tempi e scadenze' || $label == 'Date e Orari'):?>
        <div class="calendar-vertical mb-5" data-element="service-calendar-list">
                <?php echo $result; ?>
        </div>
    <?php elseif($label == 'Luoghi in cui viene erogato il servizio' || $label == 'Dove si trova' || $label == 'Sede' || $label == 'Luogo'): ?> 
        <div class="card card-bg rounded mb-5">
            <div class="card-body">
            <div class="row">
                <div class="col-lg-5 pe-0 pt-0">
                    <div id="mappaluogo"></div>
                    <script>
                        var map = L.map('mappaluogo',{scrollWheelZoom:false}).setView([<?php echo $gps; ?>], 13);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            L.marker([<?php echo $gps; ?>]).addTo(map)
                                .bindPopup('<?php echo $nomeluogo; ?>')
                                .openPopup();
                    </script>
                </div>
                <div class="col-lg-7">
                    <ul data-element="places" class="location-list mt-2">
                        <?php echo $resultdefault; ?>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif($label == 'Allegati' || $label == 'Documenti'): ?> 
        <div class="row mb-5">
            <?php echo $resultdefault; ?>
        </div>
    <?php else : ?> 

        <?php echo $resultdefault; ?>
  
    <?php endif; ?>

<?php endif; ?>


