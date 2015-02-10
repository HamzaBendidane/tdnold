<?php

namespace TDN\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProduitBundle:Default:index.html.twig', array('name' => $name));
    }
}
