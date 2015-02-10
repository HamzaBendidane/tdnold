<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use TDN\NanaBundle\Entity\Nana;
use TDN\NanaBundle\Form\Type\LoginType;
use TDN\NanaBundle\Form\Model\Inscription;
use TDN\NanaBundle\Form\Type\InscriptionType;
use TDN\NanaBundle\Form\Type\shortRegisterType;

use TDN\ImageBundle\Form\Type\simpleImageType;
use TDN\ImageBundle\Entity\Image;

use TDN\NanaBundle\Entity\NanaRoles;
use TDN\NanaBundle\Entity\NanaPortraitImageProxy;
use TDN\NanaBundle\Form\Type\completeProfilType;

use TDN\CoreBundle\Entity\Journal;


class IOSController extends Controller {

    const DOMAINE = "http://www.trucsdenana.com";

    public function loginAction ()
    {
        $vars['rubrique'] = 'tdn';
        return $this->render('NanaBundle:Tests:iosLogin.html.twig', $vars);
    }

    public function connectAction() {

        $request = $this->getRequest();
        $em = $this->get('doctrine.orm.entity_manager');      
		$repNana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        $ack = 'NOACK';
        $identifiants = $request->request->get('tdn_login');
        $username = $identifiants['username'];
        $password = $identifiants['password'];
        // $username = 'superAdmin';
        // $password = 'kikujiro';
        $user = $repNana->findOneByUsername($username);
        if ($user instanceof Nana) {
		    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
		    $encodedPass = $encoder->encodePassword($password, $user->getSalt());
		    if ($user->getPassword() === $encodedPass) {
			    $ack = 'ACK';
                $reponse = new Response;
                $reponse->setContent(json_encode(array('reponse' => $ack, 'token' => $user->getIdNana())));
                $reponse->headers->set('Content-Type', 'application/json');
		    } else {
                $reponse = new Response;
                $reponse->setContent(json_encode(array('reponse' => $ack)));
                $reponse->headers->set('Content-Type', 'application/json');
            }
        } else {
            $ack = 'NONE';
            $reponse = new Response;
            $reponse->setContent(json_encode(array('reponse' => $ack)));
            $reponse->headers->set('Content-Type', 'application/json');
        }


		return $reponse;
    }

    public function testRegisterAction() {

        $variables['rubrique'] = 'tdn';
        $form = $this->createForm(new InscriptionType(), new Inscription());
        $variables['form'] = $form->createView();
        $variables['message'] = "";

        return $this->render('NanaBundle:Public:standaloneRegister.html.twig', $variables);
    }


    public function registerCheckAction()   {

        $log = fopen('logs/ios-register.txt', 'w+');
        $request = $this->get('request');
       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $newID = -1;
        $em = $this->get('doctrine.orm.entity_manager');
        $session = $this->container->get('session');
        $factory = $this->container->get('security.encoder_factory');
        // $form = $this->createForm(new InscriptionType(), new Inscription);
        // $form->bind($request);

        $form = $this->createForm(new InscriptionType(), new Inscription());
        $form->bind($request);
        $registration = $form->getData();
        $nana = $form->getData()->getUser();
        // $nana = new Nana();
        // $nana->setUserName('test-ios-user-3');
        // $nana->setPassword('12345');
        // $nana->setEmail('zzz-3@zzz.com');
        // $nana->setSexe(1);
        // $nana->setOffresPartenaires(0);
        fwrite($log, $nana->getUsername().'\n');
        fwrite($log, $nana->getPassword().'\n');
        fwrite($log, $nana->getSexe().'\n');
        fwrite($log, $nana->getEmail().'\n');
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $doublon = $rep_nana->findDoubleRegistration($nana->getUsername(), $nana->getEmail());
        $profilComplet = 
            ($nana->getUsername() !== '') && 
            ($nana->getPassword() !== '') &&
            ($nana->getSexe() !== '') &&
            ($nana->getUsername() !== '') &&
            (filter_var($nana->getEmail(), FILTER_VALIDATE_EMAIL));

        if ($doublon) {
            $data = array('ack' => 'ERRDOUBLE');
        } elseif (!$profilComplet) {
            $data = array('ack' => 'ERRFORM');
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
            $nana->setNewsletter($nana->getOffresPartenaires());
            $nana->resetPopularite();
            $em->persist($nana);
            $em->flush();

            $data = array('ack' => 'ACK');
            $data['token'] = $nana->getIdNana();

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
            $nana->updatePopularite($level);

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

        fclose($log);
        $reponse = new Response;
        $reponse->setContent(json_encode($data));
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

    public function updateProfilAction ($id) {

        $request = $this->get('request');

       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');
        $rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        if (!is_numeric($id)) {
            $ack = 'ERRNOID';
        } else {
            $nana = $rep_nana->find($id);
            if (!($nana instanceof Nana)) {
                $ack = 'NOPROFIL';
            } else {
                $ancienPassword = $nana->getPassword();
                $ancienUsername = $nana->getUsername();
                $ancienEmail = $nana->getEmail();
                // Le profil était-il déjà complet
                $ancienProfilComplet = $nana->isProfileComplete();
                $ancienNewsletter = $nana->getNewsletter();
                $ancienOffresPartenaires = $nana->getOffresPartenaires();
                
                $newParameters = $request->request->get('nana_complete_profil');
                $newUsername = $newParameters['username'];
                $newEmail = $newParameters['email'];

                if (!empty($newUsername) && ($ancienUsername != $newUsername)) {
                    $homonyme = $rep_nana->findOneByUsername($newUsername);
                    if ($homonyme instanceof Nana) {
                        if ($homonyme->getIdNana() == $nana->getIdNana()) {
                            unset($homonyme);
                        } else {
                            $ack = 'ERRDOUBLE';
                        }                    
                    } else {
                        unset($homonyme);
                    }
                }

                if (empty($newEmail)) {
                    $newParameters['email'] = $ancienEmail;
                    $ack = 'ERRNOMAIL';
                } elseif ($ancienEmail != $newEmail) {
                    $homomail = $rep_nana->findOneByEmail($newEmail);
                    if ($homomail instanceof Nana) {
                        if ($homomail->getIdNana() == $nana->getIdNana()) {
                            unset($homomail);
                        } else {
                            $ack = 'ERRDOUBLE';
                        }                    
                    } else {
                        unset($homomail);
                    }
                }

                if (!(isset($homomail) || isset($homonyme))) {
                    $form = $this->createForm(new completeProfilType(), $nana);
                    $form->bind($request);
                    if (true) {
                        $p = $nana->getPassword();
                        if (empty($p)) {
                            $nana->setPassword($ancienPassword);
                        } else {
                            $factory = $this->get('security.encoder_factory');
                            $encoder = $factory->getEncoder($nana);
                            $password = $encoder->encodePassword($nana->getPassword(), $nana->getSalt());
                            $nana->setPassword($password);
                        }

                        // Mise à jour des points pour les escarpins
                        $points = $this->container->getParameter('action_points');
                        $_points = 0;
                        if ($nana->isProfileComplete()) {
                            if (!$ancienProfilComplet) {
                                $_points += $points['completer_profil'];
                            }
                        } else {
                            if ($ancienProfilComplet) {
                                $_points -= $points['completer_profil'];
                            }
                        }
                        if ($nana->getNewsletter()) {
                            if (!$ancienNewsletter) {
                                $_points += $points['abonnee_newsletter'];
                            }
                        } else {
                            if ($ancienNewsletter) {
                                $_points -= $points['abonnee_newsletter'];
                            }
                        }
                        if ($nana->getOffresPartenaires()) {
                            if (!$ancienOffresPartenaires) {
                                $_points += $points['offres_partenaires'];
                            }
                        } else {
                            if ($ancienOffresPartenaires) {
                                $_points -= $points['offres_partenaires'];
                            }
                        }

                        // $nana->updatePopularite($_points);

                        // $em->flush();

                        $ack = "ACK";
                    } else {
                        $errs = "";
                        foreach ($form->getErrors() as $key => $error) {
                            $errs .= $error->getMessage().", ";
                        }
                        $ack = "NOACK";
                        
                    }            
                }
            }

        }

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack, 'token' => $id)));
        $reponse->headers->set('Content-Type', 'application/json');
        return $reponse;
    }

    public function passwordResetAction () {

        $request = $this->getRequest();
        $_formEmail = $request->query->get('email');

        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $nana = $rep_nana->findOneByEmail($_formEmail);

        if (!($nana instanceof Nana)) {
            $ack = 'NOPROFIL';
        } else {
            $ack = 'ACK';
            $resetURL = $this->generateURL('Nana_passwordResetS3').'?';
            $resetURL .= "me=".$nana->getIdNana();
            $clef = sha1($nana->getPrenom()."!".$nana->getSalt());
            $resetURL .= "&clef=".$clef;

            // Notifier la nouvelle Nana
            $corps['expediteur'] = "Administrateur";
            $corps['role'] = "Système";
            $corps['destinataire'] = $nana->getUsername();
            $corps['dateEnvoi'] = date(' d m Y - H:i:s');
            $corps['resetURL'] = $resetURL;
            $corps['pseudo'] = $nana->getUsername();

            $message = \Swift_Message::newInstance()
                ->setSubject('[TDN] Régénération de ton mot de passe via iPhone')
                ->setFrom('postmaster@trucdenana.com')
                // ->setTo('michel.cadennes@sens-commun.fr')
                ->setTo($nana->getEmail())
                ->setBody(
                    $this->renderView('NanaBundle:Mail:motDePasseOublie.html.twig', $corps),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
        $reponse->headers->set('Content-Type', 'application/json');
        return $reponse;
    }

    /**
    *
    * myProfilAction
    *
    * Envoie les informations de profil
    *
    * @param int $id — Identifiant de l'utilisateur
    * @return Response $response
    *
    **/
    public function myProfilAction ($id) {

        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $whoami = $rep_nana->find($id);

        if ($whoami instanceof Nana) {
            $ack['pseudo'] = $whoami->getUsername();
            $ack['prenom'] = $whoami->getPrenom();
            $ack['nom'] = $whoami->getNom();
            $ack['mail'] = $whoami->getEmail();
            $ack['naissance'] = $whoami->getDateNaissance();
            $ack['newsletter'] = $whoami->getNewsletter();
            $ack['offresPartenaires'] = $whoami->getOffresPartenaires();
            $ack['biographie'] = $whoami->getBiographie();
            $avatar = $whoami->getLnAvatar();
            if ($avatar instanceof Image) {
                $ack['avatar'] = self::DOMAINE."/uploads/documents/profils/".$whoami->getIdNana()."/sqr_".$avatar->getFichier();
            } else {
                $ack['avatar'] = NULL;
            }
        } else {
            $ack = "ERRID";
        }

        $reponse = new Response;
        $reponse->setContent(json_encode(array('reponse' => $ack)));
        $reponse->headers->set('Content-Type', 'application/json');
        return $reponse;
    }
}
