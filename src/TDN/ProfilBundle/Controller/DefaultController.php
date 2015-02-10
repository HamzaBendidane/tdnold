<?php

namespace TDN\ProfilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProfilBundle:Default:index.html.twig', array('name' => $name));
    }
}
