<?php

namespace TDN\ConseilExpertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Controller\DefaultMigrationController;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\ConseilExpertBundle\Entity\ConseilExpert;

class MigrationController extends DefaultMigrationController
{
	protected $statuts = array('', 'CONSEL_ENREGISTRE', 'CONSEIL_TRANSMIS', 'CONSEIL_REPONDU', 'CONSEIL_PUBLIE');

    public function migrationAction($fichier)
    {
    	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');

        $log = fopen('logs/logMigration-'.date('m-d-H+i').'.txt', 'w');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
			$i = 1;
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$_importable = true;
	    		$objet = new ConseilExpert;
	    		$objet->setQuestion(stripslashes(stripslashes($row[$champs['question']])));
	    		$objet->setReponse(stripslashes(stripslashes($row[$champs['reponse']])));
	    		$objet->setStatut($this->statuts[$row[$champs['statut']]]);

	    		$objet->setTitre(stripslashes(stripslashes($row[$champs['titre']])));
	    		$objet->setAbstract('');
	    		$objet->setSlug($objet->makeSlug($row[$champs['titre']]));
				$objet->setLikes(0);
				$objet->setHits(0);
				$objet->setVersion(1);
	    		$objet->setTags($row[$champs['tags']]);
				if ((string)$row[$champs['date_post']] === 'NULL') {
					$objet->setDatePublication(new \DateTime("2009-06-01 00:00:00"));
					$objet->setDateSoumission(new \DateTime("2009-06-01 00:00:00"));
				} else {
					$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
					$objet->setDateSoumission(new \DateTime($row[$champs['date_post']]));
				}
				$objet->setDateModification(new \DateTime(date('Y-m-d H:i:s')));
				$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
				$objet->setLnPromu(NULL);
				$objet->setV2ID($row[$champs['id_conseil']]);

		        $done = $rep_nanas->findByV2ID($row[$champs['id_questionneur']]);
		        if (count($done) > 0) {
		    		// echo "<p>".$done[0]->getUsername()."<p>";
			        $objet->setLnAuteur(array_pop($done));
			        $_auteur = $objet->getLnAuteur()->getUSername();
					$objet->setAuteur($objet->getLnAuteur()->getIdNana());
			    } else {
			    	$_auteur = "";
					$objet->setAuteur(0);
			    }

		        $done = $rep_nanas->findByV2ID($row[$champs['id_repondeur']]);
		        if (count($done) > 0) {
		    		// echo "<p>".$done[0]->getUsername()."<p>";
			        $objet->setLnExpert(array_pop($done));
			        $_expert = $objet->getLnExpert()->getUSername();
			    } else {
			    	$_expert = "";
			    }

			    $_ssActuelles = array();
		        if ((integer)$row[$champs['id_souscategorie1']] !== 0) {
			        if (!is_object($this->ssrubV3[$row[$champs['id_souscategorie1']]])) {
			        	$this->ssrubV3[$row[$champs['id_souscategorie1']]] = $rep_rubriques->find($this->ssrubV3[$row[$champs['id_souscategorie1']]]);
			        }
			        if (is_object($this->ssrubV3[$row[$champs['id_souscategorie1']]])) {
			        	$objet->addRubrique($this->ssrubV3[$row[$champs['id_souscategorie1']]]);
			        }
					$_ssActuelles[] = $this->ssrubV3[$row[$champs['id_souscategorie1']]]->getIdRubrique();
			     }
		        if ((integer)$row[$champs['id_souscategorie2']] !== 0) {
					$_ssActuelles[] = $row[$champs['id_souscategorie2']];
			        if (!is_object($this->ssrubV3[$row[$champs['id_souscategorie2']]])) {
			        	$this->ssrubV3[$row[$champs['id_souscategorie2']]] = $rep_rubriques->find($this->ssrubV3[$row[$champs['id_souscategorie2']]]);
			        }
			        if (is_object($this->ssrubV3[$row[$champs['id_souscategorie2']]])) {
			        	$id = $this->ssrubV3[$row[$champs['id_souscategorie2']]]->getIdRubrique();
			        	 if (!in_array($id, $_ssActuelles)) {
				        	$objet->addRubrique($this->ssrubV3[$row[$champs['id_souscategorie2']]]);
			        	 }
			        	 $_ssActuelles[] = $id;
			        }
		        }
		        if ((integer)$row[$champs['id_souscategorie3']] !== 0) {
					$_ssActuelles[] = $row[$champs['id_souscategorie3']];
			        if (!is_object($this->ssrubV3[$row[$champs['id_souscategorie3']]])) {
			        	$this->ssrubV3[$row[$champs['id_souscategorie3']]] = $rep_rubriques->find($this->ssrubV3[$row[$champs['id_souscategorie3']]]);
			        }
			        if (is_object($this->ssrubV3[$row[$champs['id_souscategorie3']]])) {
			        	$id = $this->ssrubV3[$row[$champs['id_souscategorie3']]]->getIdRubrique();
			        	 if (!in_array($id, $_ssActuelles)) {
				        	$objet->addRubrique($this->ssrubV3[$row[$champs['id_souscategorie3']]]);
				        }
						$_ssActuelles[] = $id;
			        }
				}
		        if (((integer)$row[$champs['id_categorie']] !== 0) && empty($_ssActuelles)) {
			        if (!is_object($this->rubV3[$row[$champs['id_categorie']]])) {
			        	$this->rubV3[$row[$champs['id_categorie']]] = $rep_rubriques->find($this->rubV3[$row[$champs['id_categorie']]]);
			        }
			        if (is_object($this->rubV3[$row[$champs['id_categorie']]])) {
			        	$objet->addRubrique($this->rubV3[$row[$champs['id_categorie']]]);
			        }
			    }

			    $rubs = array();
				foreach ($objet->getRubriques() as $r) $rubs[] = $r->getTitre();
				$_rubriques = implode(' > ', $rubs);

		    	$_ill = "-";
		        if ($row[$champs['id_photo']] != 0) {
			        $image = $rep_images->findByV2ID($row[$champs['id_photo']]);
			        if (count($image) > 0) {
			    		$_ill = "+";
				        $objet->setLnIllustration(array_pop($image));
				    }
		        }

				$em->persist($objet);
print_r("[$i] ");
				$em->flush();
print_r($_ill." ".stripslashes($row[$champs['titre']]." ".$_rubriques." : ".$_auteur." # ".$_expert." (".$objet->getStatut().")</br>"));
				fwrite($log, sprintf('[%d] - %s | %s > %s\n', $objet->getV2ID(), $objet->getTitre(), $_expert, $_rubriques));
	        	$i += 1;
	        }

	    fclose($handle);
	    } else {
	    	echo "Fichier inexistant";
	    }
   fclose($log);
die;
        return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
    }
}
