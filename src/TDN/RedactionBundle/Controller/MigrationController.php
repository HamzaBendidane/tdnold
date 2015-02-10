<?php

namespace TDN\RedactionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Controller\DefaultMigrationController;
use TDN\RedactionBundle\Entity\Article;

class MigrationController extends DefaultMigrationController
{

    public function migrationAction($fichier)
    {
		set_time_limit(0);
       	$em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_articles = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');

        $log = fopen('logMigration-'.date('Y-m-d-Hi').'.txt', 'w');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$i = 1;
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$done = $rep_articles->findOneByV2ID($row[$champs['id_article']]);
	    		if ($done instanceof Article) {
	    			if (stripslashes($row[$champs['titre']]) != $done->getTitre()) {
		    			print_r(" - ".$row[$champs['id_article']].$row[$champs['titre']]." >>> ".$done->getTitre()." Erreur de migration</br>");
		    			fwrite($log, " - ".$row[$champs['id_article']]." Erreur de migration");
	    			} else {
		    			print_r(" - ".$row[$champs['id_article']]." en doublon</br>");
		    			fwrite($log, " - ".$row[$champs['id_article']]." en doublon");
	    			}
	    		} else {
		    		$_importable = true;
		    		$objet = new Article;
		    		$objet->setCorps(stripslashes($row[$champs['contenu']]));
		    		$objet->setSponsor($row[$champs['sponsorise']]);

		    		$objet->setTitre(stripslashes($row[$champs['titre']]));
		    		$objet->setAbstract('');
		    		$objet->setSlug($objet->makeSlug($row[$champs['titre']]));
					$objet->setLikes(0);
					$objet->setHits('');
					$objet->setVersion(1);
		    		$objet->setTags($row[$champs['tags']]);
		    		$objet->setStatut($row[$champs['statut']] == 0 ? 'ARTICLE_BROUILLON' : 'ARTICLE_PUBLIE');
					if ((string)$row[$champs['date_post']] === 'NULL') {
						$objet->setDatePublication(new \DateTime("2009-06-01 00:00:00"));
					} else {
						$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
					}
					$objet->setDateModification(new \DateTime(date('Y-m-d H:i:s')));
					$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
					$objet->setLnPromu(NULL);
					$objet->setV2ID($row[$champs['id_article']]);

			        $done = $rep_nanas->findByV2ID($row[$champs['id_membre']]);
			        if (count($done) > 0) {
			    		// echo "<p>".$done[0]->getUsername()."<p>";
				        $objet->setLnAuteur(array_pop($done));
				        $_auteur = $objet->getLnAuteur()->getUSername();
				    } else {
				    	$_auteur = "";
				    }

				    $_ssActuelles = array();
				    $ssc1 = (integer)$row[$champs['id_souscategorie1']];
				    $ssc2 = (integer)$row[$champs['id_souscategorie2']];
				    $ssc3 = (integer)$row[$champs['id_souscategorie3']];
			        if ( $ssc1 != 0) {
				        if (!is_object($this->ssrubV3[$ssc1])) {
				        	$this->ssrubV3[$ssc1] = $rep_rubriques->find($this->ssrubV3[$ssc1]);
				        }
				        if (is_object($this->ssrubV3[$ssc1])) {
				        	$objet->addRubrique($this->ssrubV3[$ssc1]);
				        }
						$_ssActuelles[] = $this->ssrubV3[$ssc1]->getIdRubrique();
				     }

			        if ($ssc2 != 0) {
				        if (!is_object($this->ssrubV3[$ssc2])) {
				        	$this->ssrubV3[$ssc2] = $rep_rubriques->find($this->ssrubV3[$ssc2]);
				        }
				        if (is_object($this->ssrubV3[$ssc2])) {
				        	$id = $this->ssrubV3[$ssc2]->getIdRubrique();
				        	 if (!in_array($id, $_ssActuelles)) {
					        	$objet->addRubrique($this->ssrubV3[$ssc2]);
				        	 }
				        	 $_ssActuelles[] = $id;
				        }
				     }
				     
			        if ($ssc3 != 0) {
				        if (!is_object($this->ssrubV3[$ssc3])) {
				        	$this->ssrubV3[$ssc3] = $rep_rubriques->find($this->ssrubV3[$ssc3]);
				        }
				        if (is_object($this->ssrubV3[$ssc3])) {
				        	$id = $this->ssrubV3[$ssc3]->getIdRubrique();
				        	 if (!in_array($id, $_ssActuelles)) {
					        	$objet->addRubrique($this->ssrubV3[$ssc3]);
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
	print_r("[$i] ".$_rubriques." ".$_ill." ".stripslashes($row[$champs['titre']]." ".$_auteur." ".$row[$champs['id_article']]."</br>"));
					fwrite($log, sprintf('[%d] $s %s | %s\n', $objet->getV2ID(), $_ill, $_rubriques,  $objet->getTitre()));
					$i += 1;
	    		}
	        }

	    fclose($handle);
	    } else {
	    	echo "Fichier inexistant";
	    }
   fclose($log);
die;
        return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
    }

	public function migrationV1IDAction($fichier) {

		set_time_limit(0);
       	$em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_articles = $em->getRepository('TDN\RedactionBundle\Entity\Article');

        try {
        	$handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r");
			if ($handle !== FALSE) {
				$i = 1;
				$keys = fgetcsv($handle, NULL, ",");
				$champs = array_flip($keys);
		    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
		    		$done = $rep_articles->findOneByV2ID($row[$champs['id_article']]);
		    		if ($done instanceof Article) {
		    			$done->setV1ID($row[$champs['id_v1']]);
		    			$em->flush();
		    			print_r(" + ".$row[$champs['id_article']].$done->getTitre().'<br>');
		    		} else {
		    			print_r(" - ".$row[$champs['id_article']]." introuvable</br>");
		    		}
		    	}
	        }
        } catch (\Exception $e) {
        	print_r('Fichier source inexistant');
        } 

        die();
	}

}
