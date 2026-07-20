<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  System.singleedit
 *
 * @copyright   (C) Protocolli Creativi
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Plugin\System\Singleedit\Extension;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;
use Joomla\Event\SubscriberInterface;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Consente di aprire una sola scheda di modifica alla volta dal frontend
 * (articoli e moduli). Se l'utente ne ha gia una aperta e prova ad aprirne
 * un'altra (diversa), questa viene bloccata con un avviso.
 *
 * Il "lock" e tenuto nella SESSIONE dell'utente (non dipende dal check-out del
 * DB, che per i moduli non viene impostato). Viene liberato quando l'utente
 * Salva-e-chiude o Annulla, oppure automaticamente dopo un tempo di inattivita.
 */
final class SingleEdit extends CMSPlugin implements SubscriberInterface
{
    /**
     * Chiave in cui e memorizzato in sessione l'elemento attualmente in modifica.
     */
    private const STATE_KEY = 'plg.singleedit.open';

    /**
     * Dopo questo numero di secondi di inattivita il lock scade (evita blocchi
     * permanenti se l'utente lascia una scheda aperta senza chiuderla).
     */
    private const STALE_SECONDS = 3600;

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onAfterRoute' => 'enforceSingleEdit',
        ];
    }

    /**
     * @param   \Joomla\Event\Event  $event
     *
     * @return  void
     */
    public function enforceSingleEdit($event): void
    {
        $app = $this->getApplication();

        if (!$app || !$app->isClient('site')) {
            return;
        }

        $user = $app->getIdentity();

        if (!$user || $user->guest) {
            return;
        }

        $input  = $app->getInput();
        $option = $input->getCmd('option');
        $task   = $input->getCmd('task');
        $view   = $input->getCmd('view');
        $layout = $input->getCmd('layout');

        // 1) CHIUSURA (Salva-e-chiudi / Annulla): libero il lock e proseguo.
        $closeTasks = [
            'com_content' => ['article.save', 'article.cancel', 'article.save2new'],
            'com_config'  => ['modules.save', 'modules.cancel'],
        ];

        if (isset($closeTasks[$option]) && \in_array($task, $closeTasks[$option], true)) {
            $app->setUserState(self::STATE_KEY, null);

            return;
        }

        // 2) E' una richiesta di APERTURA di una scheda di modifica?
        $type      = '';
        $currentId = 0;

        if ($option === 'com_content' && $task === 'article.edit') {
            // com_content usa 'a_id' (o 'cid[]' in POST) come chiave, non 'id'.
            $type = 'article';
            $cid  = (array) $input->get('cid', [], 'array');

            $currentId = (int) ($cid[0] ?? 0);

            if (!$currentId) {
                $currentId = (int) $input->getInt('a_id');
            }
        } elseif ($option === 'com_config' && $view === 'modules' && strncmp($task, 'modules.', 8) !== 0) {
            // Apertura del form di modifica di un modulo dal frontend.
            $type      = 'module';
            $currentId = (int) $input->getInt('id');
        }

        if ($type === '') {
            return;
        }

        // 3) Confronto con l'elemento eventualmente gia aperto.
        $open = $app->getUserState(self::STATE_KEY);
        $now  = time();

        // Lock scaduto per inattivita: lo ignoro.
        if (\is_array($open) && ($now - (int) ($open['time'] ?? 0)) > self::STALE_SECONDS) {
            $open = null;
        }

        $isSameItem = \is_array($open)
            && ($open['type'] ?? '') === $type
            && (int) ($open['id'] ?? 0) === $currentId;

        if (\is_array($open) && !empty($open['type']) && !$isSameItem) {
            // L'utente sta gia modificando un altro elemento: BLOCCO l'apertura.
            $app->enqueueMessage(
                'Puoi modificare un solo elemento alla volta. Salva o chiudi la scheda di modifica gia aperta prima di aprirne un\'altra.',
                'warning'
            );

            $return = base64_decode((string) $input->get('return', '', 'base64'));

            if ($return === '' || !Uri::isInternal($return)) {
                $return = Uri::root();
            }

            $app->redirect($return);

            return;
        }

        // Nessun altro elemento aperto (o e lo stesso): registro/aggiorno il lock.
        $app->setUserState(self::STATE_KEY, ['type' => $type, 'id' => $currentId, 'time' => $now]);
    }
}
