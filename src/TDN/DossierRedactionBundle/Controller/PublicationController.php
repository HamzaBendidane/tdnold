<?php

namespace TDN\DossierRedactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\DocumentBundle\Entity\DocumentType;
use TDN\DocumentBundle\Entity\DocumentRubriqueRepository;


class PublicationController extends Controller {
	
	public function sommaireAction () {

	    $variables = array();  
		$variables['rubrique'] = 'tdn';
		$longueurPage = 40;
		$session = $this->get('session');
		$request = $this->get('request');

		if (empty($rubrique)) {
			$rubrique = $request->query->get('rubrique');
		}
		$page = $request->query->get('page');
		if (!empty($rubrique)) {
			$session->set('tri-rubrique', $rubrique);
		} else {
			if (!empty($page)) {
				$rubrique = $session->get('tri-rubrique');
			} else {
				$rubrique = $session->remove('tri-rubrique');
				$rubrique = 'tdn';
			}
			
		}
		$page = ((int)$page === 0) ? 0 : (int)$page - 1;

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');

		$variables['dossiersRecents'] = $rep->findMostRecent(3);

	    // $listeVideos = $rep->findWithin($longueurPage);
	    if ($rubrique == 'tdn' || empty($rubrique)) {
	    	$variables['listeDossiers'] = $rep->findBy(array('statut' => 'DOSSIER_PUBLIE'), array('idDocument' => 'DESC'), $longueurPage, 1+$page*($longueurPage-1));
		    $variables['totalDossiers'] = $rep->card('DOSSIER_PUBLIE');
	    } else {
	    	$variables['listeDossiers'] = $rep->findByRubrique($rubrique, $longueurPage, $page);
		    $variables['totalDossiers'] = $rep->card('DOSSIER_PUBLIE', $rubrique);
	    }

		$rep = $em->getRepository('TDN\DocumentBundle\Entity\DocumentRubrique');
		$variables['rubriques'] = $rep->findBy(array('parent' => NULL));
		$_objRubrique = $rep->findOneBySlug($rubrique);
		
		$largeurSegment = 4;
		$variables['rubrique'] = $rubrique;
		$variables['nomRubrique'] = ($_objRubrique instanceof DocumentRubrique) ? $_objRubrique->getTitre() : 'Toutes';

		$variables['page'] = $page + 1;
		$variables['derniere'] = ceil($variables['totalDossiers'] / $longueurPage);

		// Affichage de la page
		return $this->render('DossierRedactionBundle:Page:dossierSommaire.html.twig', $variables);
	}

	public function dossierAction ($rubrique, $slug, $id) {
	    $variables = array();  
		$variables['rubrique'] = 'tdn';

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');    
		$rep_dossier = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
		$rep_feuillet = $em->getRepository('TDN\DocumentBundle\Entity\Document');
		$rep_commentaires = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');

		$variables['dossier'] = $rep_dossier->find($id);
		$variables['feuillets'] = $rep_feuillet->findBy(array('lnDossier' => $id), array('ordreDossier' => 'ASC'));
		$variables['compte_parties'] = count($variables['feuillets']);

		$rubriques = $variables['dossier']->getRubriques();
		$variables['rubrique'] = $rubriques[0]->getSuperSlug();

		$variables['dossier']->updateHits();
		$em->flush();

		$variables['canonical'] = $this->generateURL('DossierRedaction_dossier', 
			array('id' => $variables['dossier']->getIdDocument(),
				  'slug' => $variables['dossier']->getSlug(),
				  'rubrique' => $rubriques[0]->getSlug())
			);
		$variables['meta_description'] = strip_tags($variables['dossier']->getAbstract());

		// Documents proches (pour aller plus loin)
	    $rep_tags = $em->getRepository('TDN\DocumentBundle\Entity\Tag');
	    $statement = $this->get('database_connection');	    
	    $sims = $rep_tags->findSimilars($id);

	    $rep_docs = $em->getRepository('TDN\DocumentBundle\Entity\Document');
	    $variables['similaires'] = array();
	    foreach($sims as $s) {
	    	$variables['similaires'][] = $rep_docs->find($s['id']);
	    }

	    $variables['paths'] = array(
	    	'Article' => 'RedactionBundle_article',
	    	'ConseilExpert' => 'ConseilExpert_conseil',
	    	'Question' => 'CauseuseBundle_conversation',
	    	'Video' => 'VideoBundle_video',
	    	'Dossier' => 'DossierRedaction_dossier'
	    	);

		// Affichage de la page
		return $this->render('DossierRedactionBundle:Page:dossierAbstract.html.twig', $variables);

	}

	public function feuilletAction ($rubrique, $slug, $id) {
	    $variables = array();  
		$variables['rubrique'] = 'tdn';

	    $em = $this->get('doctrine.orm.entity_manager');    
		$rep_dossier = $em->getRepository('TDN\DossierRedactionBundle\Entity\Dossier');
		$rep_feuillet = $em->getRepository('TDN\DocumentBundle\Entity\Document');
		$rep_commentaires = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
		$rep_main = $em->getRepository('TDN\RedactionBundle\Entity\Article');
		$rep_sel = $em->getRepository('TDN\RedactionBundle\Entity\SelectionShopping');
		$rep_vid = $em->getRepository('TDN\VideoBundle\Entity\Video');
		$rep_cons = $em->getRepository('TDN\ConseilExpertBundle\Entity\ConseilExpert');

		// Rechercher l'article
		$piece = $rep_main->find($id);
		$variables['type'] = "article";
		if (!is_object($piece)) {
			$piece = $rep_sel->find($id);
			$variables['type'] = "selection";
		}
		if (!is_object($piece)) {
			$piece = $rep_cons->find($id);
			$variables['type'] = "conseil";
		}
		if (!is_object($piece)) {
			$piece = $rep_vid->find($id);
			$variables['type'] = "video";
			if (is_object($piece)) {
						$hebergeur = $piece->getIdHebergeur();
				switch ($hebergeur) {
					case 'dailymotion':
					case '2':
						$params = $piece->getParams();
						$params = json_decode($params);
						$variables['codeIntegration'] = $piece->getCodeIntegration();
						$variables['codeIntegration'] = str_replace('480', '360', $variables['codeIntegration']);
						$variables['codeIntegration'] = str_replace('360', '203', $variables['codeIntegration']);
						$minutes = floor($piece->getDuree()/60);
						$secondes = $piece->getDuree() - ($minutes * 60);
						$variables['duree'] = $minutes."' ".$secondes."\"";
						break;
					case 'vimeo':
					case '1':
						$ID = $piece->getIdVideo();
						$variables['codeIntegration'] = "<iframe src='http://player.vimeo.com/video/$ID' width='360' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
						break;
					case 'youtube':
					case '0':
						$ID = $piece->getIdVideo();
						$variables['codeIntegration'] = "<iframe width='360' height='270' src='https://www.youtube.com/embed/$ID?rel=0' frameborder='0' allowfullscreen></iframe>";
						break;
					default:
						$variables['codeIntegration'] = stripslashes($piece->getCodeIntegration());
				}
			}
		}
		$variables['main'] = $piece;
		$dossier = $variables['main']->getLnDossier();		
		$variables['feuillets'] = $rep_feuillet->findBy(array('lnDossier' => $dossier->getIdDocument()), array('ordreDossier' => 'ASC'));

		$rubriques = $variables['main']->getLnDossier()->getRubriques();
		$variables['rubrique'] = $rubriques[0]->getSuperSlug();

		$variables['main']->updateHits();
		$em->flush();

		$variables['canonical'] = $this->generateURL('DossierRedaction_feuillet', 
			array('id' => $variables['main']->getIdDocument(),
				  'slug' => $variables['main']->getSlug(),
				  'rubrique' => $rubriques[0]->getSlug())
			);
		$variables['meta_description'] = strip_tags($variables['main']->getAbstract());

		// $variables['auteur'] = "Emmaaa";
		// $variables['age'] = "13 ans";
		// $variables['expert'] = "Justine Andanson";
		// $variables['role'] = "Journaliste";
		// $variables['datePublication'] = "10/10/2012";
		// $variables['nomDeRubrique'] = "beauté";
		// $variables['fullURL'] = "/$rubrique/article/$slug,$id,full";
		
		// Affichage de la page
		return $this->render('DossierRedactionBundle:Page:dossierFeuillet.html.twig', $variables);

	}
}
