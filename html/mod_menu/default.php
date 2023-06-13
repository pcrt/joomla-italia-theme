<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu.min.js', [], ['type' => 'module']);
$wa->registerAndUseScript('mod_menu', 'mod_menu/menu-es5.min.js', [], ['nomodule' => true, 'defer' => true]);

$id = '';
$count_childitem = 0;
$contofigli = 0;
$countereee = 0;
$countduecol=0;
$oldparent_id=0;



if ($tagId = $params->get('tag_id', '')) {
    $id = ' id="' . $tagId . '"';
}

$arrayfigli =[];
$arraypadri =[];



?>

<ul <?php echo $id; ?> class="navbar-nav <?php echo $class_sfx; ?>" data-element="menu">

<?php foreach ($list as $i => $item) {
    if (array_key_exists($item->parent_id, $arrayfigli)== false) {
        $arrayfigli[$item->parent_id] = 0;
    }
    $arrayfigli[$item->parent_id] += 1;
}


$parent_id = null;
$megamenu = false;

foreach ($list as $i => &$item) {
    $itemParams = $item->getParams();
    $class      = 'nav-item item-' . $item->id;


    if ($item->id == $default_id) {
        $class .= ' default';
    }

    if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id)) {
        $class .= ' current';
    }

    if (in_array($item->id, $path)) {
        $class .= ' active';
    } elseif ($item->type === 'alias') {
        $aliasToId = $itemParams->get('aliasoptions');

        if (!empty($path) && $aliasToId == $path[count($path) - 1]) {
            $class .= ' active';
        } elseif (in_array($aliasToId, $path)) {
            $class .= ' alias-parent-active';
        }
    }

    if ($item->type === 'separator') {
        $class .= ' divider';
    }

    if ($item->deeper) {
        $class .= ' deeper dropdown';
    }

    if ($item->parent) {
        $class .= ' parent';
    }

    if(($item->level == 1 && $item->anchor_css !== 'megamenu') || $item->level > 1 && $megamenu == false) {
        $parent_id = $item->id;
        $megamenu = false;

        echo '<li class="' . $class . '">';

        switch ($item->type) :
            case 'separator':
            case 'component':
            case 'heading':
            case 'url':
                require_once ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
                break;

            default:
                require_once ModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;

        // The next item is deeper.
        if ($item->deeper && $item->level == 1) {
            //Validazione app scuole aggiungo data element alla lista in base alla voce di menu di appartenenza

            switch ($item->title) :
                case 'Scuola':
                    echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown0"><div class="link-list-wrapper"><ul class="link-list" data-element="school-submenu">';
                    break;
                case 'Servizi':
                    echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown0"><div class="link-list-wrapper"><ul class="link-list" data-element="services-submenu">';
                    break;
                case 'Didattica':
                    echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown0"><div class="link-list-wrapper"><ul class="link-list" data-element="teaching-submenu">';
                    break;
                case 'Novità':
                    echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown0"><div class="link-list-wrapper"><ul class="link-list" data-element="news-submenu">';
                    break;
                default:
                    echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown0"><div class="link-list-wrapper"><ul class="link-list" data-element="custom-submenu">';
            endswitch;
        } elseif ($item->deeper && $item->level >= 2) {
            echo '<div><div class="link-list-wrapper"><ul class="link-list">';
        } elseif ($item->shallower) {
            // The next item is shallower.
            echo '</li>';
            echo str_repeat('</ul></div></div></li>', $item->level_diff);
        } else {
            // The next item is on the same level.
            echo '</li>';
        }
    }


    if ($item->level == 1 && $item->anchor_css == 'megamenu') {
        $parent_id = $item->id;
        $megamenu = true;

        echo '<li class="nav-item ' . $class . ' level' . $item->level . ' ' . $item->anchor_css . '">';

        switch ($item->type) :
            case 'separator':
            case 'component':
            case 'heading':
            case 'url':
                require_once ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
                break;

            default:
                require_once ModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;

        echo '<div class="dropdown-menu" role="region" aria-labelledby="mainNavMegamenu0"><div class="row">';
    }

    if ($oldparent_id != $parent_id) {
        $countduecol=0;
        $countereee=0;
    }


    if ($item->level == 2 && $megamenu == true) {
        $allchild = $arrayfigli[$parent_id];
        $figliqui = $arrayfigli[$parent_id] / 3;
        $intero =  intval($figliqui);
        $restoitem = $arrayfigli[$parent_id] % 3;



        if ($allchild <=8) {
            if($countduecol == 0) {
                echo '<div class="col-12 col-lg-4 '.$countduecol.' pe-lg-5"><div class="link-list-wrapper"><ul class="link-list">';
            } elseif ($countduecol == 4) {
                echo '</ul></div></div><div class="col-12 col-lg-4"><div class="link-list-wrapper"><ul class="link-list">';
            }

            ++$countduecol;
        } else {
            if($countereee == 0) {
                echo '<div class="col-12 col-lg-4"><div class="link-list-wrapper"><ul class="link-list">';
            } elseif(($restoitem == 0 && $countereee == $intero) || ($restoitem == 1 && $countereee == $intero + 1) || ($restoitem == 2 && $countereee == $intero + 1)) {
                echo '</ul></div></div><div class="col-12 col-lg-4"><div class="link-list-wrapper"><ul class="link-list">';
            } elseif (($restoitem == 0 && $countereee == $intero * 2) || ($restoitem == 1 && $countereee == ($intero * 2+ 1) + $restoitem) || ($restoitem == 2 && $countereee == $intero * 2 + $restoitem)) {
                echo '</ul></div></div><div class="col-12 col-lg-4"><div class="link-list-wrapper"><ul class="link-list">';
            }
        }

        echo '<li class="nav-item ' . $class . ' level' . $item->level . ' ' . $item->anchor_css . '">';

        switch ($item->type) :
            case 'separator':
            case 'component':
            case 'heading':
            case 'url':
                require_once ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
                break;

            default:
                require_once ModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;

        echo '</li>';

        if ($allchild <=8) {
            if ($countduecol == $allchild) {
                echo '</ul></div></div>';
            }
        } elseif($countereee +1 == $arrayfigli[$parent_id]) {
            echo '</ul></div></div>';
        }

        ++$countereee;
    }

    if ($item->parent_id !== $parent_id && $megamenu == true && $item->id !== $parent_id) {
        echo '</div></div>';
    }

    if ($item->parent_id !== $parent_id && $item->id !== $parent_id) {
        $parent_id = $item->id;
        $megamenu = false;
    }

    $oldparent_id = $parent_id;
}
?></ul>
