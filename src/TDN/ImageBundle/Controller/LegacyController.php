<?php

namespace TDN\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TDN\ImageBundle\Entity\Image;

class LegacyController extends Controller {

	private $formats = array('', 'sqr_', 'x7_');
	private $root = '/home/www/client/justine75/v3/web/uploads/documents/public/%s/%s/%s';
	private $avatars = '/home/www/client/justine75/v3/web/uploads/documents/profils/%s/%s';

	public function fichierCorrectionNomAction () {

    	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        $tp = $this->get('tdn.core.textprocessor');

        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');
        $files = $rep_images->findSpecialNames();
        $em->clear();
        $log = fopen('logs/changeImagesfinenames.txt', 'a+');
        if (empty($files)) {

        } else {
        	foreach ($files as $_f) {
        		$_annee = $_f->getDatePublication()->format('Y');
        		$_mois = $_f->getDatePublication()->format('m');
        		$_canonique = $_f->getFichier();
        		$message = "";
    			preg_match('/([^\.]+)\.(png|jpeg|jpg|gif)/', $_f->getFichier(), $_canons);
    			if (!empty($_canons)) {
	    			$_newFilename = $tp->makeSlug($_canons[1]).".$_canons[2]";
	    			$done = false;
	        		foreach ($this->formats as $v) {
	        			$version = $v.$_canonique;
	        			$duplicate = $v.$_newFilename;
		        		$finder = sprintf($this->root, $_annee, $_mois, $version);
		        		$finderDuplicate = sprintf($this->root, $_annee, $_mois, $duplicate);
		        		if (is_file($finderDuplicate)) {
		        			$done = true;
		        			$message = "[".$_f->getIdDocument()."]".$_canonique.' en double\n';
		        		} else {
			        		if (!is_file($finder)) {
			        			print_r("-- [".$_f->getIdDocument()."]".$finder.'<br />');
			        		} else {
			        			if ($_newFilename !== false) {
				        			$newName = sprintf($this->root, $_annee, $_mois, $v.$_newFilename);
				        			$done = rename($finder, $newName);
				        			$message =  "[".$_f->getIdDocument()."]".$_canonique.' mis à jour > '.$_newFilename.'\n';
			        			} else {
				        			print_r("** ".$newName.'<br />');
			        			}
			        		}

		        		}
	        		}
        		} else {
        			print_r('Format non reconnu : '.$_f->getFichier()."<br />");
        		}
        		if ($done) {
        			fwrite($log, $message);
					$_f2 = $rep_images->find($_f->getIdDocument());
					$_f2->setFichier($_newFilename);        			
        		}
        	}
    		$em->flush();
        }

        fclose($log);
		die;
	}

	public function avatarCorrectionNomAction () {

    	set_time_limit(0);
        $em = $this->get('doctrine.orm.entity_manager');
        $tp = $this->get('tdn.core.textprocessor');

        $rep_images = $em->getRepository('TDN\ImageBundle\Entity\Image');
        $files = $rep_images->findSpecialNames();
        $em->clear();
        $log = fopen('logs/changeAvatarsFileNames.txt', 'a+');
        if (empty($files)) {

        } else {
        	foreach ($files as $_f) {
        		$_f = $rep_images->find($_f->getIdDocument());
        		$_auteur = $_f->getLnAuteur()->getIdNana();
        		$_canonique = $_f->getFichier();
        		$message = "";
    			preg_match('/([^\.]+)\.(png|jpeg|jpg|gif|PNG|JPG|GIF)/', $_f->getFichier(), $_canons);
    			if (!empty($_canons)) {
	    			$_newFilename = $tp->makeSlug($_canons[1]).".".strtolower($_canons[2]);
	    			$done = false;
	        		foreach ($this->formats as $v) {
	        			$version = $v.$_canonique;
		        		$finder = sprintf($this->avatars, $_auteur, $version);
	        			print_r($finder."<br />");
		        		if (!is_file($finder)) {
		        			print_r("-- [".$_f->getIdDocument()."]".$finder.'<br />');
		        		} else {
		        			if ($_newFilename !== false) {
			        			$newName = sprintf($this->avatars, $_auteur, $v.$_newFilename);
			        			$done = rename($finder, $newName);
			        			$message =  "[".$_f->getIdDocument()."]".$_canonique.' mis à jour > '.$_newFilename.'\n';
		        			} else {
			        			print_r("** ".$newName.'<br />');
		        			}
		        		}
	        		}
        		} else {
        			print_r('Format non reconnu : '.$_f->getFichier()."<br />");
        		}
        		if ($done) {
        			fwrite($log, $message);
					$_f->setFichier($_newFilename);        			
        		}
        	}
    		$em->flush();
        }

        fclose($log);
		die;
	}

}
