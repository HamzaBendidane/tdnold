<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
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


class WSController extends Controller {

    const DOMAINE = "http://www.trucsdenana.com";


    public function addProfilAction()   {
        $request = $this->get('request');

        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $newID = -1;

        $em = $this->get('doctrine.orm.entity_manager');
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        $session = $this->container->get('session');
        $factory = $this->container->get('security.encoder_factory');

        $nana = new Nana();

        if (

            filter_var($request->get('password'), FILTER_VALIDATE_EMAIL) || !$request->get('password')
            ||
            !$request->get('username') || !$request->get('birthdate')

        ){
            $data = array('ack' => 'ERRFORM');

        }else{

            $nana->setEmail($request->get('email'));
            $nana->setUsername($request->get('username'));
            $nana->setDateNaissance(new \DateTime(date ("Y-m-d H:i:s",strtotime($request->get('birthdate')))));
            $nana->setSexe($request->get('sex'));
            $nana->setOffresPartenaires($request->get('partenairs'));
            $nana->setDateInscription(new \DateTime);
            $nana->setBlacklist(0);
            $nana->setActive(1);
            $nana->setNewsletter($nana->getOffresPartenaires());
            $nana->resetPopularite();

            //Password Management

            $rep_roles = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles');
            $role = $rep_roles->find('ROLE_USER');
            $nana->addRole($role);
            $nakedPassword = base64_decode($request->get('password'));
            $nana->setSalt(uniqid());
            $encoder = $factory->getEncoder($nana);
            $pwd = $encoder->encodePassword($nakedPassword, $nana->getSalt());
            $nana->setPassword($pwd);

            ///////////////////////////////////////////

            $doublon = $rep_nana->findDoubleRegistration($nana->getUsername(), $nana->getEmail());


            if ($doublon) {

                $data = array('ack' => 'ERRDOUBLE');

            }
            else {

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
            }

        }
        return new JsonResponse($data);
    }


    public function connectAction() {

        $request = $this->getRequest();
        $em = $this->get('doctrine.orm.entity_manager');      
		$repNana = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        $ack = 'NOACK';
        $username = $request->get('username');
        $password = $request->get('password');


        $user = $repNana->findOneByUsername($username);


        if ($user instanceof Nana) {

		    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
		    $encodedPass = $encoder->encodePassword($password, $user->getSalt());

            if ($user->getPassword() == $encodedPass) {

                $ack = 'ACK';
                $data = array('reponse' => $ack, 'token' => $user->getIdNana());

            } else {

                $data = array('reponse' => $ack);

            }
        } else {

            $ack = 'NONE';
            $data = array('reponse' => $ack);

        }

        return new JsonResponse($data);
    }

    public function updateProfilAction ($id) {

        $request = $this->get('request');
        $avatar = $request->get('avatar');


        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $newID = -1;

        $em = $this->get('doctrine.orm.entity_manager');
        $imageProcessor = $this->get('tdn.image_processor');
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');

        if (

            !filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)

        ){
            $ack = 'ERRFORM';

        }else{

                $nana = $rep_nana->find($id);

                if (!$nana) {
                    $ack =  'NOPROFIL';
                }
                else{

                    $doublon = $rep_nana->findStrictOneByEmail($request->get('email'));
                    if ($doublon && ($request->get('email') != $nana->getEmail())){
                        $ack = 'ERRDOUBLE';
                    }else {


                        $dossier = dirname(__FILE__).'/../../../../web/uploads/documents/profils/'.$nana->getIdNana().'/';

                        $this->base64_to_jpeg($avatar,$dossier.'sqr_avatar.jpg');


                        $avatar = new Image;
                        $avatar->init($dossier, $nana);
                        $avatar->setFichier('avatar.jpg');


                        $nana->setLnAvatar($avatar);

                        $em->flush();


                        $nana->setEmail($request->get('email'));
                        $nana->setNom($request->get('name'));
                        $nana->setPrenom($request->get('surname'));
                        $nana->setSexe($request->get('sex'));
                        $nana->setVille($request->get('city'));
                        $nana->setNewsletter($request->get('newsletter'));
                        $nana->setBiographie($request->get('bio'));
                        $nana->setAvatarId(12345);


                        $avatar = $nana->getLnAvatar()->getFichier();
                        $source = $this->container->getParameter('media_root').$dossier.$avatar;
                        $err = $imageProcessor->square($source, 300, 'sqr_');
                        $err = $imageProcessor->downScale($source, 700, 'height');


                        try {
                            $em->flush();
                            $ack = "ACK";
                        } catch (Exception $e) {
                            $ack = 'ERRDOUBLE';

                        }
                    }
                }

        }
        return new JsonResponse(array('reponse' => $ack , 'token' => $id));
    }
    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb");

        fwrite($ifp, base64_decode($base64_string));

        fclose($ifp);

        return $output_file;
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
            $ack['username'] = $whoami->getUsername();
            $ack['surname'] = $whoami->getPrenom();
            $ack['name'] = $whoami->getNom();
            $ack['email'] = $whoami->getEmail();
            $ack['birthdate'] = $whoami->getDateNaissance() ? $whoami->getDateNaissance()->format("Y-m-d") : "";
            $ack['newsletter'] = $whoami->getNewsletter();
            $ack['partenairs'] = $whoami->getOffresPartenaires();
            $ack['bio'] = $whoami->getBiographie();
            $ack['city'] = $whoami->getVille();

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
                ->setTo($nana->getEmail())
                ->setBody(
                    $this->renderView('NanaBundle:Mail:motDePasseOublie.html.twig', $corps),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }

        return new JsonResponse(array('reponse' => $ack));
    }
}