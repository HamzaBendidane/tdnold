<?php

namespace TDN\ConcoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

use TDN\ConcoursBundle\Entity\Concours;
use TDN\NanaBundle\Entity\Nana;

class CronController extends Controller
{
    public function tiragesAction()
    {
	    $variables['rubrique'] = 'tdn';

	    $em = $this->get('doctrine.orm.entity_manager');      
		$repository = $em->getRepository('TDN\ConcoursBundle\Entity\Concours');
		$concours = $repository->findTiragesAEffectuer();

		if (!empty($concours)) {
			// Notification nana
			$message = \Swift_Message::newInstance();
			$corps['expediteur'] = "Justine";
			$corps['role'] = "Redaction";
			$corps['destinataire'] = "Justine";
			$corps['dateEnvoi'] = date(' d m Y - H:i:s');
			// Eléments spécifiques
			$corps['concours'] = $concours;

			$message->setSubject('[TDN] Tirages au sort prêts à être effectués')
					->setContentType('text/html')
	    			->setFrom('redaction@trucdenana.com')
					->addTo($this->container->getParameter('mail_moderation_1'))
					->addTo($this->container->getParameter('mail_moderation_2'))
	     			->setBody(
	        			$this->renderView('ConcoursBundle:Mail:notificationTiragesAuSort.html.twig', $corps),
	        			'text/html'
	        		);

		    if (!$this->get('mailer')->send($message, $failures)) {
			  echo "Failures:";
			  print_r($failures);
			}			
		}

		return new Response('<div>Notification de tirage au sort envoyée</div>');
    }

}
