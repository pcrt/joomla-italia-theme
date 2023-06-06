<?php defined('_JEXEC') or die; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta charset="utf-8">
    <meta name="theme-color" content="#ffffff"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap-italia.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/pcrt-main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/pcrt-menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/pcrt-jit.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/fonts.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/table.css" rel="stylesheet" type="text/css" />
    <link rel="apple-touch-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/img/joomla.png">
    <link href="/media/system/images/joomla-favicon.svg" rel="icon" type="image/svg+xml">
	  <link href="/media/system/images/favicon.ico" rel="alternate icon" type="image/vnd.microsoft.icon">
	  <link href="/media/system/images/joomla-favicon-pinned.svg" rel="mask-icon" color="#000">
    <jdoc:include type="head" />

  </head>
  <?php
  $app = JFactory::getApplication();
  $menu     = $app->getMenu()->getActive();
  $pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
  $router = JApplicationSite::getRouter();
  $istance = JUri::getInstance();
  $query = $router->parse($istance); 
  $isHomePage = ($app->getMenu()->getActive()->home);
  $credits = '<a href="https://www.protocollicreativi.it" target="_blank" rel="nofollow" title="Protocolli Creativi is a Joomla Provider">Made with love Joomla Italia Theme by Protocolli Creativi</a>';

  $wa  = $this->getWebAssetManager();
  $wa->useStyle('template.joomla-italia-theme.css');

  // Get this template's path
  $templatePath = 'templates/' . $this->template;


?>
<body class="<?php echo $pageclass ? htmlspecialchars($pageclass) : ''; ?>">
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
              <a class="d-lg-block navbar-brand" href="<?php echo htmlspecialchars($this->params->get('topbarTitleLink')); ?>"><?php echo htmlspecialchars($this->params->get('topbarTitle')); ?></a>
            <?php endif; ?>
            <div class="it-header-slim-right-zone">
              <jdoc:include type="modules" name="lingua" style="none" />
              <?php if ($this->params->get('showBtnTopbar')) : ?>
                    <?php
                       $fieldValues = $this->params->get('showBtnTopbarFields');
                        if (empty($fieldValues)){
                           return;
                        }
                        foreach ($fieldValues as $value){
                        
                        echo '
                              <a class="btn btn-icon btn-full" href="'.$value->topbarbuttonlink.'" title="'.$value->topbarbuttontitle.'" aria-label="'.$value->topbarbuttontitle.'">
                                <span class="rounded-icon">
                                  <svg class="icon icon-primary">
                                    <use xlink:href="/templates/joomla-italia-theme/svg/sprites.svg#'.$value->topbarbuttonicon.'"></use>
                                  </svg>
                                </span>
                                <span class="d-none d-lg-block">'.$value->topbarbuttontitle.'</span>
                              </a>
                            ';
                        }
                       ?>
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
                    <img src="<?php echo htmlspecialchars($this->params->get('imageLogo')); ?>" title="<?php echo htmlspecialchars($this->params->get('logoTitle')); ?>" class="icon">
                    <div class="it-brand-text">
                      <div class="it-brand-tagline"><?php echo htmlspecialchars($this->params->get('logoTopTitle')); ?></div>
                      <div class="it-brand-title"><?php echo htmlspecialchars($this->params->get('logoTitle')); ?></div>
                      <div class="it-brand-tagline"><?php echo htmlspecialchars($this->params->get('logoSubtitle')); ?></div>
                    </div>
                  <?php endif; ?>
                </a>
              </div>
              <div class="it-right-zone <?php if ($this->countModules('cerca')): ?>normalizeflex<?php endif; ?>">
                <jdoc:include type="modules" name="cerca" style="none" />
              
                <?php if ($this->params->get('showSocial')) : ?>
                  <div class="it-socials d-none d-md-flex">
                    <span>Seguici su</span>
                    <?php
                       $fieldValues = $this->params->get('showSocialTouchFields');
                        /*if (empty($fieldValues)){
                           return;
                        }*/
                        $html = '<ul>';
                        foreach ($fieldValues as $value){
                        $html .= '<li><a href="' . $value->touchsuburl . '" aria-label="'.$value->touchsubname.'" target="_blank"><svg class="icon"><use href="/templates/joomla-italia-theme/svg/sprites.svg#'.$value->touchsubicon.'"></use></svg></a></li>';
                        }
                        $html .= '</ul>';
                        echo $html;
                       ?>
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
                  <use href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/svg/sprites.svg#it-burger"></use>
                </svg>
              </button>
              <div class="navbar-collapsable" id="nav4" style="display: none">
                <div class="overlay" style="display: none"></div>
                <div class="close-div">
                  <button class="btn close-menu" type="button">
                    <span class="visually-hidden">Nascondi la navigazione</span>
                    <svg class="icon">
                      <use href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/svg/sprites.svg#it-close-big"></use>
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
                    <div class="text-white font-weight-normal h4"><?php echo $value->bannerTopTitle; ?></div>
                    <h1 class="text-white"><span class="d-line d-xl-block"><?php echo $value->bannerTitle; ?></span></h1>
                    <h2 class="text-white font-weight-normal h3"><?php echo $value->bannerDescription; ?></h2>
                    <a href="<?php echo $value->bannerUrlButton; ?>" class="btn btn-sm btn-outline-white mt-4"><?php echo $value->bannerButton; ?></a>
                  </div>
                </div>
              </div>
              <div class="hero-img d-none d-md-block" style="background-image: url('<?php echo $value->imageBanner; ?>');"></div>
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
          <img class="ue-logo" src="<?php echo htmlspecialchars($this->params->get('imageLogoEuropaFooter')); ?>" alt="<?php echo htmlspecialchars($this->params->get('logoFooterEuropaDescrizione')); ?>">
        <?php endif;?>
        <?php if ($this->params->get('showLoghiFooter'))  : ?>
        <div class="logo-footer">
          <a href="" aria-label="Vai alla homepage" title="Vai alla homepage" class="" data-focus-mouse="false">
            <img src="<?php echo htmlspecialchars($this->params->get('imageLogoFooter')); ?>" title="<?php echo htmlspecialchars($this->params->get('logoFooterTitle')); ?>">
          </a>
          <p class="h1">
            <a href="">
              <span><?php echo htmlspecialchars($this->params->get('logoFooterTopTitle')); ?></span>
              <span>
                <strong><?php echo htmlspecialchars($this->params->get('logoFooterTitle')); ?></strong>
              </span>
              <span><?php echo htmlspecialchars($this->params->get('logoFooterSubtitle')); ?></span>
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
        <p><?php echo htmlspecialchars($this->params->get('descCopyright')); ?></p>
    <?php endif ?>
    </div>
  </div>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 text-right footer-credits">
        <?php echo $credits ?>
      </div>
    </div>
  </div>
</footer>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/owl.theme.default.min.css">
<script language="JavaScript" type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/bootstrap-italia.bundle.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-3.6.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/owl.carousel.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jti.js"></script>

<script>
$(document).ready(function() {

//Carosello Slide banner
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



  });
</script>

</body>
</html>

