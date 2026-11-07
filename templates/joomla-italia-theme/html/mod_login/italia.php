<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Layout "italia" del modulo di accesso (issue #49): il modulo nativo di Joomla con la
 * grafica di Bootstrap Italia, in una scheda centrata dentro un contenitore. Pensato per le
 * posizioni "below" e "user", che non aggiungono contenitori. Si sceglie dal campo Layout del
 * modulo (Avanzate); il layout predefinito resta quello del core.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

$app->getDocument()->getWebAssetManager()
    ->useScript('core')
    ->useScript('keepalive')
    ->useScript('field.passwordview');

Text::script('JSHOWPASSWORD');
Text::script('JHIDEPASSWORD');

$usersConfig = ComponentHelper::getParams('com_users');
?>
<div class="container py-5 mod-login-italia">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card card-bg rounded">
                <div class="card-body">
                    <?php if ((bool) $module->showtitle) : ?>
                        <h2 class="h4 mb-4"><?php echo $module->title; ?></h2>
                    <?php endif; ?>
                    <form id="login-form-<?php echo $module->id; ?>" class="mod-login" action="<?php echo Route::_('index.php', true); ?>" method="post">

                        <?php if ($params->get('pretext')) : ?>
                            <div class="mod-login__pretext pretext mb-3">
                                <p><?php echo $params->get('pretext'); ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="modlgn-username-<?php echo $module->id; ?>" class="active"><?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
                            <input id="modlgn-username-<?php echo $module->id; ?>" type="text" name="username" class="form-control" autocomplete="username" autocapitalize="none">
                        </div>

                        <div class="form-group">
                            <label for="modlgn-passwd-<?php echo $module->id; ?>" class="active"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
                            <div class="input-group">
                                <input id="modlgn-passwd-<?php echo $module->id; ?>" type="password" name="password" autocomplete="current-password" class="form-control">
                                <button type="button" class="btn btn-secondary input-password-toggle">
                                    <span class="icon-eye icon-fw" aria-hidden="true"></span>
                                    <span class="visually-hidden"><?php echo Text::_('JSHOWPASSWORD'); ?></span>
                                </button>
                            </div>
                        </div>

                        <?php if (PluginHelper::isEnabled('system', 'remember')) : ?>
                            <div class="form-check mb-3">
                                <input type="checkbox" name="remember" value="yes" id="form-login-input-remember-<?php echo $module->id; ?>">
                                <label for="form-login-input-remember-<?php echo $module->id; ?>"><?php echo Text::_('MOD_LOGIN_REMEMBER_ME'); ?></label>
                            </div>
                        <?php endif; ?>

                        <?php foreach ($extraButtons as $button) :
                            $dataAttributeKeys = array_filter(array_keys($button), function ($key) {
                                return substr($key, 0, 5) == 'data-';
                            });
                            ?>
                            <div class="mod-login__submit mb-3">
                                <button type="button"
                                        class="btn btn-outline-primary w-100 <?php echo $button['class'] ?? '' ?>"
                                        <?php foreach ($dataAttributeKeys as $key) : ?>
                                            <?php echo $key ?>="<?php echo $button[$key] ?>"
                                        <?php endforeach; ?>
                                        <?php if ($button['onclick']) : ?>
                                        onclick="<?php echo $button['onclick'] ?>"
                                        <?php endif; ?>
                                        title="<?php echo Text::_($button['label']) ?>"
                                        id="<?php echo $button['id'] ?>"
                                        >
                                    <?php if (!empty($button['icon'])) : ?>
                                        <span class="<?php echo $button['icon'] ?>"></span>
                                    <?php elseif (!empty($button['image'])) : ?>
                                        <?php echo $button['image']; ?>
                                    <?php elseif (!empty($button['svg'])) : ?>
                                        <?php echo $button['svg']; ?>
                                    <?php endif; ?>
                                    <?php echo Text::_($button['label']) ?>
                                </button>
                            </div>
                        <?php endforeach; ?>

                        <div class="mod-login__submit mb-3">
                            <button type="submit" name="Submit" class="btn btn-primary w-100"><?php echo Text::_('JLOGIN'); ?></button>
                        </div>

                        <ul class="mod-login__options list-unstyled small mb-0">
                            <?php if ($params->get('showPasswordReset', 1)) : ?>
                            <li>
                                <a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>"><?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
                            </li>
                            <?php endif; ?>
                            <?php if ($params->get('showUsernameReminder', 1)) : ?>
                            <li>
                                <a href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>"><?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
                            </li>
                            <?php endif; ?>
                            <?php if ($usersConfig->get('allowUserRegistration')) : ?>
                            <li>
                                <a href="<?php echo Route::_($registerLink); ?>"><?php echo Text::_('MOD_LOGIN_REGISTER'); ?></a>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <input type="hidden" name="option" value="com_users">
                        <input type="hidden" name="task" value="user.login">
                        <input type="hidden" name="return" value="<?php echo $return; ?>">
                        <?php echo HTMLHelper::_('form.token'); ?>

                        <?php if ($params->get('posttext')) : ?>
                            <div class="mod-login__posttext posttext mt-3">
                                <p><?php echo $params->get('posttext'); ?></p>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
