<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_wrapper
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$this->document->getWebAssetManager()
    ->registerAndUseScript('com_wrapper.iframe', 'com_wrapper/iframe-height.min.js', [], ['defer' => true]);

?>
<div class="com-wrapper contentpane">
    <div class="container">
        <?php if ($this->params->get('show_page_heading')) : ?>
            <div class="page-header">
                <h1>

                    <?php
                        $title = "";
            if ($this->escape($this->params->get('page_heading'))) {
                $title = $this->escape($this->params->get('page_heading'));
            } else {
                $title = $this->escape($this->params->get('page_title'));
            }
echo $title;
?>
                </h1>
            </div>
        <?php endif; ?>
        <iframe title="<?=$title?>"
            <?= $this->wrapper->load ?>
            id="blockrandom"
            name="iframe"
            src="<?= $this->escape($this->wrapper->url) ?>"
            width="<?= $this->escape($this->params->get('width')) ?>"
            height="<?= $this->escape($this->params->get('height')) ?>"
            loading="<?= $this->params->get('lazyloading', 'lazy') ?>"
            class="com-wrapper__iframe wrapper <?= $this->pageclass_sfx ?>"
        >
            <?= Text::_('COM_WRAPPER_NO_IFRAMES'); ?>
        </iframe>
    </div>
</div>
