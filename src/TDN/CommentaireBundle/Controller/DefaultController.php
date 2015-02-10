<?php

namespace TDN\CommentaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CommentaireBundle:Default:index.html.twig', array('name' => $name));
    }
}
