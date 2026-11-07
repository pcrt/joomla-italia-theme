<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_fields
 *
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

if (!array_key_exists('field', $displayData)) {
    return;
}

$field = $displayData['field'];
$label = Text::_($field->label);
$value = $field->value;
$showLabel = $field->params->get('showlabel');
$prefix = Text::plural($field->params->get('prefix'), $value);
$suffix = Text::plural($field->params->get('suffix'), $value);
$labelClass = $field->params->get('label_render_class');
$valueClass = $field->params->get('value_render_class');

// Ottengo l'ID del campo
$fieldid = $field->id;

if ($value == '') {
    return;
}

?>

<div class="bg-blue-dark section section-padding timeline">
    <div class="container">

        <div class="it-carousel-wrapper it-carousel-landscape-abstract-three-cols it-carousel-landscape-abstract-three-cols-arrow-visible splide" data-bs-carousel-splide>
            <?php if ($showLabel == 1) : ?>
            <div class="it-header-block">
                <div class="it-header-block-title text-center">
                    <h3 class="mb-4"><?php echo htmlentities($label, ENT_QUOTES | ENT_IGNORE, 'UTF-8'); ?></h3>
                </div>
            </div>
            <?php endif; ?>
            <div class="splide__track ps-lg-3 pe-lg-3">
                <ul class="splide__list it-carousel-all">
                <?php foreach($field->subform_rows as $row){ ?>
                    <li class="splide__slide">
                        <div class="it-single-slide-wrapper">
                            <div class="card-wrapper card-space" style="background:unset!important;">
                                <div class="card card-serif card-bg" style="background:#001a33!important;">
                                    <div class="card-body">

                                        <?php
                                        // Sottocampi dell'evento (doc/custom-field-categoria.md): Anno Evento, Mese Anno
                                        // Evento, Titolo Evento, Descrizione Evento. Riconosciuti dal nome o dal titolo
                                        // del campo, cosi' l'ordine nel subform non conta; se nessun nome corrisponde
                                        // vale l'ordine di inserimento della 2.0.1 (data, titolo, descrizione) con l'anno
                                        // per quarto. Prima venivano stampati solo i primi tre sottocampi: "Anno Evento"
                                        // restava invisibile (issue #82).
                                        $sottocampi = array_values((array) $row);

                                        $trova = static function (array $nomi) use ($sottocampi) {
                                            foreach ($sottocampi as $sottocampo) {
                                                foreach (['fieldname', 'name', 'title', 'label'] as $proprieta) {
                                                    $candidato = strtolower(trim((string) ($sottocampo->$proprieta ?? '')));

                                                    if ($candidato !== '' && in_array($candidato, $nomi, true)) {
                                                        return $sottocampo;
                                                    }
                                                }
                                            }

                                            return null;
                                        };

                                        $anno        = $trova(['anno-evento', 'anno evento']);
                                        $meseAnno    = $trova(['mese-anno-evento', 'mese anno evento']);
                                        $titolo      = $trova(['titolo-evento', 'titolo evento']);
                                        $descrizione = $trova(['descrizione-evento', 'descrizione evento']);

                                        if ($anno === null && $meseAnno === null && $titolo === null && $descrizione === null) {
                                            $meseAnno    = $sottocampi[0] ?? null;
                                            $titolo      = $sottocampi[1] ?? null;
                                            $descrizione = $sottocampi[2] ?? null;
                                            $anno        = $sottocampi[3] ?? null;
                                        }

                                        $valore = static function ($sottocampo): string {
                                            return $sottocampo === null ? '' : trim((string) ($sottocampo->value ?? ''));
                                        };
                                        ?>
                                        <?php if ($valore($anno) !== '') : ?>
                                            <div class="h4 mb-1 anno-evento"><?php echo $valore($anno); ?></div>
                                        <?php endif; ?>
                                        <?php if ($valore($meseAnno) !== '') : ?>
                                            <div class="h5"><?php echo $valore($meseAnno); ?></div>
                                        <?php endif; ?>
                                        <?php if ($valore($titolo) !== '') : ?>
                                            <h3><?php echo $valore($titolo); ?></h3>
                                        <?php endif; ?>
                                        <?php if ($valore($descrizione) !== '') : ?>
                                            <p><?php echo $valore($descrizione); ?></p>
                                        <?php endif; ?>

  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>  
                <?php } ?>
                </ul>
            </div>      
        </div>
    </div>
</div>
