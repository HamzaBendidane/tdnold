<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use TDN\NanaBundle\Entity\Nana;
use TDN\NanaBundle\Form\Type\LoginType;
use TDN\NanaBundle\Form\Type\RestaurationMotDePasseType;

class AjaxController extends Controller {

    public function usernameCheckerAction () {
        $request = $this->getRequest();
        $username = $request->query->get('username');
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $nana = $rep_nana->findOneByUsername($username);
        if (!($nana instanceof Nana)) {
            $data = array('used' => 0);
        } else {
            $data = array('used' => 1);
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }

    public function mailCheckerAction () {
        $request = $this->getRequest();
        $mail = $request->query->get('email');
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $nana = $rep_nana->findOneByEmail($mail);
        if (!($nana instanceof Nana)) {
            $data = array('used' => 0);
        } else {
            $data = array('used' => 1);
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept-Charset', 'utf-8');
        return $response;
    }
}