<?php

/**
 * Intestazione principale (h1) di riserva per le pagine di categoria che non
 * mostrano un titolo visibile.
 *
 * PERCHE' SERVE
 * Alcune pagine (es. /didattica, che e' composta solo da moduli, oppure le
 * categorie con "Mostra titolo categoria" disattivato) non producevano nessun
 * h1: l'unico presente arrivava dal titolo di un modulo. Una pagina senza h1
 * non e' navigabile per intestazioni da chi usa uno screen reader (WCAG 1.3.1),
 * e far dipendere l'intestazione principale da un modulo la rende fragile:
 * basta togliere il modulo da quella pagina e l'h1 sparisce.
 *
 * L'intestazione e' "visually-hidden": si legge con gli assistivi ma non
 * cambia nulla graficamente, quindi non altera il progetto della pagina.
 *
 * NB: nomi di classe COMPLETI, le istruzioni "use" non si ereditano nei file inclusi.
 */
defined('_JEXEC') or die;

$h1Testo = '';

if ($this->params->get('show_page_heading') && $this->params->get('page_heading')) {
    $h1Testo = (string) $this->params->get('page_heading');
} elseif (isset($this->category->title)) {
    $h1Testo = (string) $this->category->title;
}

if (trim($h1Testo) !== '') : ?>
<h1 class="visually-hidden"><?php echo $this->escape(trim($h1Testo)); ?></h1>
<?php endif; ?>
