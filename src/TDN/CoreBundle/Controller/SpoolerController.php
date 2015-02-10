<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SpoolerController extends Controller {

    public function flushQueueAction ($message_limit = NULL, $time_limit = NULL, $recover = NULL)
    {
        $mailer     = $this->get('mailer');
        $transport  = $mailer->getTransport();

        if ($transport instanceof \Swift_Transport_SpoolTransport) {
            $spool = $transport->getSpool();
            if ($spool instanceof \Swift_ConfigurableSpool) {
                if (!is_null($message_limit)) {
                    $spool->setMessageLimit($message_limit);
                }
                if (!is_null($time_limit)) {
                    $spool->setTimeLimit($time_limit);
                }
            }
            if ($spool instanceof \Swift_FileSpool) {
                if (null !== $recover) {
                    $spool->recover($recover);
                } else {
                    $spool->recover();
                }
            }
            $sent = $spool->flushQueue($this->get('swiftmailer.transport.real'));

            return new Response("<body>".sprintf('sent %s emails', $sent)."</body>");
        }
    }
}