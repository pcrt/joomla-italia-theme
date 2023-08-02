<?php
/**
 *   Protocolli Creativi - Realease Team
 *   @copyright Copyright(c) 2016-2023 Protocolli Creativi s.r.l
 *   @version 1.2.1
 */

defined('_JEXEC') or die;

/** @var \Joomla\Component\Users\Site\View\Login\HtmlView $this */

$cookieLogin = $this->user->get('cookieLogin');

if (!empty($cookieLogin) || $this->user->get('guest')) {
    // The user is not logged in or needs to provide a password.
    echo $this->loadTemplate('login');
} else {
    // The user is already logged in.
    echo $this->loadTemplate('logout');
}
