<?php

namespace TDN\BreveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BreveBundle:Default:index.html.twig', array('name' => $name));
    }
}
