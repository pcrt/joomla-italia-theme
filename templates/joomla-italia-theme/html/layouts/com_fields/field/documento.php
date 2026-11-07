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

// Issue #38: l'icona segue il tipo del file collegato (prima era sempre quella del PDF).
// Si cerca il primo collegamento nel valore (href="..."), altrimenti un percorso nudo, e si
// legge l'estensione, ignorando la query string. Senza estensione riconosciuta resta il PDF.
$icona = 'it-file-pdf';

if (preg_match('/href\s*=\s*["\']([^"\']+)["\']/i', $value, $m) || preg_match('#(?:^|\s)((?:https?://|/)?[^\s<>"\']+\.[a-z0-9]{2,5})(?:\?|$|\s)#i', strip_tags($value), $m)) {
    $percorso   = (string) parse_url(html_entity_decode($m[1], ENT_QUOTES, 'UTF-8'), PHP_URL_PATH);
    $estensione = strtolower(pathinfo($percorso, PATHINFO_EXTENSION));
    $iconePerTipo = [
        'pdf'  => 'it-file-pdf',
        'doc'  => 'it-file-odt', 'docx' => 'it-file-odt', 'odt' => 'it-file-odt', 'rtf' => 'it-file-odt',
        'xls'  => 'it-file-sheet', 'xlsx' => 'it-file-sheet', 'ods' => 'it-file-ods',
        'ppt'  => 'it-file-slides', 'pptx' => 'it-file-slides', 'odp' => 'it-file-odp',
        'csv'  => 'it-file-csv', 'txt' => 'it-file-txt', 'xml' => 'it-file-xml', 'json' => 'it-file-json',
        'zip'  => 'it-file-compressed', 'rar' => 'it-file-compressed', '7z' => 'it-file-compressed', 'gz' => 'it-file-compressed', 'tar' => 'it-file-compressed',
        'mp3'  => 'it-file-audio', 'wav' => 'it-file-audio', 'ogg' => 'it-file-audio', 'm4a' => 'it-file-audio',
        'mp4'  => 'it-file-video', 'webm' => 'it-file-video', 'mov' => 'it-file-video', 'avi' => 'it-file-video',
        'jpg'  => 'it-file', 'jpeg' => 'it-file', 'png' => 'it-file', 'gif' => 'it-file', 'svg' => 'it-file', 'webp' => 'it-file',
    ];

    if ($estensione !== '') {
        $icona = $iconePerTipo[$estensione] ?? 'it-file';
    }
}

?>

<div class="col-12 col-lg-6 mb-4">
    <div class="card card-documento card-bg card-icon rounded h-100">
            <div class="card-body">
                <svg class="icon">
                    <use xlink:href="<?= $baseImagePath ?>sprites.svg#<?= $icona ?>"></use>
                </svg>
                <div class="card-icon-content">
                    <strong><?php echo $value; ?></strong>
                </div>
            </div>
    </div>
</div>
