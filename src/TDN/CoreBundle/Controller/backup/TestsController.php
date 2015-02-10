<?php

namespace TDN\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

use TDN\RedactionBundle\Entity\Article;
use TDN\ConseilExpertBundle\Entity\ConseilExpert;
use TDN\DossierRedactionBundle\Entity\Dossier;
use TDN\VideoBundle\Entity\Video;

class TestsController extends Controller {
    
    public function policesAction () {

        return $this->render('CoreBundle:Tests:testPolices.html.twig', array());
    }
}
