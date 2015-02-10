<?php

namespace TDN\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ConcoursBundle:Default:index.html.twig', array('name' => $name));
    }
}
