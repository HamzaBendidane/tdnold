<?php

namespace TDN\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LegacyController extends Controller {
    
    public function sommaireConcoursAction ($_format) {

		return $this->redirect($this->generateURL('Concours_sommaire'), 301);
    }
}
