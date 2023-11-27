<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

use Joomla\CMS\Uri\Uri;

$url = Uri::root();

$app = Factory::getApplication();

$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayContent = trim(implode("\n", $results));

$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

//echo json_encode($this->category);
//echo $this->category->parent_id;
$catactive =  $this->category->title;

$imgdesc = $this->category->getParams()->get('image');

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

?>



<section class="section bg-white py-5 position-relative d-flex align-items-center overflow-hidden section-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center">
                <div class="hero-title">
                    <?php if ($this->params->get('show_category_title', 1)) : ?>
                        <small><?php echo $this->category->title; ?></small>
                    <?php endif; ?>
                    <?php if ($this->params->get('show_page_heading')) : ?>
                        <small><?php echo $this->escape($this->params->get('page_heading')); ?> </small>
                    <?php endif; ?>

                    <?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
                        <h1>
                            <?php if ($this->params->get('show_description') && $this->category->description) : ?>
                                <?php echo JHtml::_('content.prepare', $this->category->description); ?>
                            <?php endif; ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if ($imgdesc !=''): ?>
        <div class="title-img" <?php echo LayoutHelper::render('joomla.html.bgimage', ['src' => $this->category->getParams()->get('image'),]); ?>></div>
        <?php else: ?>
        <div class="title-img" style="background-image: url('<?= $baseImagePath ?>imgsegnaposto.jpg')"></div>
        <?php endif; ?>
    </div>
</section>

<?php echo $afterDisplayTitle; ?>
<?php echo $beforeDisplayContent; ?>
<?php echo $afterDisplayContent; ?>
