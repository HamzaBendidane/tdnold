<?php

namespace TDN\SliderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SliderBundle:Default:index.html.twig', array('name' => $name));
    }
}
