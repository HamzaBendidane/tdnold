<?php

namespace TDN\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Controller\DefaultMigrationController;
use TDN\VideoBundle\Entity\Video;

class MigrationController extends DefaultMigrationController
{
	protected $patternHebergeur = '/(youtube)\.\w+\/watch\?(.+)|(youtube|dailymotion|vimeo)\.\w+\/[^\/]+\/([^\?"&\\\]+)|(ultimedia)|(vimeo)\.\w+\/(d+)|(wat)/';
	// protected $patternHebergeur = '/(youtube)\.\w+\/[^\/]+\/([^"&?]+)|(dailymotion)\.\w+\/[^\/]+\/([^"&?]+)|ultimedia|(vimeo)\.\w+\/(d+)|wat)/';

    public function migrationAction($fichier)
    {
    	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_videos = $em->getRepository('TDN\VideoBundle\Entity\Video');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');

        $log = fopen('logs/logMigration-Video-'.date('m-d-H+i').'.txt', 'w');
		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
			$_auteurAnonyme = $rep_nanas->find(1);
			$i = 1;
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$done = $rep_videos->findByV2ID($row[$champs['id_vid']]);
	    		if (!empty($done)) {
	    			fwrite($log, " - Importée [$i] : ".$row[$champs['titre']]." ".$row[$champs['id_vid']]);
	    		} else {
	    			fwrite($log, " + Manquante [$i] : ".$row[$champs['titre']]." ".$row[$champs['id_vid']]);
		    		
		    		$_importable = true;
		    		$_importable = true;
		    		$objet = new Video;
		    		$objet->setTitre(stripslashes($row[$champs['titre']]));
		    		$objet->setCodeIntegration($row[$champs['codehtml']]);
		    		$objet->setVignette($row[$champs['id_screenshot']]);
		    		$objet->setDuree($row[$champs['duree']]);
		    		$_h = preg_match($this->patternHebergeur, $row[$champs['codehtml']], $match);
	// print_r(stripslashes($row[$champs['titre']]));
	// print_r($match);
		    		if (!empty($match)) {
		    			if (!empty ($match[1])) {
		    				$matchers = array(1,2);
		    			} elseif (!empty ($match[3])) {
		    				$matchers = array(3,4);
		    			} elseif (!empty ($match[5])) {
							$matchers = array(5);
		    			} elseif (!empty ($match[7])) {
							$matchers = array(7);
		    			} 
			    		$hebergeur = $match[$matchers[0]];	    		
			    		$objet->setIdHebergeur($hebergeur);
			    		$objet->setSlug($objet->makeSlug($row[$champs['titre']]));	    		
			    		$objet->setAbstract(stripcslashes(stripslashes($row[$champs['accroche']])));

						$objet->setLikes(0);
						$objet->setHits(0);
						$objet->setVersion(1);
						$objet->setTags($row[$champs['tags']]);
						$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
						$objet->setDateModification(new \DateTime($row[$champs['date_post']]));
						$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
						$objet->setV2ID($row[$champs['id_vid']]);

			    		$objet->setStatut($row[$champs['statut']] == 0 ? 'VIDEO_ECARTEE' : 'VIDEO_PUBLIEE');

				        $done = $rep_nanas->findByV2ID($row[$champs['id_membre']]);
				        if (count($done) > 0) {
				    		// echo "<p>".$done[0]->getUsername()."<p>";
					        $objet->setLnAuteur(array_pop($done));
					        $_auteur = $objet->getLnAuteur()->getUsername();
					    } else {
					    	$_auteur = $_auteurAnonyme->getUsername();
					    }

						if ($hebergeur == 'vimeo' || $hebergeur == 1) {
							$squelette = $objet->vimeoImport($match[$matchers[1]]);
							$objet->vimeoBuildParameters($squelette);
							$OriginalTitle = $squelette->video->title;
						} elseif ($hebergeur == 'youtube' || $hebergeur == 2) {
							$squelette = $objet->youtubeImport($match[$matchers[1]]);
							if (empty($squelette->items[0])) {
								$_importable = false;
								print_r(stripslashes($row[$champs['titre']])." : Erreur YouTube > ".$match[$matchers[1]]."<br/>");
								fwrite($log, stripslashes($row[$champs['titre']])." : Erreur YouTube");
							} else {
								$video = $squelette->items[0];
								$objet->youtubeBuildParameters($video);
							}
						} elseif ($hebergeur == 'dailymotion' || $hebergeur == 3) {
							$squelette = $objet->dailymotionImport($match[$matchers[1]]);
							if (isset($squelette->error)) {
								$_importable = false;
								print_r(stripslashes($row[$champs['titre']])." : Erreur DailyMotion > ".$match[$matchers[1]]."<br/>");
								fwrite($log, stripslashes($row[$champs['titre']])." : Erreur DailyMotion");
							} else {
								$objet->dailymotionBuildParameters($squelette);
								$OriginalTitle = $squelette->title;
								
							}
						} elseif ($hebergeur == 'ultimedia') {
								// $objet->buildParametersUltimedia();
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
						print_r($_rubriques);

			            // Enregistrment
			            if ($_importable) {
					        $em->persist($objet);
				    	    $em->flush();
							print_r("[$i] ".$_rubriques." ".stripslashes($row[$champs['titre']]." ".$objet->getIdHebergeur()." ".$_auteur."</br>"));
							fwrite($log, "[$i] ".$_rubriques." ".stripslashes($row[$champs['titre']]." ".$objet->getIdHebergeur()." ".$_auteur."</br>"));
				          	$i += 1;
				        }
		    		} else {
		    			print_r("Pas d'hébergeur");
		    		}
	    		}
	        }
	    fclose($handle);
	    fclose($log);
	    }
die;
        return $this->redirect($this->generateURL('BreveBundle_breveLog'));
    }


    public function updateTagsAction($fichier)
    {
   		set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_videos = $em->getRepository('TDN\VideoBundle\Entity\Video');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');

        $source = dirname(__FILE__).'/'.$fichier.".csv";
		if (is_file($source)) {
	        $log = fopen('logs/logMigration-Video-'.date('m-d-H+i').'.txt', 'w');
			$handle = fopen($source, "r");
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
			$_auteurAnonyme = $rep_nanas->find(1);
			$i = 1;
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$done = $rep_videos->findOneByV2ID($row[$champs['id_vid']]);
	    		if (!($done instanceof Video)) {
	    			fwrite($log, " - Pas de correspondance [$i] : ".$row[$champs['id_vid']]);
	    		} else {
	    			$done->setTags($row[$champs['tags']]);
	    			$em->flush();
	    			print_r(" + Mise à jour [$i] : ".$row[$champs['tags']]." ".$row[$champs['id_vid']]." ".$done->getTitre()."<br/>");
	    			fwrite($log, " + Mise à jour [$i] : ".$row[$champs['tags']]." ".$row[$champs['id_vid']]);
	    		}
	    		$i += 1;
	    	}
	    	fclose($log);
	    	fclose($handle);
	    }

	    die;
	}
}
