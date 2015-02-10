<?php

namespace TDN\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultMigrationController extends Controller
{
    protected $rubV3 = array('', 5, 6, 1, 2, 4, 7, 8, 3, 0);
    protected $ssrubV3 = array('', 37, 26, 10, 26, 16, 18, 15, 15, 28, 22, 20, 17, 19, 17, 35, 36, 33, 34, 27, 29, 28, 28, 32, 31, 11, 30, 10, 21, 9, 9, 9, 23, 22, 23, 9, 12);
 
    public function indexAction($name)
    {
        return $this->render('DocumentBundle:Default:index.html.twig', array('name' => $name));
    }

   public function importAction () {

    	$request = $this->get('request');

    	if ($request->getMethod() == 'POST') {
    		$source = $request->get('fichierImport');
    		if (!empty($source)) {
    			$this->migrationAction($source);
    		} else {

    		}
    	} else {

    	}

        return $this->redirect($this->generateURL('BreveBundle_breveLog'));
    }

    public function migrateCategories (&$objet) {
        $_ssActuelles = array();
        if ((integer)$row[$champs['id_souscategorie1']] !== 0) {
            if (!is_object($this->ssrubV3[$row[$champs['id_souscategorie1']]])) {
                $this->ssrubV3[$row[$champs['id_souscategorie1']]] = $rep_rubriques->find($this->ssrubV3[$row[$champs['id_souscategorie1']]]);
            }
            if (is_object($this->ssrubV3[$row[$champs['id_souscategorie1']]])) {
                $objet->addRubrique($this->ssrubV3[$row[$champs['id_souscategorie1']]]);
            }
            $_ssActuelles[] = $this->ssrubV3[$row[$champs['id_souscategorie1']]]->getIdRubrique();
         }
        if ((integer)$row[$champs['id_souscategorie2']] !== 0) {
            $_ssActuelles[] = $row[$champs['id_souscategorie2']];
            if (!is_object($this->ssrubV3[$row[$champs['id_souscategorie2']]])) {
                $this->ssrubV3[$row[$champs['id_souscategorie2']]] = $rep_rubriques->find($this->ssrubV3[$row[$champs['id_souscategorie2']]]);
            }
            if (is_object($this->ssrubV3[$row[$champs['id_souscategorie2']]])) {
                $id = $this->ssrubV3[$row[$champs['id_souscategorie2']]]->getIdRubrique();
                 if (!in_array($id, $_ssActuelles)) {
                    $objet->addRubrique($this->ssrubV3[$row[$champs['id_souscategorie2']]]);
                 }
                 $_ssActuelles[] = $id;
            }
        }
        if ((integer)$row[$champs['id_souscategorie3']] !== 0) {
            $_ssActuelles[] = $row[$champs['id_souscategorie3']];
            if (!is_object($this->ssrubV3[$row[$champs['id_souscategorie3']]])) {
                $this->ssrubV3[$row[$champs['id_souscategorie3']]] = $rep_rubriques->find($this->ssrubV3[$row[$champs['id_souscategorie3']]]);
            }
            if (is_object($this->ssrubV3[$row[$champs['id_souscategorie3']]])) {
                $id = $this->ssrubV3[$row[$champs['id_souscategorie3']]]->getIdRubrique();
                 if (!in_array($id, $_ssActuelles)) {
                    $objet->addRubrique($this->ssrubV3[$row[$champs['id_souscategorie3']]]);
                }
                $_ssActuelles[] = $id;
            }
        }
        if (((integer)$row[$champs['id_categorie']] !== 0) && empty($_ssActuelles)) {
            if (!is_object($this->rubV3[$row[$champs['id_categorie']]])) {
                $this->rubV3[$row[$champs['id_categorie']]] = $rep_rubriques->find($this->rubV3[$row[$champs['id_categorie']]]);
            }
            if (is_object($this->rubV3[$row[$champs['id_categorie']]])) {
                $objet->addRubrique($this->rubV3[$row[$champs['id_categorie']]]);
            }
        }

        return count($objet->getRubriques());
    }

    public function indexBuildAction () {

        $em = $this->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('TDN\DocumentBundle\Entity\Tag');
        $semTagger = $this->get('tdn.tag.manager');

        $documents = $rep->findNotIndexed();
        foreach($documents as $_TDNDocument) {
            print_r($_TDNDocument->getIdDocument(). ' '.$_TDNDocument->getTags());
            $tags = $semTagger->tagsBuilder($_TDNDocument);
            print_r("<br/>");
        }

        $em->flush();

        die;
    }
}
