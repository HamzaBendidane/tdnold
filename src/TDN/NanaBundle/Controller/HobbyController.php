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
        $URLmanager = $this->get('tdn.document.url');

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

    public function modifierAction () {

        $request = $this->get('request');
        $whoami = $this->container->get('security.context')->getToken()->getUser();

        $variables = array();  
        $vars['rubrique'] = "tdn";

        $em = $this->get('doctrine.orm.entity_manager');      
        $URLmanager = $this->get('tdn.document.url');

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
        $URLmanager = $this->get('tdn.document.url');

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

            // Post-traitement de l'image
            $imageProcessor = $this->get('tdn.image_processor');
            $fichierImage = $imageHobby->getFichier();
            $source = $this->container->getParameter('media_root').$dossier.$fichierImage;
            $err = $imageProcessor->square($source, 300, 'sqr_');
            $err = $imageProcessor->downScale($source, 700, 'height');

            $this->get('session')->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
        }

        return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }
}
