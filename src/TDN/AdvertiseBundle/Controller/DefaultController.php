<?php

namespace TDN\AdvertiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AdvertiseBundle:Default:index.html.twig', array('name' => $name));
    }
}
