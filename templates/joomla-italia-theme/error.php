<?php

/**
 * Pagina di errore del tema (issue #53): intestazione con logo e menu, messaggio in italiano
 * con il codice dell'errore, pulsante per tornare alla homepage e piè di pagina, con la
 * grafica di Bootstrap Italia. Joomla la usa al posto di templates/system/error.php per
 * ogni errore (404, 403, 500...). Se esistono moduli nella posizione "error-<codice>"
 * (es. error-404) vengono mostrati al posto del testo predefinito, come nel template di
 * sistema.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\ErrorDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

if (!isset($this->error)) {
    $this->error = new \Exception(Text::_('JERROR_ALERTNOAUTHOR'));
    $this->debug = false;
}

$codice        = (int) $this->error->getCode();
$baseImagePath = Uri::root(false) . 'media/templates/site/' . $this->template . '/images/';

// Il renderer dei moduli non funziona se l'applicazione non è stata inizializzata del tutto
// (per esempio un errore durante l'avvio): in quel caso la pagina esce senza menu e moduli.
$renderModules = $app->getIdentity() && $app->getLanguage();

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$this->setMetaData('theme-color', '#ffffff');

// Favicon: quella impostata nei parametri del template (issue #60) o quella predefinita di Joomla
require __DIR__ . '/includes/favicon.php';

$wa->usePreset('template.joomla-italia-theme')
    ->useStyle('css.fontawesome')
    ->useStyle('css.fonts')
    ->useStyle('template.css.pcrt-main')
    ->useStyle('template.css.pcrt-menu')
    ->useStyle('template.css.pcrt-jit')
    ->useStyle('css.table');

// user.css e user.js del sito, se esistono (issue #47)
require __DIR__ . '/includes/user_assets.php';

// Titolo e testo in base al codice dell'errore
switch ($codice) {
    case 404:
        $titoloErrore = Text::_('TPL_PCRT_ERROR_404_TITLE');
        $testoErrore  = Text::_('TPL_PCRT_ERROR_404_TEXT');
        break;

    case 401:
    case 403:
        $titoloErrore = Text::_('TPL_PCRT_ERROR_403_TITLE');
        $testoErrore  = Text::_('TPL_PCRT_ERROR_403_TEXT');
        break;

    default:
        $titoloErrore = Text::_('TPL_PCRT_ERROR_GENERIC_TITLE');
        $testoErrore  = Text::_('TPL_PCRT_ERROR_GENERIC_TEXT');
        break;
}

$this->setTitle($codice . ' - ' . $titoloErrore);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="pagina-errore">
<a class="visually-hidden-focusable p-2 m-2 d-inline-block" href="#main-content"><?php echo Text::_('TPL_PCRT_SKIP_TO_CONTENT'); ?></a>
<header class="it-header-wrapper">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <?php if ($this->params->get('showTopBarMessage')) : ?>
              <a class="d-lg-block navbar-brand" href="<?php echo htmlspecialchars($this->params->get('topbarTitleLink')); ?>"><?php echo htmlspecialchars($this->params->get('topbarTitle')); ?></a>
            <?php endif; ?>
            <div class="it-header-slim-right-zone">
              <?php if ($this->params->get('showBtnTopbar')) : ?>
                <?php foreach ((array) $this->params->get('showBtnTopbarFields', []) as $value) : ?>
                  <a class="btn btn-icon btn-full" href="<?php echo htmlspecialchars($value->topbarbuttonlink); ?>" aria-label="<?php echo htmlspecialchars($value->topbarbuttontitle); ?>">
                    <span class="rounded-icon">
                      <svg class="icon icon-primary">
                        <use xlink:href="<?php echo $baseImagePath; ?>sprites.svg#<?php echo htmlspecialchars($value->topbarbuttonicon); ?>"></use>
                      </svg>
                    </span>
                    <span class="d-none d-lg-block"><?php echo htmlspecialchars($value->topbarbuttontitle); ?></span>
                  </a>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                      <div class="it-brand-title"><?php echo htmlspecialchars($app->get('sitename')); ?></div>
                    </div>
                  <?php endif; ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if ($renderModules && ($this->countModules('menuprincipale') || $this->countModules('menusecondario'))) : ?>
    <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-lg has-megamenu" aria-label="Navigazione principale">
              <button
                class="custom-navbar-toggler"
                type="button"
                aria-controls="nav4"
                aria-expanded="false"
                aria-label="Mostra/Nascondi la navigazione"
                data-bs-target="#nav4"
                data-bs-toggle="navbarcollapsible"
              >
                <svg class="icon">
                  <use href="<?php echo $baseImagePath; ?>sprites.svg#it-burger"></use>
                </svg>
              </button>
              <div class="navbar-collapsable" id="nav4" style="display: none">
                <div class="overlay" style="display: none"></div>
                <div class="close-div">
                  <button class="btn close-menu" type="button">
                    <span class="visually-hidden">Nascondi la navigazione</span>
                    <svg class="icon">
                      <use href="<?php echo $baseImagePath; ?>sprites.svg#it-close-big"></use>
                    </svg>
                  </button>
                </div>
                <div class="menu-wrapper">
                  <jdoc:include type="modules" name="menuprincipale" style="none" />
                  <jdoc:include type="modules" name="menusecondario" style="none" />
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</header>
<main id="main-content" tabindex="-1">
  <section class="section py-5">
    <div class="container">
      <?php if ($renderModules && $this->countModules('error-' . $codice)) : ?>
        <jdoc:include type="modules" name="error-<?php echo $codice; ?>" style="none" />
      <?php else : ?>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 text-center py-5">
            <p class="text-uppercase small fw-semibold mb-2"><?php echo Text::sprintf('TPL_PCRT_ERROR_CODE', $codice); ?></p>
            <h1 class="mb-4"><?php echo $titoloErrore; ?></h1>
            <p class="lead"><?php echo $testoErrore; ?></p>
            <p class="mt-4">
              <a class="btn btn-primary" href="<?php echo Uri::root(true); ?>/"><?php echo Text::_('TPL_PCRT_ERROR_HOME'); ?></a>
            </p>
            <p class="text-muted small mt-5">
              <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
              <?php if ($this->debug) : ?>
                <br><?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8'); ?>:<?php echo $this->error->getLine(); ?>
              <?php endif; ?>
            </p>
          </div>
        </div>
      <?php endif; ?>
      <?php if ($this->debug) : ?>
        <div class="text-start small">
          <?php echo $this->renderBacktrace(); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<footer class="footersito">
  <div class="container">
  <?php if ($this->params->get('showLoghiFooter') || $this->params->get('showLogoEuropa')) : ?>
    <div class="row mb-5">
      <div class="col-12 logos-wrapper">
        <?php if ($this->params->get('showLogoEuropa')) : ?>
          <img class="ue-logo" src="<?php echo htmlspecialchars($this->params->get('imageLogoEuropaFooter')); ?>" alt="<?php echo htmlspecialchars($this->params->get('logoFooterEuropaDescrizione')); ?>">
        <?php endif; ?>
        <?php if ($this->params->get('showLoghiFooter')) : ?>
        <div class="logo-footer">
          <a href="<?php echo Uri::root(true); ?>/" data-focus-mouse="false">
            <img src="<?php echo htmlspecialchars($this->params->get('imageLogoFooter')); ?>" alt="<?php echo htmlspecialchars($this->params->get('logoFooterTitle') ?: 'Vai alla homepage'); ?>">
          </a>
          <p class="h1">
              <span><?php echo htmlspecialchars($this->params->get('logoFooterTopTitle')); ?></span>
              <span>
                <strong><?php echo htmlspecialchars($this->params->get('logoFooterTitle')); ?></strong>
              </span>
              <span><?php echo htmlspecialchars($this->params->get('logoFooterSubtitle')); ?></span>
          </p>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if ($renderModules) : ?>
    <div class="row">
      <div class="col-6 col-lg-3 pb-3 pb-lg-0">
        <jdoc:include type="modules" name="footer1" style="footer" />
      </div>
      <div class="col-6 col-lg-3 pb-3 pb-lg-0">
        <jdoc:include type="modules" name="footer2" style="footer" />
      </div>
      <div class="col-6 col-lg-3 pb-3 pb-lg-0">
        <jdoc:include type="modules" name="footer3" style="footer" />
      </div>
      <div class="col-6 col-lg-3 pb-3 pb-lg-0">
        <jdoc:include type="modules" name="footer4" style="footer" />
      </div>
    </div>
    <?php if ($this->countModules('arealegale')) : ?>
      <div class="area-legale"><jdoc:include type="modules" name="arealegale" style="none" /></div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
  <div class="copyright mt-3 py-4 mt-lg-5">
    <div class="container text-center">
    <?php if ($this->params->get('showCopyright')) : ?>
        <?php $descCopyright = (string) $this->params->get('descCopyright'); ?>
        <?php if (stripos($descCopyright, '<p') === false) : ?>
        <p><?php echo $descCopyright; ?></p>
        <?php else : ?>
        <?php echo $descCopyright; ?>
        <?php endif; ?>
    <?php endif ?>
    </div>
  </div>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 text-right footer-credits">
        <a href="https://www.protocollicreativi.it" target="_blank" rel="nofollow" title="Protocolli Creativi is a Joomla Provider">Made with love Italia Theme for Joomla by Protocolli Creativi</a>
      </div>
    </div>
  </div>
</footer>
<?php if ($renderModules) : ?>
<jdoc:include type="modules" name="debug" style="none" />
<?php endif; ?>
</body>
</html>
