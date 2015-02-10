<?php

namespace TDN\CauseuseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CauseuseBundle:Default:index.html.twig', array('name' => $name));
    }
}
