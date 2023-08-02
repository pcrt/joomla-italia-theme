<?php
/**
 *   Protocolli Creativi - Realease Team
 *   @copyright Copyright(c) 2016-2023 Protocolli Creativi s.r.l
 *   @version 1.2.1
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$item = $displayData;

if ($item->language === '*') {
    echo Text::alt('JALL', 'language');
} elseif ($item->language_image) {
    echo HTMLHelper::_('image', 'mod_languages/' . $item->language_image . '.gif', '', ['class' => 'me-1'], true) . htmlspecialchars($item->language_title, ENT_COMPAT, 'UTF-8');
} elseif ($item->language_title) {
    echo htmlspecialchars($item->language_title, ENT_COMPAT, 'UTF-8');
} else {
    echo Text::_('JUNDEFINED');
}
