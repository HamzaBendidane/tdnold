<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\ImageBundle\Entity\Image;

use TDN\NanaBundle\Entity\Nana;

use TDN\DocumentBundle\Form\Model\Thematique;
use TDN\DocumentBundle\Form\Model\ThematiqueCollection;
use TDN\DocumentBundle\Form\Type\ThematiqueCollectionType;
use TDN\DocumentBundle\Form\Model\IndexCollection;
use TDN\DocumentBundle\Form\Type\IndexCollectionType;



class AdminController extends Controller {

    /**
     * @var ThematiqueCollection $themes
     *
     */
	protected $themes;

    /**
     * @var ThematiqueCollectionType $formulaireThematiques
     *
     */
	protected $formulaireThematiques;
	protected $slider;
	protected $formulaireSlider;
	protected $indexCollection;
	protected $formulaireIndex;
	protected $twigVars;

	protected function initFormulaireThematiques ($_TDNDocument) {

		$this->themes = new ThematiqueCollection;
		$_principale = $_TDNDocument->getLnThematique();
		if ($_principale instanceof DocumentRubrique) {
			$_theme = new Thematique;
			$_theme->setRubrique($_principale);
			$this->themes->addRubrique($_theme);
		}
		$_rubriques = $_TDNDocument->getRubriques();
		if (!empty($_rubriques)) foreach ($_rubriques as $r) {
			$_theme = new Thematique;
			$_theme->setRubrique($r);
			$this->themes->addRubrique($_theme);
		}
		$this->formulaireThematiques = $this->createForm(new ThematiqueCollectionType, $this->themes);
		$this->twigVars['formThematiques'] = $this->formulaireThematiques->createView();

		return $this;
	}

	protected function resetProperties ($document)
	{
		$document->setLikes(0);
		$document->setHits(0);
		$document->setVersion(1);
		// $document->setDatePublication(new \DateTime);
		$document->setDateModification(new \DateTime);
		$document->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
	}

	protected function processImageIllustration ($image, $usr = NULL, $auteur = NULL) {
		$imageProcessor = $this->get('tdn.image_processor');
		if ($image instanceof Image) {
			if (strlen($image->getTitre()) === 0) {
				$image->setTitre('Sans titre');
			}
			$now = new \DateTime;
			$dossier = '/public/'.$now->format('Y').'/'.$now->format('m').'/';
			$image->init($dossier, $usr, $auteur);
			// Post-traitement de l'image
	        $fichierImage = $image->getFichier();
	        $source = '/'.$this->container->getParameter('media_root').$dossier.$fichierImage;
	        $err = $imageProcessor->square($source, 300, 'sqr_');
	        $err = $imageProcessor->downScale($source, 700, 'height', 'x7_');
	        return true;
		} else {
			return false;
		}
	}

	protected function reuseImageIllustration ($idDoc) {

		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\DocumentBundle\Entity\Document');
		$document = $rep->find($idDoc);
		$image = $document->getLnIllustration();
		if ($image instanceof Image) {
			$illustration = clone $image;
			$em->persist($illustration);
			return $illustration;
		} else {
			return NULL;
		}
	}

	protected function assignImageIllustration ($_TDNDocument, $reuse = 0) {
		if ($reuse !== 0) {
			$_TDNDocument->setLnIllustration($this->reuseImageIllustration($reuse));
		} else {
			$this->processImageIllustration($_TDNDocument->getLnIllustration(), $usr);
		}
		return $_TDNDocument;
	}

	public function deleteRecord ($_TDNDocument) {

		// Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$titre = $_TDNDocument->getTitre();
		if ($_TDNDocument->getLnIllustration() instanceof Image) {
			$em->remove($_TDNDocument->getLnIllustration());
		}
		$_TDNDocument->resetRubriques();
		$_TDNDocument->resetTags();

		$em->remove($_TDNDocument);
		$em->flush();

		$this->get('session')->getFlashBag()->add('success', "Le document <strong>$titre</strong> a été supprimé.");
	}


	protected function processIllustration ($_TDNDocument, $dossierIllustration)
	{
	    $em = $this->get('doctrine.orm.entity_manager');      
		$imageProcessor = $this->get('tdn.image_processor');
		$usr= $this->get('security.context')->getToken()->getUser();				
		$image = $_TDNDocument->getLnIllustration();
		if ($image instanceof Image) {
			$titre = $image->getTitre();
			if (strlen($titre) === 0) {
				$image->setTitre('Sans titre');
			}
			$image->init($dossierIllustration, $usr, $usr);
			$em->persist($image);
			// Post-traitement de l'image
	        $fichierImage = $image->getFichier();
	        $source = '/'.$this->container->getParameter('media_root').$dossierIllustration.$fichierImage;
	        $err = $imageProcessor->square($source, 300, 'sqr_');
	        $err = $imageProcessor->downScale($source, 700, 'height');
		}	
	}

	protected function updateIllustration($_TDNDocument, $dossierIllustration)
	{
		$usr= $this->get('security.context')->getToken()->getUser();				
		$imageNana = $_TDNDocument->getLnIllustration();
		if ($imageNana instanceof Image && $imageNana->isUpdated()) {
			$legende = $imageNana->getTitre();
			if (empty($legende)) $imageNana->setTitre('Sans titre');
			$imageNana->init($dossierIllustration, $usr, $_TDNDocument->getLnAuteur());
			$em->persist($imageNana);
			return true;
		}
		return false;
	}

	protected function documentSelectionQuery ($rep, $constantes, $tri, $limite) {
	    $em = $this->get('doctrine.orm.entity_manager');      
 		$rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		$request = $this->get('request');

		if ($request->isMethod('POST')) {
			$valeur = $request->get('selectValeur');
			$champ = $request->get('selectField');
			if ($valeur !== '') {
				$this->_tplVars['isSelectedField'] = $request->get('selectField');
				$this->_tplVars['isSelectedValeur'] = $request->get('selectValeur');
				switch ($champ) {
				 	case 'lnAuteur':
				 		$nana = $rep_nanas->findOneByUsername($valeur);
				 		if ($nana instanceof Nana) {
				 			$constantes[$champ] =  $nana->getIdNana();
				 		}
				 		break;
				 	
				 	case 'lnExpert':
				 		$nana = $rep_nanas->findOneByUsername($valeur);
				 		if ($nana instanceof Nana) {
				 			$constantes[$champ] =  $nana->getIdNana();
				 		}
				 		break;
				 	
				 	case 'titre':
				 	default:
				 		$wildcards[$champ] =  $valeur;
				 		break;				 	
				}
				if (!empty($wildcards)) {
					$this->_tplVars['documentListe'] = $rep->findByWithWilcards($wildcards, $constantes, $tri, $limite);
				} else {
					$this->_tplVars['documentListe'] = $rep->findBy($constantes, $tri, $limite);
				}
			} else {
				$this->_tplVars['documentListe'] = $rep->findBy($constantes, $tri, $limite);
			}
		} else {
			$this->_tplVars['documentListe'] = $rep->findBy($constantes, $tri, $limite);
		}

		return true;
	}

	protected function createFormRubriques ($rubriques) {

		$themes = new ThematiqueCollection;
		foreach ($rubriques as $r) {
			$_theme = new Thematique;
			$_theme->setRubrique($r);
			$themes->addRubrique($_theme);
		}
		return $this->createForm(new ThematiqueCollectionType, $themes);
	}
}