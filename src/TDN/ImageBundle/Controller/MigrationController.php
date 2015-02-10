<?php

namespace TDN\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Controller\DefaultMigrationController;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\ImageBundle\Entity\Image;

class MigrationController extends DefaultMigrationController
{
	protected $patternFichier = '/(\d+[-_])?([^\._]+)(_[grand]{2,})?(\.\w+)/';
	protected $old_images = '/home/www/client/justine75/v2_full/';
	protected $root = '/home/www/client/justine75/v3/uploads/documents/public/';

    public function migrationAction($fichier)
    {
    	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');


        $done = $rep_nanas->findByUsername('superAdmin');
        $_owner = array_pop($done);
        $log = fopen('logs/logMigration-'.date('md-H+i').'.txt', 'w');
        $i = 1;
        $k = 0;
		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
		        $doublon = $rep_images->findByV2ID($row[$champs['id_photo']]);
		        if (!empty($doublon)) {
		        	print_r('Déjà importée : '.$row[$champs['id_photo']]);
		        } else {
		    		$_importable = true;
	   				$creationDateTime = '';
		    		$objet = new Image;
		    		$path = explode("/", $row[$champs['photo_web']]);
		    		$format = preg_match($this->patternFichier, array_pop($path), $matches);
		    		if (empty($matches)) {
						fwrite($log, sprintf('-%d- - %s\n', $row[$champs['id_photo']], $row[$champs['photo_web']]));
		    		} else {
		    			// récupératin de la date réelle de création;
	  					$dossierAnnee = "";
		    			if ($matches[1] != '') {
		    				$dateCreation = preg_match("/(\d{4})(\d{0,2})(\d{0,2})/", $matches[1], $dateMatches);
		    				if (!empty($dateMatches)) {
			    				$dossierAnnee = "photos/".$dateMatches[1].'/';
			    				$dateCreation = $dateMatches[1];
			    				$mois = (integer)$dateMatches[3];
			    				$dateCreation .= (($mois <= 0) || ($mois > 12)) ? '-01' : '-'.$dateMatches[3];
			    				$jour = (integer)$dateMatches[2];
			    				$dateCreation .= (($jour <= 0) || ($jour > 31)) ? '-01' : '-'.$dateMatches[2];
			    				$dateCreation .= ' 00:00:00';
			    				$creationDateTime = new \DateTime($dateCreation);
		    				}
		    			}

		    			$errFile = false; // pas d'erreur a priori
		    			$source = $this->old_images.$dossierAnnee.$matches[0];
		    			if (!is_file($source)) {
		    				$source = $this->old_images.$row[$champs['photo_web']];
		    				if (!is_file($source)) {
		    					$errFile = true;
		    					$k += 1;
		    				}
		    			}
			    		if ($errFile) {
			    			echo "<p>".(string)$errFile." | $i > ".$row[$champs['photo_web']]."</p>";
							fwrite($log, sprintf('/%d/ U %s\n', $row[$champs['id_photo']], $row[$champs['photo_web']]));
		    			} else {
			    			$regFile = $matches[2].$matches[4];
			    			$regFile = str_replace(' ', '-', $regFile);
				    		$objet->setFichier($regFile);
			    			$objet->setAlt('');
			    			$objet->setMimeType(mime_content_type($source));

				    		$objet->setTitre($matches[2]);
				    		$objet->setAbstract('');
				    		$objet->setSlug($objet->makeSlug($matches[2]));
							$objet->setLikes(0);
							$objet->setHits(0);
							$objet->setVersion(1);
				    		$objet->setTags('');
				    		$objet->setStatut('IMAGE_PUBLIQUE');

				    		if (is_object($creationDateTime)) {
								$objet->setDatePublication($creationDateTime);
								$objet->setDateModification($creationDateTime);			    			
				    		} else {
								$objet->setDatePublication(new \DateTime(date('Y-m-d H:i:s', filemtime($source))));
								$objet->setDateModification(new \DateTime(date('Y-m-d H:i:s', filemtime($source))));			    			
				    		}
							$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
							$objet->setLnPromu(NULL);
							$objet->setV2ID($row[$champs['id_photo']]);

							$objet->setLnAuteur($_owner);
							$objet->setIdOwner($_owner);

							$anneeCreation = $objet->getDatePublication()->format('Y');
							$destFolder = $this->root.$anneeCreation;
							$destSubFolder = $this->root.$anneeCreation.$objet->getDatePublication()->format('/m');
				            if (!is_dir($destSubFolder)) {
					            if (!is_dir($destFolder)) {
					            	mkdir($destFolder);
					            }
				            	mkdir($destSubFolder);
				            }
				            // $image = new \Imagick($source);
				            // echo " Largeur : ".$image->getImageWidth();
				            // $image->thumbnailImage(200,0);
				            copy($source, $destSubFolder.'/'.$objet->getFichier());
				            $squared = new \Imagick($destSubFolder.'/'.$objet->getFichier());
				            $geo = $squared->getImageGeometry();
				            if (($geo['width'] == 300) && ($geo['height'] == 235)) {
								$squared->scaleImage(0, 200);
								$squared->cropImage(200, 200, 25, 0);
								$cible = $destSubFolder.'/sqr_'.$objet->getFichier();
								$squared->writeImage($cible);
								$squared->destroy();
				            }
				 			echo "<p>".sprintf('[%d] + %s\n', $objet->getV2ID(), $destSubFolder.'/'.$objet->getFichier())."</p>";

							// $em->persist($objet);			            	
							// $em->flush();
							fwrite($log, sprintf('[%d] + %s\n', $objet->getV2ID(), $destSubFolder.'/'.$objet->getFichier()));
		    			}
		    		}

		        }
	    		$i += 1;
	        }

	    fclose($handle);
	    fclose($log);
	    }
echo "<p>Absentes : $k</p>";
die;
        return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
    }

 }
