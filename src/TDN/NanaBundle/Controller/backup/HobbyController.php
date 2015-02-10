<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\NanaBundle\Entity\Nana;
use TDN\NanaBundle\Entity\NanaRoles;
use TDN\NanaBundle\Entity\NanaPortraitImageProxy;
use TDN\NanaBundle\Form\Type\completeProfilType;
use TDN\ImageBundle\Form\Type\simpleImageType;
use TDN\ImageBundle\Entity\Image;
use TDN\NanaBundle\Form\Type\HobbyType;
use TDN\NanaBundle\Entity\NanaHobby;
use TDN\NanaBundle\Entity\NanaHobbyImageProxy;

class HobbyController extends Controller {

    public function addAction () {

        $request = $this->get('request');

        $variables = array();  
        $vars['rubrique'] = "tdn";

        // Extraction de l'utilisateur courant
        // $usr= $this->get('security.context')->getToken()->getUser();
        // ou même $this->getUser() ?

        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $whoami = $this->container->get('security.context')->getToken()->getUser();
        $hobby =  new NanaHobby();
        $form_hobby = $this->createForm(new HobbyType(), $hobby);

        $form_hobby->bind($request);
        if ($form_hobby->isValid()) {
            // Ajout de la référence à l'auteur du hobby
            $hobby->setLnOwner($whoami);
            // Traitement des images associées
            $images = $hobby->getGalerieHobby();
            $dossier = '/profils/'.$whoami->getIdNana().'/';
            if (!empty($images)) {
                foreach ($images as $proxy) {
                    $proxy->setLnHobby($hobby);
                    $i = $proxy->getLnImage();
                    $i->init($dossier, $whoami);
                    // print_r($i->getIdOwner()->getUsername()); die;
                    $em->persist($i);
                }
            }

            $points = $this->container->getParameter('action_points');
            $whoami->updatePopularite($points['completer_profil']);

            $em->persist($hobby);
            $em->flush();

            // Post-traitement des images

           $imageProcessor = $this->get('tdn.image_processor');
           foreach($hobby->getGalerieHobby() as $proxy) {
                $image = $proxy->getLnImage();
                $source = $this->container->getParameter('media_root').$dossier.$image->getFichier();
                $err = $imageProcessor->square($source, 300, 'sqr_');
                $err = $imageProcessor->downScale($source, 700, 'height');
            }

        }
        
        return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }

    public function showProfilAction ($id) {

        $variables = array();  
        $vars['rubrique'] = "tdn";

        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $vars['me'] = $rep_nana->find($id);
        // $vars['countHobbies'] = $vars['me']->getHobbies()->count();
        $vars['countGaleriePerso'] = $vars['me']->getGaleriePerso()->count();
        $vars['my_followers'] = $vars['me']->getFollows();
        $vars['countFollow'] = 0;
        $vars['countFollowed'] = 0;
        $vars['my_hobbies'] = $vars['me']->getLnHobbies();
        $vars['countHobbies'] = count($vars['my_hobbies']);

        $vars['productions'] = 0;
        foreach ($vars['me']->getFilProductions() as $p) {
            $classe = explode('\\', get_class($p));
            $nomClasse = array_pop($classe);
            $vars['my_'.strtolower($nomClasse)][] = $p;
            $vars['productions'] += 1;
             }

        $vars['likes'] = NULL;

        // récupération des commentaires
        // $rep_comms = $em->getRepository('TDN\CommentaireBundle\Entity\Commentaire');
        // $variables['commentaires'] = $rep_comms->findAllThreaded();
        // $variables['nbCommentaires'] = count($variables['commentaires']);
        // print_r($variables['commentaires']); die;
        // Rechercher l'article
        // $article = $repository->find($id);
        
        // set_include_path(get_include_path().PATH_SEPARATOR."/home/www/client");
        // echo get_include_path();
        // echo dirname(__FILE__); 
        // $p = file_get_contents("/justine75/v3_dev/src/TDN/RedactionBundle/Resources/views/Default/article.html.twig", FILE_USE_INCLUDE_PATH);

        return $this->render('NanaBundle:Public:completeProfil.html.twig', $vars);
    }

    public function updateProfilAction () {

        $request = $this->get('request');

        $variables['rubrique'] = 'tdn';

       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');
        $rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $usr= $this->get('security.context')->getToken()->getUser();
        $nana = $rep_nana->find($usr->getIdNana());
        $ancienPassword = $usr->getPassword();
    
        $form = $this->createForm(new completeProfilType(), $nana);
        $form->bind($request);

        if ($form->isValid()) {
            $p = $nana->getPassword();
            if (empty($p)) {
                $nana->setPassword($ancienPassword);
            } else {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($nana);
                $password = $encoder->encodePassword($nana->getPassword(), $nana->getSalt());
                $nana->setPassword($password);
            }
            $em->flush();
        }

        // print_r($form->getErrors()); die;

        return $this->redirect($this->generateURL('NanaBundle_myProfil'));
    }

    public function updateAvatarAction () {

        $request = $this->get('request');

        $variables['rubrique'] = 'tdn';

       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');
        $rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $usr= $this->get('security.context')->getToken()->getUser();
        $nana = $rep_nana->find($usr->getIdNana());
    
       // Formulaire pour changer d'avatar
        $avatar = new Image;
        $form_avatar = $this->createForm(new simpleImageType(), $avatar);
        $form_avatar->bind($request);

        if ($form_avatar->isValid()) {      
            // Création du nouvel avatar
            $avatar->storeUploadCustom('/profils/'.$usr->getIdNana());
            $avatar->setLikes(0);
            $avatar->setHits(0);
            $avatar->setSlug("");
            $avatar->setStatut("IMG_PUBLIC");
            $avatar->setVersion("1.0");
            $avatar->setAlt($avatar->getTitre());
            $avatar->setTags("");
            $avatar->setDatePublication(new \DateTime);
            $avatar->setDateModification($avatar->getDatePublication());
            $avatar->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());
            // Mise à jour du profil
            $nana->setLnAvatar($avatar);

            $em->flush();
        }

        // print_r($form->getErrors()); die;

        return $this->redirect($this->generateURL('NanaBundle_myProfil'));
    }

    public function updateGalerieAction () {

        $request = $this->get('request');

        $variables['rubrique'] = 'tdn';

       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');
        $rep_nana = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $usr= $this->get('security.context')->getToken()->getUser();
        $nana = $rep_nana->find($usr->getIdNana());
    
       // Formulaire pour changer d'avatar
        $photo = new Image;
        $form_galerie = $this->createForm(new simpleImageType(), $photo);
        $form_galerie->bind($request);

        if ($form_galerie->isValid()) {      
            // Création du nouvel avatar
            $photo->storeUploadCustom('/profils/'.$usr->getIdNana());
            $photo->setLikes(0);
            $photo->setHits(0);
            $photo->setSlug("");
            $photo->setStatut("IMG_PUBLIC");
            $photo->setVersion("1.0");
            $photo->setAlt($photo->getTitre());
            $photo->setTags("");
            $rep_type = $em->getRepository('TDN\DocumentBundle\Entity\DocumentType');
            $type = $rep_type->findOneBy(array('type' => 'image'));
            $photo->setTypeDocument($type);
            $photo->setDatePublication(new \DateTime);
            $photo->setDateModification($photo->getDatePublication());
            $photo->setCommentThread(new \Doctrine\Common\Collections\ArrayCollection());

            // Mise à jour du profil
            $proxy = new NanaPortraitImageProxy;
            $proxy->setLnImage($photo);
            $proxy->setLnPortrait($nana);
            $proxy->setIsAvatar(0);
            // $nana->addGaleriePerso($proxy);

            $em->persist($proxy);
            $em->flush();
        }

        // print_r($form->getErrors()); die;

        return $this->redirect($this->generateURL('NanaBundle_myProfil'));
    }

    public function modifierAction () {

        $request = $this->get('request');
        $whoami = $this->container->get('security.context')->getToken()->getUser();

        $variables = array();  
        $vars['rubrique'] = "tdn";

        $em = $this->get('doctrine.orm.entity_manager');      
        $rep_nana = $repository = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $rep_hobby = $repository = $em->getRepository('TDN\NanaBundle\Entity\NanaHobby');
        $idhobby  = $request->get('idHobby');
        $hobby =  $rep_hobby->find($idhobby);
        $form_hobby = $this->createForm(new HobbyType(), $hobby);

        $form_hobby->bind($request);
        if ($form_hobby->isValid()) {
             $em->flush();

            $points = $this->container->getParameter('action_points');
            $whoami->updatePopularite($points['completer_profil']);
    
            $this->get('session')->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
         }

        
        return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }

    public function supprimerImageAction ($id) {

        $request = $this->get('request');
        $usr= $this->get('security.context')->getToken()->getUser();

        $variables['rubrique'] = 'tdn';

       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\NanaBundle\Entity\NanaHobbyImageProxy');
        $proxy = $rep->find($id);
        $hobby = $proxy->getLnHobby();
        $image = $proxy->getLnImage();
        $fichier = $image->getFichier();

        $hobby->removeGalerieHobby($proxy);
        $em->remove($proxy);
        $em->remove($image);

        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'La photo <strong>'.$fichier.'</strong> a été supprimée');
        return $this->redirect($this->generateURL('NanaBundle_myProfil'));
    }

    public function ajouterImageAction () {
        
        $request = $this->get('request');
        $whoami= $this->get('security.context')->getToken()->getUser();

        $variables['rubrique'] = 'tdn';

       // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->get('doctrine.orm.entity_manager');
        $rep_hobby = $repository = $em->getRepository('TDN\NanaBundle\Entity\NanaHobby');
        $idhobby  = $request->get('idHobby');
        $hobby =  $rep_hobby->find($idhobby);
        $proxy = new NanaHobbyImageProxy;
        $imageHobby =  new Image;
        $form_image = $this->createForm(new SimpleImageType(), $imageHobby);
        $form_image->bind($request);
        if ($form_image->isValid()) {
            $proxy->setLnHobby($hobby);
            $proxy->setLnImage($imageHobby);
            $dossier = '/profils/'.$whoami->getIdNana().'/';
            $imageHobby->init($dossier, $whoami);
            $em->persist($proxy);
            $em->persist($imageHobby);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
        }

        return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }
}
