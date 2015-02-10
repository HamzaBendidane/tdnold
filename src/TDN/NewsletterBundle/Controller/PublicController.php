<?php
namespace TDN\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Controller\DefaultMigrationController;
use TDN\DocumentBundle\Entity\DocumentRubrique;
use TDN\NewsletterBundle\Entity\AbonneNewsletter;
use TDN\NewsletterBundle\Form\Type\simpleInscriptionType;

use TDN\NanaBundle\Entity\Nana;
use TDN\NanaBundle\Form\Model\Inscription;
use TDN\NanaBundle\Form\Type\InscriptionType;
use TDN\NanaBundle\Type\letterRegisterType;

class PublicController extends Controller
{

	public function simpleInscriptionAction () {

		$request = $this->get('request');
	    $em = $this->get('doctrine.orm.entity_manager');      
	    $URLmanager = $this->get('tdn.document.url');

		$abonne = new AbonneNewsletter;

		// Instanciation du formulaire
		// $form = $this->createForm(new simpleInscriptionType, $abonne);
		// $variables['form'] = $form->createView();
		if ($request->getMethod() === 'POST') {
			$destinataire = $request->get('newsletter');
			// $form->bindRequest($request);
			if (true) {
				$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
				$nana = $rep_nana->findByEmail($destinataire);

				if (!empty($nana)) {
					$nana = array_pop($nana);
					$nana->setNewsletter(1);
					$this->get('session')->getFlashBag()->add('success', $nana->getUsername().', ta demande a été enregistrée');
				} else {
					$rep_nana = $em->getRepository('TDN\NewsletterBundle\Entity\AbonneNewsletter');
					$nana = $rep_nana->findByEmail($destinataire);
					if (!empty($nana)) {
						$this->get('session')->getFlashBag()->add('fail', 'Tu es déjà inscrit(e)');
					} else {
						$abonne->setEmail($destinataire);
						$abonne->setDateInscription(new \DateTime);
						$em->persist($abonne);
						$this->get('session')->getFlashBag()->add('success', 'Tu recevras désormais la lettre hebdomadaire de TDN');
					}
				}
				$em->flush();
			} else {
			}

			$vars['rubrique'] = 'tdn';
			$vars['message'] = '';
			$vars['referer'] = $request->headers->get('referer');
			$vars['follow'] = base64_encode($request->headers->get('referer'));
			$vars['email'] = $destinataire;
			$data = new Inscription();
			$who = new Nana();
			$who->setEmail($destinataire);
			$data->setUser($who);
	        $form = $this->createForm(new InscriptionType(), $data);
	        $vars['form'] = $form->createView();
			return $this->render('NanaBundle:Public:registerInPage.html.twig', $vars);
		}

		return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
	}

	public function desinscriptionAction ($clef = NULL) {

		$request = $this->get('request');

		// Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_abonne = $em->getRepository('TDN\NewsletterBundle\Entity\AbonneNewsletter');
		$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		if ($clef === 'none') {
			$typeAbonne = "#n";
			$email = "michel.cadennes@sens-commun.fr";
		} else {
			$clefDecodee = base64_decode($clef);
			list($typeAbonne,$email) = explode(',', $clefDecodee);
		}

		if ($typeAbonne === '#a') {
			$abonne = $rep_abonne->find($email);
			if ($abonne instanceof AbonneNewsletter) {
				$em->remove($abonne);
				$err = true;
			} else {
				$err= false;
			}
		} else {
			$nana = $rep_nana->findOneByEmail($email);
			if ($nana instanceof Nana) {
				$nana->setNewsletter(0);
				$err = true;
			} else {
				$err = false;
			}
		}
		
		$em->flush();
		
		$vars['email'] = $email;
		$vars['rubrique'] = 'tdn';
		return $this->render('NewsletterBundle:Public:notificationDesinscription.html.twig', $vars);
	}

}
