<?php

namespace TDN\NanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\NanaBundle\Form\Model\Inscription;
use TDN\NanaBundle\Form\Type\InscriptionType;
use TDN\NanaBundle\Form\Type\shortRegisterType;
use TDN\NanaBundle\Entity\NanaRoles;
use TDN\NanaBundle\Form\Type\RoleType;

class AdminRolesController extends Controller {

    public function rolesIndexAction () {

		$variables['Liste'] = array();
		$variables['colonnesList'] = array('Rôle', 'Nom', 'Nombre');
		$variables['actionsList'] = array('Supprimer');
		$variables['actionsRoutesList'] = array('NanaBundle_roleSupprimer');
		$em = $this->get('doctrine.orm.entity_manager');

		$variables['Liste'] = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles')->findAll();

		return $this->render('NanaBundle:Admin:RolesIndex.html.twig', $variables);

    }

    public function roleAddAction () {

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      

		$role = new NanaRoles;
		$request = $this->get('request');

		// Instanciation du formulaire
		$form = $this->createForm(new RoleType, $role);
		$variables['form'] = $form->createView();

		if ($request->getMethod() === 'POST') {
			$form->bindRequest($request);
			if ($form->isValid()) {
				$em->persist($role);
				$em->flush();
			}
			return $this->redirect(generateURL('NanaBundle_rolesIndex'));
		}

		$variables['titreDetail'] = "Nouveau rôle";
		$variables['formCallback'] = "NanaBundle_roleAdd";

		return $this->render('NanaBundle:Admin:RoleAdd.html.twig', $variables);
    }

    public function roleAccreditesAction ($role) {

		$variables['Liste'] = array();
		$variables['colonnesList'] = array('Rôle', 'Nom');
		$variables['actionsRoutes'] = 
			array('Supprimer' => array('NanaRole_supprimerCredit', "'role_id': role.role, 'nana_id': personne.idNana"));

		$em = $this->get('doctrine.orm.entity_manager');
		$variables['role'] = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles')->find($role);

		return $this->render('NanaBundle:Admin:RolesAccredites.html.twig', $variables);
    }

    public function ajouterCreditAction ($id) {

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
        $URLmanager = $this->get('tdn.document.url');

		$nana = new Nana;
		$request = $this->get('request');

		if ($request->getMethod() === 'POST') {
			$role_id = $request->get('role');
			$role = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles')->find($role_id);
			$nana_id = $request->get('pseudo');
			$nana = $em->getRepository('TDN\NanaBundle\Entity\Nana')->find($nana_id);

			if (!empty($nana)) {
				$nana->addRole($role);
				$em->flush();
			}
		}

        return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }

   public function supprimerCreditAction ($role_id, $nana_id) {

	    // Récupération de l'entity manager qui va nous permettre de gérer les entités.
	    $em = $this->get('doctrine.orm.entity_manager');      
        $URLmanager = $this->get('tdn.document.url');

		$nana = new Nana;
		$request = $this->get('request');

		if ($request->getMethod() === 'GET') {
			$role = $em->getRepository('TDN\NanaBundle\Entity\NanaRoles')->find($role_id);
			$nana = $em->getRepository('TDN\NanaBundle\Entity\Nana')->find($nana_id);

			if (!empty($nana)) {
				$nana->removeRole($role);
				$em->flush();
			}
		}

        return $this->redirect($URLmanager->refererURL($request->headers->get('referer')));
    }

}