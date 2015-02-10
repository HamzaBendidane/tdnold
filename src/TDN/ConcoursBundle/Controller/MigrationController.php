<?php

namespace TDN\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\ConcoursBundle\Entity\Concours;
use TDN\ConcoursBundle\Entity\ConcoursQuestion;
use TDN\ConcoursBundle\Entity\ConcoursReponse;

use TDN\ImageBundle\Entity\Image;

class MigrationController extends Controller
{
	protected $rubV3 = array('', 5, 6, 1, 2, 4, 7, 8, 3, 0);
	protected $patternFichier = '/(\d+[-_])?([^\._]+)(_\w{2})?(\.\w+)/';
	protected $old_images = '/home/www/client/justine75/v2_full/';
	protected $root = '/home/www/client/justine75/v3/uploads/documents/public/';

    public function migrationAction($fichier)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_rubriques = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');


        $done = $rep_nanas->findByUsername('Alma');
        $_owner = array_pop($done);
        $log = fopen('logs/logMigrationConcours-'.date('md:H-i').'.txt', 'w');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$done = $rep->findOneByV2ID($row[$champs['id_concours']]);
	    		if ($done instanceof Concours) {

	    		} else {
		    		$objet = new Concours;

		    		$objet->setLnAuteur($_owner);
		    		$objet->setTitre($row[$champs['titre']]);
		    		$objet->setSlug($objet->makeSlug($row[$champs['id_photo']]));
		    		$objet->setAbstract($row[$champs['accroche']]);
					$objet->setLikes(0);
					$objet->setHits(0);
					$objet->setVersion(1);
		    		$objet->setTags('');
		    		$objet->setV2ID($row[$champs['id_concours']]);

		    		$objet->setSponsor($row[$champs['sponsor']]);
		    		// $objet->setSponsorURL($row[$champs['url_sponsor']]);
		    		$objet->setGain('');
		    		$objet->setNombreGagnants($row[$champs['nb_gagnants']]);
		    		$objet->setDateDebut(new \DateTime($row[$champs['date_debut']]));
		    		$objet->setDateArret(new \DateTime($row[$champs['date_fin']]));
					$objet->setDatePublication($objet->getDateDebut());
					$objet->setDateModification($objet->getDateDebut());
					$objet->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
					$objet->setLnPromu(NULL);
		    		$objet->setStatut(($row[$champs['statut']] == 0) ? 'CONCOURS_BROUILLON' : 'CONCOURS_PUBLIE' );
		    		$objet->setTransmission($row[$champs['transmission']]);
		    		$objet->setOpen(true);
		    		$objet->setReponsesVisibles(false);

			        $image = $rep_images->findOneByV2ID($row[$champs['id_photo']]);
			        if ($image instanceof Image) {
			    		// echo "<p>".$done[0]->getUsername()."<p>";
			    		$_ill = "+";
				        $objet->setLnIllustration($image);
				    } else {
				    	$_ill = "-";
				    }

		    		switch($row[$champs['type_jeu']]) {

		    			case '1' :
				    		$objet->setTypeJeuConcours('TOS');

		    				break;

		    			case '2' :
				    		$objet->setTypeJeuConcours('Q&R');
				    		$question = new ConcoursQuestion;
				    		$question->setQuestion($row[$champs['question']]);
				    		$question->setExact(true);
				    		$question->setMultiple(false);
				    		if (!empty($row[$champs['reponse_A']])) {
				    			$reponse = new ConcoursReponse;
				    			$reponse->setReponse($row[$champs['reponse_A']]);
				    			$reponse->setExact(true);
					    		$question->setExact(true);
					    		$question->addFilReponseBack($reponse);
					    		$em->persist($reponse);
				    		} else {
					    		$question->setExact(false);			    			
				    		}
				    		$objet->addQuestionBack($question);
				    		$em->persist($question);
		    				break;

		    			case '3' :
				    		$objet->setTypeJeuConcours('QCM');
				    		$_qindex = array('', '2', '3');
				    		$_rindex = array('A', 'B', 'C');
				    		foreach ($_qindex as $q) {
				    			$question = new ConcoursQuestion;
				    			$radix = ($q == '') ? 'question' : 'question_'.$q;
				    			$question->setQuestion($row[$champs[$radix]]);
					    		$question->setExact(true);
					    		$question->setMultiple(false);
					    		foreach ($_rindex as $r) {
					    			$reponse = new ConcoursReponse;
					    			$radix = 'reponse_'.$r.$q;
					    			$reponse->setReponse($row[$champs[$radix]]);
					    			$reponse->setExact(($r == 'A') ? true : false);
						    		$question->addFilReponseBack($reponse);
						    		$em->persist($reponse);
					    		}
					    		$objet->addQuestionBack($question);
					    		$em->persist($question);
				    		}
		    				break;

		    			case '4' :
		    				break;

		    			default :
		    		}

					$em->persist($objet);
					// $em->flush();
					echo sprintf('[%d] + %s | %s</br>', $objet->getV2ID(), $objet->getTypeJeuConcours(), $objet->getTitre());
					fwrite($log, sprintf('[%d] + %s\n', $objet->getV2ID(), $objet->getTitre()));
	    		}




	        }

		    fclose($handle);
		    fclose($log);
	    }
die;
        return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
    }
}
