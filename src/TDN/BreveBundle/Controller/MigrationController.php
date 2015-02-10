<?php

namespace TDN\BreveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\BreveBundle\Entity\Breve;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\NanaBundle\Entity\Nana;

class MigrationController extends Controller
{
	var $rubV3 = array('', 5, 6, 1, 2, 4, 7, 8, 3, 0);

    public function migrationAction($fichier)
    {
    	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$keys = fgetcsv($handle, NULL, ",");
			$i = 1;
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$objet = new Breve;
	    		$objet->setMessage(str_replace('\\', '', $row[$champs['idee']]));
	    		$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
	    		$objet->setStatut($row[$champs['statut']] == 0 ? 'BREVE_REJETEE' : 'BREVE_PUBLIEE');
		        $done = $rep_nanas->findByV2ID($row[$champs['id_membre']]);
		        if (count($done) > 0) {
		    		echo "<p>$i > ".$done[0]->getUsername()."<p>";
			        $objet->setLnAuteur(array_pop($done));

			        if (!is_object($this->rubV3[$row[$champs['id_categorie']]])) {
			        	$this->rubV3[$row[$champs['id_categorie']]] = $rep_rubriques->find($this->rubV3[$row[$champs['id_categorie']]]);
			        }
			        $objet->setLnRubrique($this->rubV3[$row[$champs['id_categorie']]]);

			        if ($row[$champs['link']] != 'NULL') {
			        	$objet->setURL($row[$champs['link']]);
			        	$tinyURL = $objet->make_tiny($row[$champs['link']]);
			        	if (substr($tinyURL, 0, 7) == 'http://') {
			        		$objet->setTinyURL($tinyURL);
			        	} else {
				        	$objet->setTinyURL(NULL);
			        	}
			        } else {
			        	$objet->setURL(NULL);
			        	$objet->setTinyURL(NULL);
			        }

		            // Enregistrment
			        $em->persist($objet);
		    	    $em->flush();		        	
		        }
		   		$i += 1;
	        }
	    fclose($handle);
	    }
die;
        return $this->redirect($this->generateURL('BreveBundle_breveLog'));
    }

    public function importAction () {

    	$request = $this->get('request');

    	if ($request->getMethod() == 'POST') {
    		$source = $request->get('fichierImport');
    		if (!empty($source)) {
    			$this->migrationAction($source);
    		} else {

    		}
    	} else {

    	}

        return $this->redirect($this->generateURL('BreveBundle_breveLog'));
    }
}
