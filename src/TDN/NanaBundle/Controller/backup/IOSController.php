<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\NanaBundle\Entity\Nana;
use TDN\NanaBundle\Form\Type\LoginType;
use TDN\NanaBundle\Form\Model\Inscription;
use TDN\NanaBundle\Form\Type\InscriptionType;
use TDN\NanaBundle\Form\Type\shortRegisterType;

class IOSController extends Controller {

    public function loginAction ()
    {
        $vars['rubrique'] = 'tdn';
        return $this->render('NanaBundle:Tests:iosLogin.html.twig', $vars);
    }

    public function connectAction($limite = 10) {

        $request = $this->getRequest();
        $em = $this->get('doctrine.orm.entity_manager');      
		$repNana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        $ack = 'NOACK';
        $identifiants = $request->request->get('tdn_login');
        $username = $identifiants['username'];
        $password = $identifiants['password'];
        $user = $repNana->findOneByUsername($username);
        if ($user instanceof Nana) {
		    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
		    $encodedPass = $encoder->encodePassword($password, $user->getSalt());
		    if ($user->getPassword() === $encodedPass) {
			    $ack = 'ACK';
		    } 
        } else {
            $ack = "NONE";
        }

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack, 'token' => $nana->getIdNana())));
		$reponse->headers->set('Content-Type', 'application/json');

		return $reponse;
    }

    public function registerCheckAction()   {
        
        $log = fopen('logs/ios-register.txt', 'w+');
        $request = $this->get('request');
        fwrite($log, serialize($_POST));
       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');
        $session = $this->container->get('session');
        $factory = $this->container->get('security.encoder_factory');
        $form = $this->createForm(new InscriptionType(), new Inscription);
        $form->bind($request);

        $registration = $form->getData();
// print_r($form->getData());
        $nana = $form->getData()->getUser();
        fwrite($log, $nana->getUsername().'\n');
        fwrite($log, $nana->getPassword().'\n');
        fwrite($log, $nana->getSexe().'\n');
        fwrite($log, $nana->getEmail().'\n');
// print_r($nana->getUsername());
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $doublon = $rep_nana->findDoubleRegistration($nana->getUsername(), $nana->getEmail());
        $profilComplet = 
            ($nana->getUsername() !== '') && 
            ($nana->getPassword() !== '') &&
            ($nana->getSexe() !== '') &&
            ($nana->getUsername() !== '') &&
            (filter_var($nana->getEmail(), FILTER_VALIDATE_EMAIL));

        if ($doublon) {
            $ack = 'ERRDOUBLE';
        } elseif (!$profilComplet) {
            $ack = 'ERRFORM';
        } else {
            $rep_roles = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles');
            $role = $rep_roles->find('ROLE_USER');
            $nana->addRole($role);
            $nakedPassword = $nana->getPassword();
            $nana->setSalt(uniqid());
            $encoder = $factory->getEncoder($nana);
            $pwd = $encoder->encodePassword($nakedPassword, $nana->getSalt());
            $nana->setPassword($pwd);
            $nana->setDateInscription(new \DateTime);
            $nana->setBlacklist(0);
            $nana->setActive(1);
            $nana->resetPopularite();
            // $em->persist($nana);
            // $em->flush();
            $ack = "ACK";
            $points = $this->container->getParameter('action_points');
            $level = $points['inscription'];
            $abonnee = $nana->getNewsletter();
            if($abonnee) {
                $level =+ $points['abonnee_newsletter'];
            }
            $abonnee = $nana->getOffresPartenaires();
            if($abonnee) {
                $level =+ $points['offres_partenaires'];
            }
            // $nana->updatePopularite($level);

            // Notifier la nouvelle Nana
            $admins = $this->container->getParameter('admin_notifications');
            $expediteurs = $this->container->getParameter('mail_expediteur');               
            $message = \Swift_Message::newInstance();
            $corps['expediteur'] = "Justine";
            $corps['role'] = "Rédaction";
            $corps['destinataire'] = $nana->getUsername();
            $corps['dateEnvoi'] = date(' d m Y - H:i:s');

            $message->setSubject('[TDN App] Inscription sur TDN')
                    ->setContentType('text/html')
                    ->setFrom($expediteurs['redaction'])
                    ->setTo($nana->getEmail())
                    ->setBody(
                        $this->renderView('NanaBundle:Mail:inscription.html.twig', $corps),
                        'text/html'
            );
            foreach($admins['redaction'] as $destinataire) {
                $message->addBcc($destinataire);
            }
            $this->get('mailer')->send($message);
        }

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
        $reponse->headers->set('Content-Type', 'application/json');

        return $reponse;
    }

    public function perteMotDePasseAction () {

        $request = $this->getRequest();
        $em = $this->get('doctrine.orm.entity_manager');      
        $repNana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        $ack = 'NOACK';
        $discriminant = $request->get('id');
        $resultat = $repNana->findDoubleRegistration($discriminant, $discriminant);
        if ($resultat instanceof Nana) {
            $ack = "ACK";
        }

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
        $reponse->headers->set('Content-Type', 'application/json');

        return $reponse;
    }

}
