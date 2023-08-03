<?php
/**
 *   Protocolli Creativi - Realease Team
 *   @copyright Copyright(c) 2016-2023 Protocolli Creativi s.r.l
 *   @version 1.2.1
 */

defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   integer  $level  The level of the item in the tree like structure.
 *
 * @since  3.6.0
 */

if ($level > 1) {
    echo '<span class="text-muted">' . str_repeat('&#8942;&nbsp;&nbsp;&nbsp;', (int) $level - 2) . '</span>&ndash;&nbsp;';
}
