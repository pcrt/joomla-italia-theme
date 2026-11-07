<?php

/**
 * Pagina "sito offline" del tema (issue #54): intestazione con logo e nome della scuola,
 * messaggio di manutenzione impostato in Configurazione globale e modulo di accesso per chi
 * ha il permesso di entrare a sito spento, con la grafica di Bootstrap Italia. Joomla la usa
 * al posto di templates/system/offline.php quando il sito è offline.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

$baseImagePath = Uri::root(false) . 'media/templates/site/' . $this->template . '/images/';
$sitename      = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$this->setMetaData('theme-color', '#ffffff');

// Favicon: quella impostata nei parametri del template (issue #60) o quella predefinita di Joomla
require __DIR__ . '/includes/favicon.php';

$wa->usePreset('template.joomla-italia-theme')
    ->useStyle('css.fontawesome')
    ->useStyle('css.fonts')
    ->useStyle('template.css.pcrt-main')
    ->useStyle('template.css.pcrt-menu')
    ->useStyle('template.css.pcrt-jit');

// user.css e user.js del sito, se esistono (issue #47)
require __DIR__ . '/includes/user_assets.php';

// Messaggio di manutenzione: personalizzato o predefinito, come nel template di sistema
$messaggio = '';

if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) !== '') {
    $messaggio = $app->get('offline_message');
} elseif ($app->get('display_offline_message', 1) == 2 && str_replace(' ', '', Text::_('JOFFLINE_MESSAGE')) !== '') {
    $messaggio = Text::_('JOFFLINE_MESSAGE');
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="pagina-offline">
<header class="it-header-wrapper">
  <?php if ($this->params->get('showTopBarMessage')) : ?>
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <a class="d-lg-block navbar-brand" href="<?php echo htmlspecialchars($this->params->get('topbarTitleLink')); ?>"><?php echo htmlspecialchars($this->params->get('topbarTitle')); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <div class="it-nav-wrapper">
    <div class="it-header-center-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="it-header-center-content-wrapper">
              <div class="it-brand-wrapper">
                <a href="<?php echo Uri::root(true); ?>/">
                  <?php if ($this->params->get('showLogo')) : ?>
                    <img src="<?php echo htmlspecialchars($this->params->get('imageLogo')); ?>" alt="" class="icon">
                    <div class="it-brand-text">
                      <div class="it-brand-tagline"><?php echo htmlspecialchars($this->params->get('logoTopTitle')); ?></div>
                      <div class="it-brand-title"><?php echo htmlspecialchars($this->params->get('logoTitle')); ?></div>
                      <div class="it-brand-tagline"><?php echo htmlspecialchars($this->params->get('logoSubtitle')); ?></div>
                    </div>
                  <?php else : ?>
                    <div class="it-brand-text">
                      <div class="it-brand-title"><?php echo $sitename; ?></div>
                    </div>
                  <?php endif; ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<main id="main-content" tabindex="-1">
  <section class="section py-5">
    <div class="container">
      <jdoc:include type="message" />
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
          <div class="text-center mb-5">
            <?php if ($app->get('offline_image') && file_exists($app->get('offline_image'))) : ?>
              <img class="img-fluid mb-4" src="<?php echo htmlspecialchars($app->get('offline_image')); ?>" alt="<?php echo $sitename; ?>">
            <?php endif; ?>
            <h1 class="mb-3"><?php echo $sitename; ?></h1>
            <?php if ($messaggio !== '') : ?>
              <p class="lead"><?php echo $messaggio; ?></p>
            <?php endif; ?>
          </div>
          <div class="card card-bg rounded">
            <div class="card-body">
              <h2 class="h4 mb-4"><?php echo Text::_('TPL_PCRT_OFFLINE_LOGIN_TITLE'); ?></h2>
              <form action="<?php echo Route::_('index.php', true); ?>" method="post" id="form-login">
                <div class="form-group">
                  <label for="username" class="active"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
                  <input name="username" id="username" type="text" class="form-control" autocomplete="username" autocapitalize="none">
                </div>
                <div class="form-group">
                  <label for="passwd" class="active"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
                  <input type="password" name="password" class="form-control" id="passwd" autocomplete="current-password">
                </div>
                <button type="submit" name="Submit" class="btn btn-primary"><?php echo Text::_('JLOGIN'); ?></button>
                <input type="hidden" name="option" value="com_users">
                <input type="hidden" name="task" value="user.login">
                <input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>">
                <?php echo HTMLHelper::_('form.token'); ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<footer class="footersito">
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 text-right footer-credits">
        <a href="https://www.protocollicreativi.it" target="_blank" rel="nofollow" title="Protocolli Creativi is a Joomla Provider">Made with love Italia Theme for Joomla by Protocolli Creativi</a>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
