<?php

namespace TDN\CommentaireBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Cache\MemcacheCache as Memcache;

use TDN\CommentaireBundle\Entity\Commentaire;
use TDN\CommentaireBundle\Form\Type\simpleCommentaireType;
use TDN\CoreBundle\Entity\Journal;
use TDN\NanaBundle\Entity\Nana;

class IOSController extends Controller {

    /**
    *
    * commenterAction
    *
    * Commenter un document
    *
    * @param int $id — identifiant du document à commenter
    * @return Response $reponse;
    *
    **/
	    public function commenterAction ($id) {

		$request = $this->get('request');
            $tdn3_commentaire_simple['texteCommentaire'] = $request->get('texteCommentaire', NULL);
            $tdn3_commentaire_simple['abonne'] = $request->get('abonne', NULL);

	    $em = $this->get('doctrine.orm.entity_manager');      
		$rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');
		$rep_comms = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
	    $URLmanager = $this->get('tdn.document.url');

		$comment = new Commentaire;

		// Instanciation du formulaire
		$form = $this->createForm(new simpleCommentaireType, $comment);
		if (true || $request->getMethod() === 'POST') {
			$form->bindRequest($request);
			$idNana = $request->request->get('userID', NULL);
			if (!is_null($idNana)) {
				$usr = $rep_nanas->find();
				// Instanciation de l'auteur du commentaire
				if ($usr instanceof Nana) {
					$comment->setIdAuteur($usr->getIdNana());
					$comment->setFilAuteur($usr);
				} else {
					$comment->setIdAuteur(NULL);
				}
			} else {
				$comment->setIdAuteur(NULL);
			}
			// Instanciation du document commenté
			$rep = $em->getRepository('TDN\DocumentBundle\Entity\Document');
			// $doc = $rep->find($request->get('idDocument'));
			$doc = $rep->find($id);
			list($route, $rubrique, $params) = $doc->getURLElements();
			$sourceURL = $this->generateURL($route, $params);

			$comment->setFilDocument($doc);
			// Ôter les tags HTML du message
			$tagger = $this->get('tdn.core.urlshortener');
			$nakedComment = strip_tags($comment->getTexteCommentaire());
			$comment->setTexteCommentaire($tagger->urlTagger($nakedComment));

			// Instanciation de la date du commentaire
			$comment->setDatePublication(new \DateTime);
			// Le commentaire est-il une réponse
			$isReponse = $comment->getIdThread();
			if ($isReponse == 0) {
				$comment->setIdThread(uniqid());
				$comment->setIdReponse(0);
			} else {
				$comment->setIdReponse(1);
			}
			$comment->setLike(0);

			$_quarantaine = false;
			$_isspam = false;
			// $_antispam = $_POST['antispam'];
			$_antispam = "2";
			$simpleScanner= $this->get('tdn.core.antispam');
			$spamTraces = $simpleScanner->scan($comment->getTexteCommentaire(), $request->getClientIp(), $_antispam);

			if (false && $spamTraces['statut'] === 'SPAM') {
				$comment->setStatut(0);
				$ack = 'NOACK';
				// $em->persist($comment);
				// $em->flush();
			} else {
				if ($spamTraces['statut'] === 'VALIDE') {
					// Signaler dans le journal & informer l'auteur
					$entree = new Journal;
					if (is_object($usr)) $entree->setLnActeur($usr);
					$entree->setAction('COMMENTAIRE');
					$entree->setURL($sourceURL);
					$entree->setTexte('a ajouté un commentaire à');
					$entree->setTitre($doc->getTitre());
					$entree->setLnVeilleur($doc->getLnAuteur());
					$entree->setSupport('');
					$entree->setLnRubrique($rubrique);
					$entree->setDateEntree($comment->getDatePublication());
					$em->persist($entree);
					$ack = 'ACK';

					if ($usr instanceof Nana) {
			        	$points = $this->container->getParameter('action_points');
			        	$usr->updatePopularite($points['commentaire']);
			        }

			        $followers = $rep_comms->findBy(array('filDocument' => $doc->getIdDocument(), 'abonne' => 1));
					foreach($followers as $_f) {
						if (!is_null($_f->getFilAuteur())) {
							$adresseAbonne = $_f->getFilAuteur()->getEmail();
							$pseudoAbonne = $_f->getFilAuteur()->getUsername();
					// 		// Notification
							$message = \Swift_Message::newInstance();
							$corps['expediteur'] = "Justine";
							$corps['role'] = "Rédaction";
							$corps['destinataire'] = $pseudoAbonne;
							$corps['dateEnvoi'] = date(' d m Y - H:i:s');
							// Spécifiques
							$corps['titre'] = $doc->getTitre();
							$corps['url'] = $sourceURL;
							$corps['commentaire'] = $comment->getTexteCommentaire();
							$corps['idCommentaire'] = $comment->getIdCommentaire();

							$message->setSubject('[TDN] Nouveau commentaire sur une page que tu suis')
									->setContentType('text/html')
				        			->setFrom('redaction@trucdenana.com')
				        			->addTo($adresseAbonne)
				        			->setBody(
				            			$this->renderView('CommentaireBundle:Mail:followersCommentaire.html.twig', $corps),
				            			'text/html'
				            		);
						    $this->get('mailer')->send($message);							
						}
					}
				}

				$comment->setStatut(($spamTraces['statut'] == 'SUSPECT') ? 0 : 1);
				// $em->persist($comment);
				// $em->flush();

				// Notification
				$admins = $this->container->getParameter('admin_notifications');
				$expediteurs = $this->container->getParameter('mail_expediteur');				
				$message = \Swift_Message::newInstance();
				$corps['expediteur'] = "Administrateur";
				$corps['role'] = "Système";
				$corps['destinataire'] = "modérateur";
				$corps['dateEnvoi'] = date(' d m Y - H:i:s');
				// Spécifiques
				$corps['titre'] = $doc->getTitre();
				$corps['url'] = $sourceURL;
				$corps['commentaire'] = $comment->getTexteCommentaire();
				$corps['idCommentaire'] = $comment->getIdCommentaire();
				$corps['isSuspect'] = (0 == $comment->getStatut());
				if (isset($spamTraces['fails'])) {
					$corps['isSpam'] = "<ul>";
					foreach ($spamTraces['fails'] as $critere => $motif) {
						if ($motif != '') {
							$corps['isSpam'] .= "<li><strong>$critere</strong> : $motif</li>";
						}
					}
					$corps['isSpam'] .= "</ul>";					
				} else {
					$corps['isSpam'] = "";
				}
				$corps['IP'] = $request->getClientIp().' : '.$spamTraces['fails']['geoIP'];

				$message->setSubject('[TDN] Commentaire '.strtolower($spamTraces['statut']).' sur une page')
						->setContentType('text/html')
	        			->setFrom($expediteurs['admin'])
	        			->setBody(
	            			$this->renderView('CommentaireBundle:Mail:nouveauCommentaire.html.twig', $corps),
	            			'text/html'
	            		);
				foreach($admins['redaction'] as $destinataire) {
					$message->addTo($destinataire);
				}
			    $this->get('mailer')->send($message);

			    if ($spamTraces['statut'] == 'SUSPECT') {
					$ack = 'STBYACK';
			    } else {
					$ack = 'ACK';
			    }
			}
		} else {
			$ack = 'ERRMETHOD';
		}
	
        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
		$reponse->headers->set('Content-Type', 'application/json');

		return $reponse;
    }

    /**
    *
    * voterAction
    *
    * voter pour un commentaire
    *
    * @param int $idCommentaire — identifiant du commentaire
    * @return Response $reponse;
    *
    **/
    public function voterAction ($idCommentaire) {

	    $em = $this->get('doctrine.orm.entity_manager');      
		$request = $this->get('request');
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');

		if ($request->getMethod() === 'GET') {
			// Instanciation du document commenté
			$rep = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
			$comment = $rep->find($idCommentaire);
			if ($comment instanceof Commentaire) {
				$comment->setLike(1 + $comment->getLike());
				$em->persist($comment);
				$em->flush();
				$ack = 'ACK';
			} else {
				$ack = 'NOACK';
			}
		} else $ack = 'NOGET';

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
		$reponse->headers->set('Content-Type', 'application/json');

		return $reponse;
	}
}

