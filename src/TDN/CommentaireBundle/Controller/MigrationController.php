<?php

namespace TDN\CommentaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\CommentaireBundle\Entity\Commentaire;

class MigrationController extends Controller
{
    public function migrationAction($fichier)
    {
    	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_docs = $em->getRepository('TDN\DocumentBundle\Entity\Document');
        $rep_comms = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
        $rep_article = $em->getRepository('TDN\RedactionBundle\Entity\Article');
        $rep_conseil = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');
        $rep_shopping = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');
        $rep_video = $em->getRepository('TDN\VideoBundle\Entity\Video');
        $rep_dossier = $em->getRepository('TDN\DossierRedactionBundle\Entity\Feuillet');

        $log = fopen('logs/logMigration-Commentaire-'.date('m-d-H+i').'.txt', 'w');

		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$i = 0;
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
	    		$done = $rep_comms->findByV2ID($row[$champs['id_com']]);
	    		if (!empty($done)) {
	    			print_r("[$i] - ".$row[$champs['id_com']]. " : Déjà importé");
	    			echo '<br/>';
	    			fwrite($log, "[$i] - ".$row[$champs['id_com']]. " : Déjà importé");
	    		} else {
	    			print_r("[$i] + ".$row[$champs['id_com']]. " : Traitement");
	    			echo '<br/>';
	    			fwrite($log, "[$i] + ".$row[$champs['id_com']]. " : Traitement");
		    		$_importable = true;
		    		$objet = new Commentaire;
		    		$objet->setTexteCommentaire(stripslashes($row[$champs['commentaire']]));
		    		$objet->setAbonne($row[$champs['abonner_fil']]);
		    		$objet->setLike(0);
		    		$objet->setStatut($row[$champs['statut']]);
					$objet->setDatePublication(new \DateTime($row[$champs['date_post']]));
		    		$objet->setIdReponse(0);
		    		$objet->setIdThread(uniqid());
					$objet->setV2ID($row[$champs['id_com']]);

		    		if (!empty($row[$champs['id_membre']]) && (0 != $row[$champs['id_membre']])) {
				        $done = $rep_nanas->findByV2ID($row[$champs['id_membre']]);
				        if (count($done) > 0) {
					        $objet->setFilAuteur(array_pop($done));
					        $_auteur = $objet->getFilAuteur()->getUsername();
					    } else {
					    	$_auteur = "";
					    }	    			
		    		}

		    		switch ($row[$champs['id_type']]) {
		    			case '2':
		    				$docs = $rep_conseil->findByV2ID($row[$champs['id_contenu']]);
		    				$classe = 'ConseilExpert';
		    				break;
		    			case '5':
		    				$docs = $rep_shopping->findByV2ID($row[$champs['id_contenu']]);
		    				$classe = 'SelectionShopping';
		    				break;
		    			case '6':
		    				$docs = $rep_video->findByV2ID($row[$champs['id_contenu']]);
		    				$classe = 'Video';
		    				break;
		    			case '8':
		    				$docs = $rep_dossier->findByV2ID($row[$champs['id_contenu']]);
		    				$classe = 'Dossier';
		    				break;
		    			case '1':
		    			default:
		    				$docs = $rep_article->findByV2ID($row[$champs['id_contenu']]);
		    				$classe = 'Article';
		    				break;
		    		}
	    			
					if (empty($docs)) {
						print_r("[$i] * ".$row[$champs['id_contenu']]." : ERREUR Pas de $classe avec cet id");
						fwrite($log, "[$i] * ".$row[$champs['id_contenu']]." : ERREUR Pas de $classe avec cet id");
					} else {
						$d = array_pop($docs);
						$objet->setFilDocument($d);
						print_r("[$i] + ".$row[$champs['id_contenu']]." : $classe appariée");
						fwrite($log, "[$i] + ".$row[$champs['id_contenu']]." : $classe appariée");
					}

					$em->persist($objet);
					$em->flush();
					fwrite($log, sprintf('[%s] Done + %s\n', $row[$champs['id_type']], $row[$champs['id_membre']]));
				}
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
