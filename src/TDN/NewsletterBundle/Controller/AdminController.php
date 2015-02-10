<?php
namespace TDN\NewsletterBundle\Controller;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\NewsletterBundle\Entity\Newsletter;
use TDN\NewsletterBundle\Entity\AbonneNewsletter;
use TDN\NewsletterBundle\Form\Type\NewsletterElementsNewType;
use TDN\NewsletterBundle\Form\Type\NewsletterElementsReviewType;
use TDN\NewsletterBundle\Form\Type\NewsletterElementsType;

use TDN\RedactionBundle\Entity\Article;
use TDN\RedactionBundle\Entity\SelectionShopping;
use TDN\ConseilExpertBundle\Entity\ConseilExpert;
use TDN\VideoBundle\Entity\Video;
use TDN\CauseuseBundle\Entity\Question;
use TDN\ConcoursBundle\Entity\Concours;

class AdminController extends Controller
{
	private $etat = array ('LETTRE_PREPARATION', 'LETTRE_ENATTENTE', 'LETTRE_ENVOYEE');
	private $lot = 250;
	private $mailPattern = "/^([a-zA-Z0-9_\-]+\.)*[a-zA-Z0-9_\-]+@([a-zA-Z0-9_\-]+\.)+[a-zA-Z]{2,4}$/";
	protected $_tplVars = array(
		'selectList' => array(
			),
		'colonnesList' => array('Titre', 'Statut (cliquer pour l’aperçu)', 'Date d’envoi')
		);

	private function genZodiaque ($when = NULL) {

		if (is_null($when)) $when = new \DateTime;
		$jour = (integer)$when->format('d');
		$mois = (integer)$when->format('m');
		print_r($jour.'-'.$mois);
		switch ($mois) {
			case 1:
				return ($jour < 20) ? "Capricorne" : "Verseau" ;
			case 2:
				return ($jour < 19) ? "Verseau" : "Poissons" ;
			case 3:
				return ($jour < 21) ? "Poissons" : "Bélier" ;
			case 4:
				return ($jour < 20) ? "Bélier" : "Taureau" ;
			case 5:
				return ($jour < 21) ? "Taureau" : "Gémeaux" ;
			case 6:
				return ($jour < 22) ? "Gémeaux" : "Cancer" ;
			case 7:
				return ($jour < 23) ? "Cancer" : "Lion" ;
			case 8:
				return ($jour < 24) ? "Lion" : "Vierge" ;
			case 9:
				return ($jour < 23) ? "Vierge" : "Balance" ;
			case 10:
				return ($jour < 24) ? "Balance" : "Scorpion" ;
			case 11:
				return ($jour < 23) ? "Scorpion" : "Sagittaire" ; 
			case 12:
			default:
				return ($jour < 20) ? "Sagittaire" : "Capricorne" ;
		}

	}

	public function indexAction ()
	{
		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\NewsletterBundle\Entity\Newsletter');

		$this->_tplVars['titrePage'] = "Index des lettres d’info";
		$this->_tplVars['referer'] = "Newsletter_index";
		// $routes = array_keys($action);
		$this->_tplVars['actionsList'] = array(
			'Programmer' => array(
				'action' => 'Programmer',
				'controleur' => 'Newsletter_programmer',
				'class' => '',
				'role' => 'ROLE_ADMIN'
				),
			'Envoyer' => array(
				'action' => 'Envoyer',
				'controleur' => 'Newsletter_envoyer',
				'class' => '',
				'role' => 'ROLE_ADMIN'
				)
			);
		$this->_tplVars['documentListe'] = $rep->findAll();
		
		return $this->render('NewsletterBundle:Admin:newsletterContentIndex.html.twig', $this->_tplVars);
	}

	public function preparationAction () {

		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
		$usr= $this->get('security.context')->getToken()->getUser();
		$variables = array();

		$newsletter = new Newsletter;
		$formNews = $this->createForm(new NewsletterElementsNewType, $newsletter);

		if ($request->getMethod() === 'POST') {
			$formNews->bindRequest($request);
			if ($formNews->isValid()) {
				$newsletter->setLnAuteur($usr);
				if ($newsletter->getLnArticleSponsor() == '') {
					$newsletter->setLnArticleSponsor(NULL);
				}
				$newsletter->setStatut('LETTRE_PREPARATION');
				$newsletter->setEnvoyes(0);
				// $newsletter->setEnvoyes("{'sent' : 0, 'nanas' : 0, 'anonymes' : 0}");
				$em->persist($newsletter);
				$em->flush();
				$this->get('session')->getFlashBag()->add('success', 'La lettre d’info est prête.');
				return $this->redirect($this->generateURL('Newsletter_index'));
			} else {
				$this->get('session')->getFlashBag()->add('fail', 'Il y a une erreur dans le formulaire.');

			}
		}

		$variables['controleur'] = 'preparation';
		$variables['form'] = $formNews->createView();

		return $this->render('NewsletterBundle:Admin:newsletterPreparation.html.twig', $variables);
	}

	public function reviserAction ($id) {

		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\NewsletterBundle\Entity\Newsletter');
		$usr= $this->get('security.context')->getToken()->getUser();
		$variables = array();

		$newsletter = $rep->find($id);
		$formNews = $this->createForm(new NewsletterElementsReviewType, $newsletter);

		if ($request->getMethod() === 'POST') {
			$formNews->bindRequest($request);
			if ($formNews->isValid()) {
				if ($newsletter->getLnArticleSponsor() == '') {
					$newsletter->setLnArticleSponsor(NULL);
				}
				$newsletter->setStatut('LETTRE_PREPARATION');
				$em->flush();
				$this->get('session')->getFlashBag()->add('success', 'La lettre d’info a été mise à jour.');
				return $this->redirect($this->generateURL('Newsletter_index'));
			} else {
				$this->get('session')->getFlashBag()->add('fail', 'Il y a une erreur dans le formulaire.');

			}
		}

		$variables['controleur'] = 'reviser';
		$variables['parametres'] = array('id' => $id);
		$variables['form'] = $formNews->createView();

		return $this->render('NewsletterBundle:Admin:newsletterPreparation.html.twig', $variables);
	}

	public function programmerAction ($id)
	{
		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\NewsletterBundle\Entity\Newsletter');

		$newsletter = $rep->find($id);
		$newsletter->setStatut('LETTRE_ENATTENTE');
		$em->flush();
		$this->get('session')->getFlashBag()->add('success', 'L’envoi de la lettre d’info est programmée.');
		return $this->redirect($this->generateURL('Newsletter_index'));
	}

	public function previewAction ($id)
	{
		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\NewsletterBundle\Entity\Newsletter');
		$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		// $id = $request->query->get('id');
		if (is_null($id)) { $occurrence = $rep->searchReady(); } else { $occurrence = $rep->find($id); }
		$vars['lettre'] = $occurrence;
		$vars['dateEnvoi'] = date(' d m Y - H:i:s');
		$vars['id'] = $id;
		$vars['ju'] = $rep_nana->find(3);
		$mustRead = $vars['lettre']->getLnLire();
		if ($mustRead instanceof Article) $vars['pathDocumentLire'] = 'RedactionBundle_article';
		elseif ($mustRead instanceof SelectionShopping) $vars['pathDocumentLire'] = 'Redaction_showSelection';
		elseif ($mustRead instanceof ConseilExpert) $vars['pathDocumentLire'] = 'ConseilExpert_conseil';
		elseif ($mustRead instanceof Video) $vars['pathDocumentLire'] = 'VideoBundle_video';
		elseif ($mustRead instanceof Question) $vars['pathDocumentLire'] = 'CauseuseBundle_conversation';
		elseif ($mustRead instanceof Concours) $vars['pathDocumentLire'] = 'Concours_show';
		$vars['signeZodiaque'] = $this->genZodiaque();
		$astroFunc = 'getAstroLove'.str_replace('é', 'e', $vars['signeZodiaque']);
		$vars['astroLove'] = $vars['lettre']->$astroFunc();
		$vars['clefDesinscription'] = '';

		// $a = $rep_nana->find(3);
		// $message = $this->buildNewsletterNana($a, $vars, $occurrence->getTitre());
		// $this->get('mailer')->send($message);

		return $this->render('NewsletterBundle:Mail:modeleLettre.html.twig', $vars);
	}

	public function envoyerAction () 
	{
		set_time_limit(0);
		$mailPattern = "/^([a-zA-Z0-9_\-]+\.)*[a-zA-Z0-9_\-]+@([a-zA-Z0-9_\-]+\.)+[a-zA-Z]{2,4}$/";
		$request = $this->get('request');
		$em = $this->get('doctrine.orm.entity_manager');
		$rep = $em->getRepository('TDN\NewsletterBundle\Entity\Newsletter');
		$rep_abonnes = $em->getRepository('TDN\NewsletterBundle\Entity\AbonneNewsletter');
		$rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		$id = $request->query->get('id');
		if (is_null($id)) { $occurrence = $rep->searchReady(); } else { $occurrence = $rep->find($id); }
		if (!($occurrence instanceof Newsletter)) {
			$this->get('session')->getFlashBag()->add('fail', 'Aucune lettre prête à l’envoi n’a été trouvée');
			$sent = 0;
		} else {
			$id = $occurrence->getId();
			$log = fopen('logs/newsletter/envois_'.$id.'.txt', 'a+');
			echo $occurrence->getTitre(); 
			$paramsEnvoi = $occurrence->getEnvoyes();
			if ($paramsEnvoi == "0") {
				$paramsEnvoi = json_decode('{"sent":0, "nanas":0, "anonymes":0}');
			} else {
				$paramsEnvoi = json_decode($paramsEnvoi);
			}

			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			$corps['lettre'] = $occurrence;
			$corps['id'] = $id;
			$mustRead = $corps['lettre']->getLnLire();
			if ($mustRead instanceof Article) $corps['pathDocumentLire'] = 'RedactionBundle_article';
			elseif ($mustRead instanceof ConseilExpert) $corps['pathDocumentLire'] = 'ConseilExpert_conseil';
			elseif ($mustRead instanceof SelectionShopping) $corps['pathDocumentLire'] = 'Redaction_showSelection';
			elseif ($mustRead instanceof Video) $corps['pathDocumentLire'] = 'VideoBundle_video';
			elseif ($mustRead instanceof Question) $corps['pathDocumentLire'] = 'CauseuseBundle_conversation';
			elseif ($mustRead instanceof Concours) $corps['pathDocumentLire'] = 'Concours_show';
			$corps['signeZodiaque'] = '---';
			$corps['astroLove'] = "Si tu veux recevoir ton astro love de la semaine, crée un profil sur Trucsdenana.com et indique ta date de naissance";
			$corps['ju'] = $rep_nana->find(3);

			$sent = $paramsEnvoi->sent;
			if ('done' == (string)$paramsEnvoi->nanas) {
				print_r("Anonymes ".$paramsEnvoi->nanas." << ");
				if ('done' == (string)$paramsEnvoi->anonymes) {
					$occurrence->setStatut('LETTRE_ENVOYEE');
				} else {
					$nanas = $rep_abonnes->findAnonymesNewsletter($paramsEnvoi->anonymes, $this->lot);
					if (empty($nanas)) {
						$paramsEnvoi->anonymes = 'done';
					} else {
						foreach ($nanas as $a) {
							$err = $this->sendLettre($a, $corps, $occurrence->getTitre());
							$sent = $err ? $sent + 1 : $sent;
							if ($err) {
						    	print_r($a->getEmail().' '.date('H:i:s').'<br />');				
						    	fwrite($log, $a->getEmail().' '.date('H:i:s').'\n');				
							} else {
						    	print_r($a->getEmail().' '.date('H:i:s').' - Erreur<br />');
								fwrite($log, '*** Erreur sur '.$a->getEmail().'\n');
							}
						}
						$paramsEnvoi->anonymes += $this->lot;				
					}
				}
			} else {
				$debut = $paramsEnvoi->nanas == 0 ? 0 :1 + (integer)$paramsEnvoi->nanas;
				print_r(">> $debut");
				$nanas = $rep_nana->findNanaNewsletter($debut, $this->lot);
				if (empty($nanas)) {
					$paramsEnvoi->nanas = 'done';
				} else {
					foreach ($nanas as $a) {
						$currentID = $a->getIdNana();
						$validAdresse = preg_match($mailPattern, $a->getEmail(), $matches);
						if ($validAdresse === 1) {
							$message = $this->buildNewsletterNana($a, $corps, $occurrence->getTitre());
						    if ($this->get('mailer')->send($message)) {
						    	$sent +=1;
						    }
					    	print_r(" - $sent - ".$a->getIdNana().' '.$a->getEmail().' '.date('H:i:s').'<br/>');				
					    	fwrite($log, $a->getEmail().' '.date('H:i:s').'\n');				
						} else {
							fwrite($log, '*** Erreur sur '.$a->getEmail().'\n');
						}
					}
					$paramsEnvoi->nanas = $currentID;				
				}

			}
			$paramsEnvoi->sent = $sent;
			print_r($paramsEnvoi);
			$occurrence->setEnvoyes(json_encode($paramsEnvoi));
			$em->flush();
			fclose($log);
		}		

		return new Response("<div>$sent</div>");		
	}

	public function onKernelException(GetResponseForExceptionEvent $event) {
		$exception = $event->getException();
   		print_r($exception);
	}

	public function buildNewsletterAnonyme ($nana, $corps, $titre) {
		$message = \Swift_Message::newInstance();
		$message->setSubject(' Les news de TDN : '.$titre)
				->setContentType('text/html')
    			->setFrom(array('news@trucdenana.com' => 'La rédaction de TDN'));

		$corps['signeZodiaque'] = '---';
		$corps['astroLove'] = "Si tu veux recevoir ton astro love de la semaine, indique ta date de naissance dans ton profil";
		$corps['clefDesinscription'] = base64_encode("#a,".$nana->getEmail());
		$headers = $message->getHeaders();
		$unsubscribe = array('<mailto:aide@trucdenana.com>');
		$unsubscribe[] = '<http://www.trucsdenana.com'.$this->generateURL('Newsletter_desinscription', array('clef'=> $corps['clefDesinscription'])).'>';
		$headers->addTextHeader('List-Unsubscribe',implode(',', $unsubscribe));
		$message->addTo($nana->getEmail())
    			->setBody($this->renderView('NewsletterBundle:Mail:modeleLettre.html.twig', $corps), 'text/html');

    	return $message;
	}

	public function buildNewsletterNana ($nana, $corps, $titre) {
		$message = \Swift_Message::newInstance();
		$message->setSubject(' Les news de TDN : '.$titre)
				->setContentType('text/html')
    			->setFrom(array('news@trucdenana.com' => 'La rédaction de TDN'));

		$zodiaque = $nana->getDateNaissance();
		if ($zodiaque instanceof \DateTime) {
			$an = (integer)$zodiaque->format('Y');
			$corps['signeZodiaque'] = $this->genZodiaque($zodiaque);
			$astroFunc = 'getAstroLove'.str_replace('é', 'e', $corps['signeZodiaque']);
			$corps['astroLove'] = $corps['lettre']->$astroFunc();
		} else {
			$an = 0;
			$corps['signeZodiaque'] = '---';
			$corps['astroLove'] = "Si tu veux recevoir ton astro love de la semaine, indique ta date de naissance dans ton profil";
		}
		$corps['clefDesinscription'] = base64_encode("#n,".$nana->getEmail());
		$headers = $message->getHeaders();
		$unsubscribe = array('<mailto:aide@trucdenana.com>');
		$unsubscribe[] = '<http://www.trucsdenana.com'.$this->generateURL('Newsletter_desinscription', array('clef'=> $corps['clefDesinscription'])).'>';
		$headers->addTextHeader('List-Unsubscribe',implode(',', $unsubscribe));
		$message->addTo($nana->getEmail())
    			->setBody($this->renderView('NewsletterBundle:Mail:modeleLettre.html.twig', $corps), 'text/html');

    	return $message;
	}

	public function sendLettre ($nana, $corps, $titre) 
	{
		$validAdresse = preg_match($this->mailPattern, $nana->getEmail(), $matches);
    	$sent = false;		

		if ($validAdresse === 1) {
			$prefixe = ($nana instanceof Nana) ? "#n" : "#a";
			$corps['clefDesinscription'] = base64_encode($prefixe.$nana->getEmail());
			$message = $this->buildNewsletterAnonyme($nana, $corps, $titre);
		    if ($this->get('mailer')->send($message)) {
		    	$sent = true;
		    }
		}

		return $sent;
	}
}