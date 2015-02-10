<?php

namespace TDN\ProduitBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Controller\DefaultMigrationController;
use TDN\ProduitBundle\Entity\Produit;

class MigrationController extends DefaultMigrationController
{

    public function migrationAction($fichier)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');

        $log = fopen('logMigration-'.date('Y-m-d-Hi').'.txt', 'w');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$i = 1;
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$_importable = true;
	    		$objet = new Produit;
	    		$objet->setMarque('');
	    		$objet->setPrix($row[$champs['prix']]);
	    		$objet->setMonnaie('EURO');
	    		$objet->setURL($row[$champs['lien']]);
	    		$objet->setFavori($row[$champs['miseenavant']]);
	    		$objet->setCodePromoTDN(NULL);

	    		$objet->setTitre(stripslashes($row[$champs['titre']]));
	    		$objet->setAbstract(stripslashes($row[$champs['description']]));
	    		$objet->setSlug($objet->makeSlug($row[$champs['titre']]));
				$objet->setLikes(0);
				$objet->setHits(0);
				$objet->setVersion(1);
	    		$objet->setTags(implode(',',	 explode(' ', $row[$champs['tags']])));
	    		$objet->setStatut($row[$champs['statut']] == 0 ? 'PRODUIT_BROUILLON' : 'PRODUIT_PUBLIE');
				if ((string)$row[$champs['date_post']] === 'NULL') {
					$objet->setDatePublication(new \DateTime("2009-06-01 00:00:00"));
				} else {
					$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
				}
				$objet->setDateModification(new \DateTime(date('Y-m-d H:i:s')));
				$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
				$objet->setLnPromu(NULL);
				$objet->setV2ID($row[$champs['id_produit']]);

		        $done = $rep_nanas->findByV2ID($row[$champs['id_membre']]);
		        if (count($done) > 0) {
		    		// echo "<p>".$done[0]->getUsername()."<p>";
			        $objet->setLnAuteur(array_pop($done));
			        $_auteur = $objet->getLnAuteur()->getUSername();
			    } else {
			    	$_auteur = "";
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

		        $image = $rep_images->findByV2ID($row[$champs['id_photo']]);
		        if (count($image) > 0) {
		    		$_ill = "+";
			        $objet->setLnIllustration(array_pop($image));
			    } else {
			    	$_ill = "-";
			    }

			    $rubs = array();
				foreach ($objet->getRubriques() as $r) $rubs[] = $r->getTitre();
				$_rubriques = implode(' > ', $rubs);


				$em->persist($objet);
				$em->flush();
print_r("[$i] ".$_rubriques." ".$_ill." ".stripslashes($row[$champs['titre']]." ".$_auteur."</br>"));
				fwrite($log, sprintf('[%d] $s %s | %s\n', $objet->getV2ID(), $_ill, $_rubriques,  $objet->getTitre()));
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
