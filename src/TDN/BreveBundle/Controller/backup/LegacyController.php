<?php

namespace TDN\BreveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LegacyController extends Controller {
    
    public function equipeAction() {
	
		return $this->redirect($this->generateURL('BreveBundle_fil'), 301);

    }
}
