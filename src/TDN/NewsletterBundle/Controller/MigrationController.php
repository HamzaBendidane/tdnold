<?php

namespace TDN\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\DocumentBundle\Controller\DefaultMigrationController;
use TDN\NewsletterBundle\Entity\AbonneNewsletter as Abonne;

class MigrationController extends DefaultMigrationController
{
	protected $patternFichier = '/(\d+[-_])?([^\._]+)(_[grand]{2,})?(\.\w+)/';
	protected $old_images = '/home/www/client/justine75/v2_full/';
	protected $root = '/home/www/client/justine75/v3/uploads/documents/public/';

    public function migrationAction($fichier)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        // Recherche de rôle
        $rep_nanas = $em->getRepository('TDN\NanaBundle\Entity\Nana');


        $log = fopen('logMigration-'.date('Y-m-d-Hi').'.txt', 'w');
        $i = 1;
		if (($handle = fopen(dirname(__FILE__).'/'.$fichier.".csv", "r")) !== FALSE) {
			$keys = fgetcsv($handle, NULL, ",");
			$champs = array_flip($keys);
	    	while (($row = fgetcsv($handle, NULL, ",")) !== FALSE) {
   				$creationDateTime = '';
	    		$objet = new Abonne;
	    		$objet->setEmail($row[$champs['email']]);
	    		$objet->setDateInscription($row[$champs['date_ajout']]);	    		
	    		$objet->persist();
	    		$i += 1;
	        }
	    $em->flush();

	    fclose($handle);
	    fclose($log);
	    }
echo "<p>Adresses : $i</p>";
die;
        return $this->redirect($this->generateURL('RedactionBundle_articleIndex'));
    }

 }
