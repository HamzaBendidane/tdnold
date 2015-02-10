<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\NanaBundle\Entity\Nana;
use TDN\NanaBundle\Entity\NanaRole;
use TDN\NanaBundle\Entity\NanaHobby;
use TDN\ImageBundle\Entity\Image;

class MigrationController extends Controller
{
	protected $old_avatars = '/home/www/client/justine75/v2_full/img/avatars/';
	protected $root = '/home/www/client/justine75/v3/';
	protected $avatars ;
	protected $bundle = 'src/NanaBundle/';

    public function migrationAction($fichier)
    {
	   	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $repository = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles');
    	$this->avatars = $this->root.'uploads/documents/profils/';
        $is_user = $repository->find('ROLE_USER');

		$factory = $this->get('security.encoder_factory');

        $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$i = 0;
	        $log = fopen('logs/logMigration-'.date('md-H+i').'.txt', 'w');
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
		        $doublon = $repository->findDoubleRegistration($row[$champs['pseudo']], $row[$champs['email']]);
	    		// $doublon = $repository->findByUsername($row[$champs['pseudo']]);
		        if ($doublon) {
		    		echo "<p>[$i] ".$row[$champs['id_membre']]." - ".$row[$champs['pseudo']]." - DOUBLON <p>";
		    		// die;
		        } else {
		    		echo "<p>[$i] ".$row[$champs['id_membre']]." + ".$row[$champs['pseudo']]."<p>";
		    		// die;
		    		$nana = new Nana;
		    		$nana->setUsername($row[$champs['pseudo']]);
		            $nana->setSalt(md5(date('Ymd')));
		            $encoder = $factory->getEncoder($nana);
		            $pwd = $encoder->encodePassword($row[$champs['mdp']], $nana->getSalt());
		            $nana->setPassword($pwd);
		    		$nana->setEmail($row[$champs['email']]);
		    		$nana->setPrenom($row[$champs['prenom']]);
		    		$nana->setNom($row[$champs['nom']]);
		    		$nana->setDateNaissance(new \DateTime($row[$champs['date_naiss']]));
					$nana->setSexe(2);
		    		$nana->setDateInscription(new \DateTime($row[$champs['date_inscription']]));
		    		$nana->setVille($row[$champs['ville']]);
		    		$nana->addRole($is_user);
		            $nana->setOccupation($row[$champs['profession']]);
		            $nana->setPopularite(0);
		            $nana->setNewsletter($row[$champs['newsletter']]);
		            $nana->setBlacklist(0);
		            $nana->setActive(1);
		            $nana->setV2ID($row[$champs['id_membre']]);

		            // Enregistrment
			        $em->persist($nana);
		    	    $em->flush();

			        $done = $repository->findByUsername($row[$champs['pseudo']]);
			        $nana = array_pop($done);

			        if ($row[$champs['avatar']] != 'avatar-inconnu.jpg') {
			            // Gestion de l'avatar
			            $source = $this->old_avatars.$row[$champs['avatar']];
			            if (is_file($source)) {
			            	$mime = mime_content_type($source);
							$dc = new \DateTime(date('Y-m-d H:i:s', filemtime($source)));
			            	$cible = $this->avatars."/".$row[$champs['avatar']];
				            $avatar = new Image;
				            $avatar->setFichier($row[$champs['avatar']]);
				            $avatar->setSlug("");
							$avatar->setMimeType($mime);
							$avatar->setTitre('Avatar de '.$nana->getUsername());
							$avatar->setAlt('Avatar de '.$nana->getUsername());
							$avatar->setAbstract("");
							$avatar->setLikes(0);
							$avatar->setHits(0);
							$avatar->setVersion(1);
							$avatar->setStatut('IMAGE_PUBLIQUE');
							$avatar->setDatePublication($dc);
							$avatar->setDateModification($dc);
							$avatar->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
				            $nana->setLnAvatar($avatar);
				            $dir = $this->avatars.$nana->getIdNana();
				            if (!is_dir($dir)) {
				            	mkdir($dir);
				            }

				            $imageProcessor = $this->get('tdn.image_processor');
				            $imSource = new \Imagick($source);
							$imSource->scaleImage(0,700);
				            $imSource->writeImage($dir.'/'.$row[$champs['avatar']]);	        	
				            // Recadrage vers une image carrée
				            try {
					            $squared = new \Imagick($dir.'/'.$avatar->getFichier());
					            $geo = $squared->getImageGeometry();
					            if ($geo['width'] > $geo['height']) {
									$squared->scaleImage(0,300);
					            	$geoS = $squared->getImageGeometry();
									$offsetX = floor(($geoS['width'] - 300)/2);
									$offsetY = 0;
								} else {
									$squared->scaleImage(300,0);
					            	$geoS = $squared->getImageGeometry();
									$offsetX = 0;
									$offsetY = floor(($geoS['height'] - 300)/2);
								}
								$squared->cropImage(300, 300, $offsetX, $offsetY);
								$cible = $dir.'/sqr_'.$avatar->getFichier();
								$squared->writeImage($cible);
								$squared->destroy();				            	
				            } catch (Exception $e) {
				            	echo "<p>Erreur de format : ".$avatar->getFichier()."</p>";
				            }

					        $em->persist($avatar);
				    	    $em->flush();
			            }
			        }
		        	
		        }
		        $i += 1;
	        }
	    fclose($log);
	    fclose($handle);
	    }
die;
        return $this->redirect($this->generateURL('NanaBundle_log'));
    }

 
    public function makeAvatarsAction ($fichier)
    {
	   	set_time_limit(0);
   		$em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $repository = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles');
    	$this->avatars = $this->root.'uploads/documents/profils/';
        $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$i = 0;
	        $log = fopen('logs/logMigration-Avatars-'.date('md-H+i').'.txt', 'w');
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		if ($row[$champs['avatar']] != 'avatar-inconnu.jpg') {
			        $nanas = $repository->findByV2ID($row[$champs['id_membre']]);
					if (!empty($nanas)){
				        $nana = $nanas[0];
				        print_r("Traite [$i] ".$nana->getIdNana().' '.$nana->getUsername());
			            // Gestion de l'avatar
			            $source = $this->old_avatars.$row[$champs['avatar']];
		    	        if (is_file($source)) {
		    	        	print_r($source);
				            $dir = $this->avatars.$nana->getIdNana();
		    	        	$squared = $dir."/sqr_".$row[$champs['avatar']];
		    	        	if (is_file($squared)) {
		    	        	} else {
				            	if (!is_dir($dir)) {
				            		mkdir($dir);
				            	}
				            	$imSource = new \Imagick($source);
								$imSource->scaleImage(0,700);
				            	$imSource->writeImage($dir.'/'.$row[$champs['avatar']]);
				            	$imSource->destroy();        	
				            	// Recadrage vers une image carrée
				            	try {
						            $squared = new \Imagick($source);
						            $geo = $squared->getImageGeometry();
						            if ($geo['width'] > $geo['height']) {
										$squared->scaleImage(0,300);
						            	$geoS = $squared->getImageGeometry();
										$offsetX = floor(($geoS['width'] - 300)/2);
										$offsetY = 0;
									} else {
										$squared->scaleImage(300,0);
						            	$geoS = $squared->getImageGeometry();
										$offsetX = 0;
										$offsetY = floor(($geoS['height'] - 300)/2);
									}
									$squared->cropImage(300, 300, $offsetX, $offsetY);
									$squared->writeImage($dir."/sqr_".$row[$champs['avatar']]);
									$squared->destroy();				            	
					            } catch (Exception $e) {
					            	echo "<p>Erreur de format : ".$nana->getUsensme().' '.$avatar->getFichier()."</p>";
					            }	    	        		
		    	        	}
				        }
				   }
			    }
			    $i +=1;
	    	}
	    }
	    die;
    }

    function resetPopulariteAction($debut = 0) {
		
		$em = $this->get('doctrine.orm.entity_manager');
        $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $all = $repository->findPop($debut);

        foreach ($all as $n) {
	        if ($n['idNana'] != 5321) {
	        	echo $n['idNana'];
	        	$nana = $repository->find($n['idNana']);
	        	$nana->resetPopularite();
	        }
        }
        $em->flush();
        die;
    }
}
