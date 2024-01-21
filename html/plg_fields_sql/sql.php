<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Sql
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Database\ParameterType;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$baseImagePath = Uri::root(false) . "media/templates/site/joomla-italia-theme/images/";

$value = $field->value;
$label = $field->label;
$labelico = $field->label;
if ($value == '') {
    return;
}


// Aggiungo il data element
switch ($label) :
    case 'Struttura responsabile del servizio':
        $dtelm = 'data-element="structures"';
        $icostruttura = 'it-pa';
        break;
    case 'Progetti correlati':
        $dtelm = '';
        $icostruttura = 'it-files';
        break;
    case 'Il Luogo è sede di':
        $dtelm = '';
        $icostruttura = 'it-pa';
        break;
    default:
        $dtelm = '';
        $icostruttura = 'it-flag';
endswitch;



$db    = Factory::getDbo();
$value = (array) $value;
$query = $db->getQuery(true);
$sql   = $fieldParams->get('query', '');

$bindNames = $query->bindArray($value, ParameterType::STRING);

// Run the query with a having condition because it supports aliases
$query->setQuery($sql . ' HAVING ' . $db->quoteName('value') . ' IN (' . implode(',', $bindNames) . ')');

try {
    $db->setQuery($query);
    $items = $db->loadObjectList();
} catch (Exception $e) {
    // If the query failed, we fetch all elements
    $db->setQuery($sql);
    $items = $db->loadObjectList();
}

$texts = [];
?>
<div class="row mb-5">
<?php
foreach ($items as $item) {
    if (in_array($item->value, $value)) {
        $array[]=$item->text;
        $texts[] = $item->text;
    }

    //echo $item->value;


    /*
    $db2 = Factory::getContainer()->get('DatabaseDriver');
    $query2 = $db2->getQuery(true);
    $query2->select($db2->quoteName(array('content.title', 'introtext', 'fulltext', 'catid', 'categories.parent_id', 'categories.level', 'fields_cat.field_id', 'fields.id', 'fields.label')))
    ->from($db2->quoteName('#__content', "content"))
    ->leftJoin($db2->quoteName("#__categories", "categories") . ' ON ' . $db2->quoteName("content.catid") . " = " . $db2->quoteName("categories.id"))
    ->leftJoin($db2->quoteName("#__fields_categories", "fields_cat") . ' ON ' . $db2->quoteName("categories.parent_id") . " = " . $db2->quoteName("fields_cat.category_id"))
    ->leftJoin($db2->quoteName("#__fields", "fields") . ' ON ' . $db2->quoteName("fields_cat.field_id") . " = " . $db2->quoteName("fields.id"))
    ->where($db2->quoteName('content.id') . ' = '. $item->value);
    $db2->setQuery($query2);
    $items2 = $db2->loadObjectList();


    echo $items2[0]->title;
    echo $items2[0]->id;

    foreach ($items2 as $item2) {
        echo '<p>'.$item2->label.'</p>';

        $db3 = Factory::getContainer()->get('DatabaseDriver');
        $query3 = $db3->getQuery(true);
        $query3->select($db3->quoteName(array('value')))
        ->from($db3->quoteName('#__fields_values', "campi"))
        ->where($db3->quoteName('campi.field_id') . ' = '. $item2->id)
        ->where($db3->quoteName('campi.item_id') . ' = '. $item->value);

        $db3->setQuery($query3);
        $items3 = $db3->loadObjectList();


        foreach ($items3 as $item3) {
            echo $item3->value;
        }
    }
*/


    // SELECT id as 'value', title as 'text' FROM #__content WHERE catid=39


    $db2 = Factory::getContainer()->get('DatabaseDriver');
    $query2 = $db2->getQuery(true);
    $query2->select($db2->quoteName(array('content.title', 'content.introtext', 'content.fulltext', 'content.catid', 'content.id', 'content.language', 'categories.parent_id', 'categories.level')))
    ->from($db2->quoteName('#__content', "content"))
    ->leftJoin($db2->quoteName("#__categories", "categories") . ' ON ' . $db2->quoteName("content.catid") . " = " . $db2->quoteName("categories.id"))
    ->where($db2->quoteName('content.id') . ' = '. $item->value);
    $db2->setQuery($query2);
    $items2 = $db2->loadObjectList();
    ?>
<div class="col-12 col-lg-6 mb-4">
    <div class="card card-servizi card-bg card-icon rounded h-100" <?php echo $dtelm; ?>>
        <a href="<?php echo Route::_(RouteHelper::getArticleRoute($items2[0]->id, $items2[0]->catid, $items2[0]->language)); ?>" title="<?php echo $items2[0]->title; ?>">

        <div class="card-body">
                <svg class="icon">
                    <use xlink:href="<?= $baseImagePath ?>sprites.svg#<?php echo $icostruttura; ?>"></use>
                </svg>
                <div class="card-icon-content">
                    <p>
                        <strong><?php echo $items2[0]->title; ?></strong>
                    </p>
                    <small><?php echo $items2[0]->introtext; ?></small>
                </div>
            </div>
        </a>
    </div>
</div> 
<?php } ?>
</div>

<?php //echo htmlentities(implode(', ', $texts));?>
