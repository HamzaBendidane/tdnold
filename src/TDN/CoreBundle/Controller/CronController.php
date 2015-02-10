<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\CoreBundle\Entity\Journal;

class CronController extends Controller {

    private $repertoire_logs = "../app/logs/";

    public function deleteProdLogAction () {

        // $me = $this->getUser();
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_journal = $em->getRepository('TDN\CoreBundle\Entity\Journal');
        $security = $this->container->get('security.context');

        unlink($_SERVER['DOCUMENT_ROOT'].$this->repertoire_logs.'prod.log');
        die;

        return $this->render('CoreBundle:Bloc:header.html.twig', $slots);
    }
}