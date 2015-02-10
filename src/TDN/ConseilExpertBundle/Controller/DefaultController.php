<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ConseilExpertBundle:Default:index.html.twig', array('name' => $name));
    }
}
