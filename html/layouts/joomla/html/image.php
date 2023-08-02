<?php
/**
 *   Protocolli Creativi - Realease Team
 *   @copyright Copyright(c) 2016-2023 Protocolli Creativi s.r.l
 *   @version 1.2.1
 */

/**
 * Layout variables
 * -----------------
 * @var   array  $displayData  Array with all the given attributes for the image element.
 *                             Eg: src, class, alt, width, height, loading, decoding, style, data-*
 *                             Note: only the alt and src attributes are escaped by default!
 */
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Utilities\ArrayHelper;

$img = HTMLHelper::_('cleanImageURL', $displayData['src']);

$displayData['src'] = $this->escape($img->url);

if (isset($displayData['alt'])) {
    if ($displayData['alt'] === false) {
        unset($displayData['alt']);
    } else {
        $displayData['alt'] = $this->escape($displayData['alt']);
    }
}

if ($img->attributes['width'] > 0 && $img->attributes['height'] > 0) {
    $displayData['width']  = $img->attributes['width'];
    $displayData['height'] = $img->attributes['height'];

    if (empty($displayData['loading'])) {
        $displayData['loading'] = 'lazy';
    }
}

echo '<img ' . ArrayHelper::toString($displayData) . ' class="img-fluid">';
