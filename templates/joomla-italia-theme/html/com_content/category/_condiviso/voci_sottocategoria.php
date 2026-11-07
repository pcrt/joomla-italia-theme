<?php

/**
 * Articoli di una sottocategoria nelle pagine di categoria con sezioni (issue #76).
 *
 * I layout novita, eventi, didattica, documenti, luoghi e organizzazione mostrano una sezione
 * per ogni sottocategoria. Fino alla 2.0.3 la riempivano con gli articoli della pagina
 * (quelli entro "Numero articoli introduttivi", scelti su tutta la categoria): se le
 * notizie erano più numerose delle altre, le sezioni Circolari ed Eventi restavano vuote
 * o cambiavano da una pagina all'altra.
 *
 * Con il parametro della voce di menu "Articoli per ogni sottocategoria" maggiore di zero,
 * gli articoli vengono letti categoria per categoria, i più recenti per primi (come fa il
 * layout newshome in homepage). A zero o vuoto il comportamento è quello di prima.
 *
 * Variabili attese: nessuna. Definisce la funzione jit_voci_sottocategoria().
 */

defined('_JEXEC') or die;

if (!function_exists('jit_voci_sottocategoria')) {
    /**
     * @param   object  $categoria   La sottocategoria (nodo di Categories)
     * @param   int     $limite      Articoli per sezione; 0 = usa gli articoli della pagina
     * @param   array   $vociPagina  Gli articoli della pagina ($this->intro_items nel layout)
     * @param   object  $params      I parametri della pagina ($this->params nel layout)
     *
     * @return  array  Articoli pronti per i layout *_itemsottocategorie e *_item
     */
    function jit_voci_sottocategoria($categoria, int $limite, array $vociPagina, $params): array
    {
        if ($limite < 1) {
            // Comportamento precedente: gli articoli della pagina che appartengono alla sottocategoria.
            // Il confronto è fra interi: i valori arrivano dal database e possono essere stringhe.
            $voci = [];

            foreach ($vociPagina as $item) {
                if ((int) $item->catid === (int) $categoria->id) {
                    $voci[] = $item;
                }
            }

            return $voci;
        }

        $app    = \Joomla\CMS\Factory::getApplication();
        $params = clone $params;

        /** @var \Joomla\Component\Content\Site\Model\ArticlesModel $model */
        $model = $app->bootComponent('com_content')->getMVCFactory()->createModel('Articles', 'Site', ['ignore_request' => true]);
        $model->setState('params', $params);
        $model->setState('filter.category_id', (int) $categoria->id);
        $model->setState('filter.subcategories', true);
        $model->setState('filter.max_category_levels', -1);
        $model->setState('filter.published', \Joomla\Component\Content\Administrator\Extension\ContentComponent::CONDITION_PUBLISHED);
        $model->setState('filter.language', \Joomla\CMS\Language\Multilanguage::isEnabled());
        $model->setState('filter.featured', $params->get('show_featured', 'show'));
        $model->setState('list.ordering', 'a.publish_up');
        $model->setState('list.direction', 'DESC');
        $model->setState('list.start', 0);
        $model->setState('list.limit', $limite);

        $items = $model->getItems() ?: [];

        // Stessa preparazione della vista di categoria di Joomla: slug, plugin di contenuto, eventi.
        $dispatcher = $app->getDispatcher();
        \Joomla\CMS\Plugin\PluginHelper::importPlugin('content', null, true, $dispatcher);

        foreach ($items as $item) {
            $item->slug = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;

            if ($item->parent_alias === 'root') {
                $item->parent_id = null;
            }

            $item->event = new \stdClass();

            if (!isset($item->text)) {
                $item->text = $item->introtext;
            }

            $argomenti = [
                'context' => 'com_content.category',
                'subject' => $item,
                'params'  => $item->params,
                'page'    => 0,
            ];

            $dispatcher->dispatch('onContentPrepare', new \Joomla\CMS\Event\Content\ContentPrepareEvent('onContentPrepare', $argomenti));

            $item->introtext = $item->text;

            $eventi = [
                'afterDisplayTitle'    => new \Joomla\CMS\Event\Content\AfterTitleEvent('onContentAfterTitle', $argomenti),
                'beforeDisplayContent' => new \Joomla\CMS\Event\Content\BeforeDisplayEvent('onContentBeforeDisplay', $argomenti),
                'afterDisplayContent'  => new \Joomla\CMS\Event\Content\AfterDisplayEvent('onContentAfterDisplay', $argomenti),
            ];

            foreach ($eventi as $chiave => $evento) {
                $risultati = $dispatcher->dispatch($evento->getName(), $evento)->getArgument('result', []);
                $item->event->{$chiave} = trim(implode("\n", $risultati));
            }
        }

        return $items;
    }
}
