<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LegacyController extends Controller {

    private $managers = array(
        'articles' => "TDN\RedactionBundle\Entity\Article", 
        'shopping' => "TDN\RedactionBundle\Entity\SelectinShopping",
        'conseils' => "TDN\ConseilExpertBundle\Entity\ConseilExpert",
        'questions' => "TDN\CauseuseBundle\Entity\Question",
        'videos' => "TDN\VideoBundle\Entity\Video",
        'concours' => "TDN\ConcoursBundle\Entity\Concours",
        'dossiers' => "TDN\DossierBundle\Entity\Dossier"
        );

    public function rebuildThematiqueAction ($type = 'articles') {

        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository($this->managers[$type]);

        $documents = $rep->findWithoutThematique(1000);
        foreach($documents as $_TDNDocument) {
            $rubriques = $_TDNDocument->getRubriques();
            $_TDNDocument->setLnThematique($rubriques[0]);
            $_TDNDocument->removeRubrique($rubriques[0]);
        }

        $em->flush();

        die;
    }
}
