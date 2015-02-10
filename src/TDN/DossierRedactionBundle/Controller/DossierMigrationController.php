<?php

namespace TDN\DossierRedactionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Controller\DefaultMigrationController;

use TDN\DossierRedactionBundle\Entity\Dossier;
use TDN\ImageBundle\Entity\Image;
use TDN\RedactionBundle\Entity\Article;

class DossierMigrationController extends DefaultMigrationController
{
	private $dossiers = array();

    public function migrationAction($fichier)
    {
		set_time_limit(0);
       	$em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_dossiers = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');

        $log = fopen('logMigration-'.date('Y-m-d-Hi').'.txt', 'w');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$i = 1;
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$done = $rep_dossiers->findOneByV2ID($row[$champs['id_dossier']]);
	    		if ($done instanceof Dossier) {
	    			if (stripslashes($row[$champs['titre']]) != $done->getTitre()) {
		    			print_r(" - ".$row[$champs['id_dossier']].$row[$champs['titre']]." >>> ".$done->getTitre()." Erreur de migration</br>");
		    			fwrite($log, " - ".$row[$champs['id_dossier']]." Erreur de migration");
	    			} else {
		    			print_r(" - ".$row[$champs['id_dossier']]." en doublon</br>");
		    			fwrite($log, " - ".$row[$champs['id_dossier']]." en doublon");
	    			}
	    		} elseif (($row[$champs['dossier_banc']] == 0) || ($row[$champs['ordre']] != 0)) {
		    			print_r(" - ".$row[$champs['id_dossier']]." passe</br>");
		    			fwrite($log, " - ".$row[$champs['id_dossier']]." passe");
	    		} else {
		    		$_importable = true;
		    		$objet = new Dossier;
		    		$objet->setTitre(stripslashes($row[$champs['titre']]));
		    		$objet->setSlug($objet->makeSlug($row[$champs['titre']]));
		    		$objet->setAbstract(stripslashes($row[$champs['contenu']]));
					$objet->setLikes(0);
					$objet->setHits('');
					$objet->setVersion(1);
		    		$objet->setTags($row[$champs['tags']]);
		    		$objet->setStatut($row[$champs['statut']] == 0 ? 'DOSSIER_BROUILLON' : 'DOSSIER_PUBLIE');
					if ((string)$row[$champs['date_post']] === 'NULL') {
						$objet->setDatePublication(new \DateTime("2009-06-01 00:00:00"));
					} else {
						$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
					}
					$objet->setDateModification(new \DateTime(date('Y-m-d H:i:s')));
					$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
					$objet->setLnPromu(NULL);
					$objet->setV2ID($row[$champs['id_dossier']]);

					// Auteur par défaut
					$_auteur = $rep_nanas->find(3);
					$objet->setLnAuteur($_auteur);

				    $_ssActuelles = array();
				    $ssc = explode(',', $row[$champs['dossier_banc']]);
				    print_r($ssc);
			        foreach ($ssc as $rubrique) {
			        	$rubrique = (integer)$rubrique;
				        if (!is_object($this->ssrubV3[$rubrique])) {
				        	$this->ssrubV3[$rubrique] = $rep_rubriques->find($rubrique);
				        }
				        if (is_object($this->ssrubV3[$rubrique])) {
				        	$objet->addRubrique($this->ssrubV3[$rubrique]);
				        }
						$_ssActuelles[] = $this->ssrubV3[$rubrique]->getIdRubrique();
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
	print_r("[$i] ".$_rubriques." ".$_ill." ".stripslashes($row[$champs['titre']]." ".$_auteur->getUsername()." ".$row[$champs['id_dossier']]."</br>"));
					fwrite($log, sprintf('[%d] $s %s | %s\n', $objet->getV2ID(), $_ill, $_rubriques,  $objet->getTitre()));
					$i += 1;
	    		}
	        }
		    fclose($handle);
	    } else {
	    	echo "Fichier inexistant";
	    }
	   fclose($log);

        return $this->redirect($this->generateURL('DossierRedaction_index'));
    }

       public function migrationFeuilletsAction($fichier)
    {
		set_time_limit(0);
       	$em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_articles = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $rep_dossiers = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');

        $log = fopen('logMigration-'.date('Y-m-d-Hi').'.txt', 'w');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$i = 1;
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		if (isset($row[4])) {
		    		print_r($row[$champs['titre']]);
		    		$done = $rep_articles->findOneByTitre($row[$champs['titre']]);
		    		if ($done instanceof Article) {
		    			print_r(" - ".$row[$champs['id_piece']]." en doublon</br>");
		    			fwrite($log, " - ".$row[$champs['id_piece']]." en doublon");
		    		} else {
	    				if (!isset($this->dossiers[$row[$champs['id_dossier']]])) {
							$d = $rep_dossiers->findOneByV2ID($row[$champs['id_dossier']]);
							if ($d instanceof Dossier) {
								$this->dossiers[$row[$champs['id_dossier']]] = $d;
							} else {
								$this->dossiers[$row[$champs['id_dossier']]] = '';
							}
						}
						if ($this->dossiers[$row[$champs['id_dossier']]] instanceof Dossier) {
				    		$_importable = true;
				    		$objet = new Article;
				    		$objet->setCorps(stripslashes($row[$champs['contenu']]));
				    		$objet->setSponsor(false);

							$d = $this->dossiers[$row[$champs['id_dossier']]];
							$objet->setLnDossier($d);
							$rubriques = $d->getRubriques();
							foreach ($rubriques as $r) {
								$objet->addRubrique($r);
							}

				    		$objet->setTitre(strip_tags(stripslashes($row[$champs['titre']])));
				    		$objet->setAbstract('');
				    		$objet->setSlug($objet->makeSlug(strip_tags($row[$champs['titre']])));
							$objet->setLikes(0);
							$objet->setHits('');
							$objet->setVersion(1);
				    		$objet->setTags($row[$champs['tags']]);
				    		$objet->setStatut($row[$champs['statut']] == 0 ? 'ARTICLE_BROUILLON' : 'ARTICLE_FEUILLET');
							if (in_array((string)$row[$champs['date_post']], array('0000-00-01', 'NULL'))) {
								$objet->setDatePublication(new \DateTime("2009-06-01 00:00:00"));
							} else {
								$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
							}
							$objet->setDateModification(new \DateTime(date('Y-m-d H:i:s')));
							$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
							$objet->setLnPromu(NULL);
							$objet->setV2ID($row[$champs['id_piece']]);

							// Auteur par défaut
							$_auteur = $rep_nanas->find(3);
							$objet->setLnAuteur($_auteur);

							$objet->setOrdreDossier($row[$champs['ordre']]);

		   			        $image = $rep_images->findOneByV2ID($row[$champs['id_photo']]);
					        if ($image instanceof Image) {
					    		$_ill = "+";
						        $objet->setLnIllustration($image);
						    } else {
						    	$_ill = "-";
						    }

						    $rubs = array();
							foreach ($objet->getRubriques() as $r) $rubs[] = $r->getTitre();
							$_rubriques = implode(' > ', $rubs);

							$em->persist($objet);
							$em->flush();								

							print_r("[$i] ".$_rubriques." ".$_ill." ".stripslashes($row[$champs['titre']]." ".$_auteur->getUsername()." ".$objet->getLnDossier()->getTitre()."</br>"));
							fwrite($log, sprintf('[%d] $s %s | %s\n', $objet->getV2ID(), $_ill, $_rubriques,  $objet->getTitre()));
							$i += 1;

						} else {
			    			// print_r("[$i] - ".$row[$champs['id_dossier']]." non pris en compte par Marylin</br>");
			    			fwrite($log, " - ".$row[$champs['id_dossier']]." non pris en compte par Marylin");						
						}
		    		}
	    		} else {
			    	print_r(" !!! Ligne non analysée</br>");
			    	fwrite($log, " !!! Ligne non analysée");	    			
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

}
