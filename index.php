<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app   = Factory::getApplication();
$input = $app->getInput();
$wa    = $this->getWebAssetManager();
$menu  = $app->getMenu()->getActive();
$isHomePage = ($menu->home);
$credits = '<a href="https://www.protocollicreativi.it" target="_blank" rel="nofollow" title="Protocolli Creativi is a Joomla Provider">Made with love Joomla Italia Theme by Protocolli Creativi</a>';
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

$baseImagePath= Uri::root(false) . "media/templates/site/" . $this->template . "/images/";

$this->setMetaData('viewport', 'width=device-width, initial-scale=1, minimum-scale=1');
$this->setMetaData('theme-color', '#ffffff');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

$wa->usePreset('template.joomla-italia-theme')
     ->useStyle('css.fontawesome')
     ->useStyle('css.fonts')
     ->useStyle('template.css.pcrt-main')
     ->useStyle('template.css.pcrt-menu')
     ->useStyle('template.css.pcrt-jit')
     ->useStyle('css.table')
     ->useStyle('carousel')
     ->useStyle('carousel.theme')
     ->useScript('template.js.jquery362')
     ->useScript('template.js.carousel')
     ->useScript('template.js.jti')
     ->addInlineScript(
         "
		 window.addEventListener('load', function(event) {
			 $('#slideheader').owlCarousel({
	         loop:false,
	         margin:0,
	         nav:true,
	         items:1,
	         autoplay:false,
	         autoplayTimeout:5000,/*,
	         animateOut: 'fadeOut'*/
	         responsive:{
	             0:{
	                 nav:false
	             },
	             991:{
	                 nav:true
	             }
	         }
	     });

	     $('.owl-carousel').each(function() {
	     $(this).find('.owl-dot').each(function(index) {
	       $(this).attr('aria-label', index + 1);
	     });
	     });
   });",
         [],
         [],
         ["template.js.jquery362"]
     );

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= $this->language; ?>" lang="<?= $this->language; ?>" dir="<?php echo $this->direction; ?>">
    
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	
	<?php if ($this->params->get('cssName')) : ?>
		<link href="<?= htmlspecialchars($this->baseurl . '/templates/' . $this->template . '/css/' . $this->params->get('cssName')); ?>" rel="stylesheet" />
	<?php endif; ?>

	<?php if ($this->params->get('jsName')) : ?>
		<script src="<?= htmlspecialchars($this->baseurl . '/templates/' . $this->template . '/js/' . $this->params->get('jsName')); ?>"></script>
	<?php endif; ?>
	
	<jdoc:include type="scripts" />
	
	<?php if ($this->params->get('custom_code_head')) : ?>
		<?= $this->params->get('custom_code_head'); ?>
	<?php endif; ?>
</head>

<body class="<?= $pageclass ? htmlspecialchars($pageclass) : ''; ?>">
<header
  class="it-header-wrapper it-header-sticky"
  data-bs-toggle="sticky"
  data-bs-position-type="fixed"
  data-bs-sticky-class-name="is-sticky"
  data-bs-target="#header-nav-wrapper"
>
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <?php if ($this->params->get('showTopBarMessage')) : ?>
              <a class="d-lg-block navbar-brand" href="<?= htmlspecialchars($this->params->get('topbarTitleLink')); ?>"><?php echo htmlspecialchars($this->params->get('topbarTitle')); ?></a>
            <?php endif; ?>
            <div class="it-header-slim-right-zone">
              <jdoc:include type="modules" name="lingua" style="none" />
              <?php if ($this->params->get('showBtnTopbar')) : ?>
                    	<?php
                           $fieldValues = $this->params->get('showBtnTopbarFields');
                  if (!empty($fieldValues)) :
                      foreach ($fieldValues as $value):
                          ?>
			                     <a class="btn btn-icon btn-full" href="<?= $value->topbarbuttonlink ?>" title="<?=$value->topbarbuttontitle?>" aria-label="<?=$value->topbarbuttontitle?>">
				                     <span class="rounded-icon">
			                       		<svg class="icon icon-primary">
			                          		<use xlink:href="<?=$baseImagePath?>sprites.svg#<?=$value->topbarbuttonicon?>"></use>
			                          </svg>
			                       </span>
			                       <span class="d-none d-lg-block"><?=$value->topbarbuttontitle?></span>
			                     </a>
					                 <?php endforeach; ?>
			                <?php endif; ?>

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
                <a href="<?php echo $this->baseurl; ?>/">
                  <?php if ($this->params->get('showLogo')) : ?>
                    <img src="<?= htmlspecialchars($this->params->get('imageLogo')); ?>" title="<?= htmlspecialchars($this->params->get('logoTitle')); ?>" class="icon">
                    <div class="it-brand-text">
                      <div class="it-brand-tagline"><?= htmlspecialchars($this->params->get('logoTopTitle')); ?></div>
                      <div class="it-brand-title"><?= htmlspecialchars($this->params->get('logoTitle')); ?></div>
                      <div class="it-brand-tagline"><?= htmlspecialchars($this->params->get('logoSubtitle')); ?></div>
                    </div>
                  <?php endif; ?>
                </a>
              </div>
              <div class="it-right-zone <?php if ($this->countModules('cerca')): ?>normalizeflex<?php endif; ?>">
                <jdoc:include type="modules" name="cerca" style="none" />

                <?php if ($this->params->get('showSocial')) : ?>
                  <div class="it-socials d-none d-md-flex">
                    <span>Seguici su</span>
                    	  <?php $fieldValues = $this->params->get('showSocialTouchFields'); ?>
                        <ul>
                        <?php foreach ($fieldValues as $value): ?>
	                        <li>
														<a href="<?= $value->touchsuburl ?>" aria-label="<?= $value->touchsubname ?>" target="_blank">
															<svg class="icon"><use href="<?=$baseImagePath?>sprites.svg#<?=$value->touchsubicon?>">
															</use>
															</svg>
														</a>
													</li>
                        <?php endforeach; ?>
                        </ul>
                  </div>
                <?php endif; ?>
                <jdoc:include type="modules" name="bottonecerca" style="none" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                  <use href="<?=$baseImagePath?>sprites.svg#it-burger"></use>
                </svg>
              </button>
              <div class="navbar-collapsable" id="nav4" style="display: none">
                <div class="overlay" style="display: none"></div>
                <div class="close-div">
                  <button class="btn close-menu" type="button">
                    <span class="visually-hidden">Nascondi la navigazione</span>
                    <svg class="icon">
                      <use href="<?=$baseImagePath?>sprites.svg#it-close-big"></use>
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
  </div>
</header>
  <?php if ($this->params->get('showBanner') && $isHomePage) : ?>
    <section class="section bg-redbrown section-hero-left owl-carousel owl-theme slideheader p-0" id="slideheader">
    <?php
            $fieldValuesbanner = $this->params->get('showBannerfields');?>
          <?php foreach ($fieldValuesbanner as $value): ?>
            <div class="item-banner">
              <div class="decoration-01"></div>
              <div class="decoration-02"></div>
              <div class="container h-100 text-bannerhome">
                <div class="row align-items-center h-100">
                  <div class="col-12 col-lg-6">
                    <div class="text-white font-weight-normal h4"><?= $value->bannerTopTitle; ?></div>
                    <h1 class="text-white"><span class="d-line d-xl-block"><?= $value->bannerTitle; ?></span></h1>
                    <h2 class="text-white font-weight-normal h3"><?= $value->bannerDescription; ?></h2>
                    <a href="<?= $value->bannerUrlButton; ?>" class="btn btn-sm btn-outline-white mt-4"><?= $value->bannerButton; ?></a>
                  </div>
                </div>
              </div>
              <div class="hero-img d-none d-md-block" style="background-image: url('<?= $value->imageBanner; ?>');"></div>
            </div>
          <?php endforeach; ?>
    </section>
  <?php endif;?>
<jdoc:include type="modules" name="hero" style="none" />
<main>
  <?php if ($this->countModules('breadcrumbs')): ?>
    <div class="wrapperbreadcrumbs">
      <div class="container">
        <jdoc:include type="modules" name="breadcrumbs" style="none" />
      </div>
    </div>
  <?php endif;?>
  <jdoc:include type="component" />
  <jdoc:include type="modules" name="below" style="below" />
  <jdoc:include type="modules" name="user" style="user" />
</main>
<footer class="footersito">
  <div class="container">
  <?php if ($this->params->get('showLoghiFooter') || $this->params->get('showLogoEuropa'))  : ?>
    <div class="row mb-5">
      <div class="col-12 logos-wrapper">
        <?php if ($this->params->get('showLogoEuropa'))  : ?>
          <img class="ue-logo" src="<?= htmlspecialchars($this->params->get('imageLogoEuropaFooter')); ?>" alt="<?= htmlspecialchars($this->params->get('logoFooterEuropaDescrizione')); ?>">
        <?php endif;?>
        <?php if ($this->params->get('showLoghiFooter'))  : ?>
        <div class="logo-footer">
          <a href="" aria-label="Vai alla homepage" title="Vai alla homepage" class="" data-focus-mouse="false">
            <img src="<?= htmlspecialchars($this->params->get('imageLogoFooter')); ?>" title="<?= htmlspecialchars($this->params->get('logoFooterTitle')); ?>">
          </a>
          <p class="h1">
            <a href="">
              <span><?= htmlspecialchars($this->params->get('logoFooterTopTitle')); ?></span>
              <span>
                <strong><?= htmlspecialchars($this->params->get('logoFooterTitle')); ?></strong>
              </span>
              <span><?= htmlspecialchars($this->params->get('logoFooterSubtitle')); ?></span>
            </a>
          </p>
        </div>
        <?php endif;?>
      </div>
    </div>
    <?php endif;?>
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
    <?php if ($this->countModules('arealegale')): ?>
      <div class="area-legale"><jdoc:include type="modules" name="arealegale" style="none" /></div>
    <?php endif; ?>
  </div>
  <div class="copyright mt-3 py-4 mt-lg-5">
    <div class="container text-center">
    <?php if ($this->params->get('showCopyright')) : ?>
        <p><?= $this->params->get('descCopyright'); ?></p>
    <?php endif ?>
    </div>
  </div>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 text-right footer-credits">
        <?= $credits ?>
      </div>
    </div>
  </div>
</footer>

<?php if ($this->params->get('custom_code_body')) : ?>
		<?= $this->params->get('custom_code_body'); ?>
	<?php endif; ?>
</body>
</html>
<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$input = $app->getInput();
$wa = $this->getWebAssetManager();
$menu = $app->getMenu()->getActive();
$isHomePage = ($menu->home);
$credits = '<a href="https://www.protocollicreativi.it" target="_blank" rel="nofollow" title="Protocolli Creativi is a Joomla Provider">Made with love Joomla Italia Theme by Protocolli Creativi</a>';
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

$baseImagePath = Uri::root(false).'media/templates/site/'.$this->template.'/images/';

$this->setMetaData('viewport', 'width=device-width, initial-scale=1, minimum-scale=1');
$this->setMetaData('theme-color', '#ffffff');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

$wa->usePreset('template.joomla-italia-theme')
     ->useStyle('css.fontawesome')
     ->useStyle('css.fonts')
     ->useStyle('template.css.pcrt-main')
     ->useStyle('template.css.pcrt-menu')
     ->useStyle('template.css.pcrt-jit')
     ->useStyle('css.table')
     ->useStyle('carousel')
     ->useStyle('carousel.theme')
     ->useScript('template.js.jquery362')
     ->useScript('template.js.carousel')
     ->useScript('template.js.jti')
     ->addInlineScript(
         "
		 window.addEventListener('load', function(event) {
			 $('#slideheader').owlCarousel({
	         loop:true,
	         margin:0,
	         nav:true,
	         items:1,
	         autoplay:false,
	         autoplayTimeout:5000,/*,
	         animateOut: 'fadeOut'*/
	         responsive:{
	             0:{
	                 nav:false
	             },
	             991:{
	                 nav:true
	             }
	         }
	     });

	     $('.owl-carousel').each(function() {
	     $(this).find('.owl-dot').each(function(index) {
	       $(this).attr('aria-label', index + 1);
	     });
	     });
   });",
         [],
         [],
         ['template.js.jquery362']
     );

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= $this->language; ?>" lang="<?= $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="<?= $pageclass ? htmlspecialchars($pageclass) : ''; ?>">
<header
  class="it-header-wrapper it-header-sticky"
  data-bs-toggle="sticky"
  data-bs-position-type="fixed"
  data-bs-sticky-class-name="is-sticky"
  data-bs-target="#header-nav-wrapper"
>
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <?php if ($this->params->get('showTopBarMessage')) : ?>
              <a class="d-lg-block navbar-brand" href="<?= htmlspecialchars($this->params->get('topbarTitleLink')); ?>"><?php echo htmlspecialchars($this->params->get('topbarTitle')); ?></a>
            <?php endif; ?>
            <div class="it-header-slim-right-zone">
              <jdoc:include type="modules" name="lingua" style="none" />
              <?php if ($this->params->get('showBtnTopbar')) : ?>
                    	<?php
                           $fieldValues = $this->params->get('showBtnTopbarFields');
                  if (! empty($fieldValues)) :
                      foreach ($fieldValues as $value):
                          ?>
			                     <a class="btn btn-icon btn-full" href="<?= $value->topbarbuttonlink ?>" title="<?=$value->topbarbuttontitle?>" aria-label="<?=$value->topbarbuttontitle?>">
				                     <span class="rounded-icon">
			                       		<svg class="icon icon-primary">
			                          		<use xlink:href="<?=$baseImagePath?>sprites.svg#<?=$value->topbarbuttonicon?>"></use>
			                          </svg>
			                       </span>
			                       <span class="d-none d-lg-block"><?=$value->topbarbuttontitle?></span>
			                     </a>
					                 <?php endforeach; ?>
			                <?php endif; ?>

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
                <a href="<?php echo $this->baseurl; ?>/">
                  <?php if ($this->params->get('showLogo')) : ?>
                    <img src="<?= htmlspecialchars($this->params->get('imageLogo')); ?>" title="<?= htmlspecialchars($this->params->get('logoTitle')); ?>" class="icon" alt="logo">
                    <div class="it-brand-text">
                      <div class="it-brand-tagline"><?= htmlspecialchars($this->params->get('logoTopTitle')); ?></div>
                      <div class="it-brand-title"><?= htmlspecialchars($this->params->get('logoTitle')); ?></div>
                      <div class="it-brand-tagline"><?= htmlspecialchars($this->params->get('logoSubtitle')); ?></div>
                    </div>
                  <?php endif; ?>
                </a>
              </div>
              <div class="it-right-zone <?php if ($this->countModules('cerca')): ?>normalizeflex<?php endif; ?>">
                <jdoc:include type="modules" name="cerca" style="none" />

                <?php if ($this->params->get('showSocial')) : ?>
                  <div class="it-socials d-none d-md-flex">
                    <span>Seguici su</span>
                    	  <?php $fieldValues = $this->params->get('showSocialTouchFields'); ?>
                        <ul>
                        <?php foreach ($fieldValues as $value): ?>
	                        <li>
														<a href="<?= $value->touchsuburl ?>" aria-label="<?= $value->touchsubname ?>" target="_blank">
															<svg class="icon"><use href="<?=$baseImagePath?>sprites.svg#<?=$value->touchsubicon?>">
															</use>
															</svg>
														</a>
													</li>
                        <?php endforeach; ?>
                        </ul>
                  </div>
                <?php endif; ?>
                <jdoc:include type="modules" name="bottonecerca" style="none" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                  <use href="<?=$baseImagePath?>sprites.svg#it-burger"></use>
                </svg>
              </button>
              <div class="navbar-collapsable" id="nav4" style="display: none">
                <div class="overlay" style="display: none"></div>
                <div class="close-div">
                  <button class="btn close-menu" type="button">
                    <span class="visually-hidden">Nascondi la navigazione</span>
                    <svg class="icon">
                      <use href="<?=$baseImagePath?>sprites.svg#it-close-big"></use>
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
  </div>
</header>
  <?php if ($this->params->get('showBanner') && $isHomePage) : ?>
    <section class="section bg-redbrown section-hero-left owl-carousel owl-theme slideheader p-0" id="slideheader">
    <?php
            $fieldValuesbanner = $this->params->get('showBannerfields'); ?>
          <?php foreach ($fieldValuesbanner as $value): ?>
            <div class="item-banner">
              <div class="decoration-01"></div>
              <div class="decoration-02"></div>
              <div class="container h-100 text-bannerhome">
                <div class="row align-items-center h-100">
                  <div class="col-12 col-lg-6">
                    <div class="text-white font-weight-normal h4"><?= $value->bannerTopTitle; ?></div>
                    <h1 class="text-white"><span class="d-line d-xl-block"><?= $value->bannerTitle; ?></span></h1>
                    <h2 class="text-white font-weight-normal h3"><?= $value->bannerDescription; ?></h2>
                    <a href="<?= $value->bannerUrlButton; ?>" class="btn btn-sm btn-outline-white mt-4"><?= $value->bannerButton; ?></a>
                  </div>
                </div>
              </div>
              <div class="hero-img d-none d-md-block" style="background-image: url('<?= $value->imageBanner; ?>');"></div>
            </div>
          <?php endforeach; ?>
    </section>
  <?php endif; ?>
<jdoc:include type="modules" name="hero" style="none" />
<main>
  <?php if ($this->countModules('breadcrumbs')): ?>
    <div class="wrapperbreadcrumbs">
      <div class="container">
        <jdoc:include type="modules" name="breadcrumbs" style="none" />
      </div>
    </div>
  <?php endif; ?>
  <jdoc:include type="component" />
  <jdoc:include type="modules" name="below" style="below" />
  <jdoc:include type="modules" name="user" style="user" />
</main>
<footer class="footersito">
  <div class="container">
  <?php if ($this->params->get('showLoghiFooter') || $this->params->get('showLogoEuropa'))  : ?>
    <div class="row mb-5">
      <div class="col-12 logos-wrapper">
        <?php if ($this->params->get('showLogoEuropa'))  : ?>
          <img class="ue-logo" src="<?= htmlspecialchars($this->params->get('imageLogoEuropaFooter')); ?>" alt="<?= htmlspecialchars($this->params->get('logoFooterEuropaDescrizione')); ?>">
        <?php endif; ?>
        <?php if ($this->params->get('showLoghiFooter'))  : ?>
        <div class="logo-footer">
          <a href="" aria-label="Vai alla homepage" title="Vai alla homepage" class="" data-focus-mouse="false">
            <img src="<?= htmlspecialchars($this->params->get('imageLogoFooter')); ?>" title="<?= htmlspecialchars($this->params->get('logoFooterTitle')); ?>" alt="logo">
          </a>
          <p class="h1">
            <a href="">
              <span><?= htmlspecialchars($this->params->get('logoFooterTopTitle')); ?></span>
              <span>
                <strong><?= htmlspecialchars($this->params->get('logoFooterTitle')); ?></strong>
              </span>
              <span><?= htmlspecialchars($this->params->get('logoFooterSubtitle')); ?></span>
            </a>
          </p>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
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
    <?php if ($this->countModules('arealegale')): ?>
      <div class="area-legale"><jdoc:include type="modules" name="arealegale" style="none" /></div>
    <?php endif; ?>
  </div>
  <div class="copyright mt-3 py-4 mt-lg-5">
    <div class="container text-center">
    <?php if ($this->params->get('showCopyright')) : ?>
        <p><?= htmlspecialchars($this->params->get('descCopyright')); ?></p>
    <?php endif ?>
    </div>
  </div>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 text-right footer-credits">
        <?= $credits ?>
      </div>
    </div>
  </div>
</footer>


</body>
</html>
