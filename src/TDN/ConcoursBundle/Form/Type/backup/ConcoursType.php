<?php

namespace TDN\ConcoursBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\ImageBundle\Form\Type\simpleImageType;
use Doctrine\ORM\EntityRepository as RubriqueRepository;
use TDN\DocumentBundle\Form\Type\ThematiqueType;

use Doctrine\ORM\EntityRepository;

class concoursType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);

        // Document Héritage
        $builder->add('titre', 'text', 
            array('label' => 'Titre de l’article'));
        $builder->add('slug', 'text', 
            array('label' => 'Chaîne d’URL',
                   'required' => false));
        $builder->add('abstract', 'textarea', 
            array('label' => 'Texte d’accompagnement'));
        $builder->add('tags', 'text', 
            array('label' => 'Mots-clefs',
                  'attr' => array('size' => 75)
            ));
        $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Vignette liée au document',
                'required' => false
            ));
        $builder->add('statut', 'choice', 
            array('label' => 'Etat de publication', 
                  'choices' => array('CONCOURS_BROUILLON' => 'Brouillon', 'CONCOURS_PUBLIE' => 'Publié'),
                  'expanded' => true,
                  'multiple' => false,
                  'preferred_choices' => array('brouillon')
            ));
        $builder->add('datePublication', 'date',
            array('label' => 'Date de publication',
                  'data' => new \DateTime,
                  'input' => 'datetime'
            ));
        $builder->add('version', 'text', 
            array('label' => 'Version',
                  'required' => false));

        // Définition du jeu-concours
        // $builder->add('typeJeuConcours', 'choice', 
        //     array(
        //         'label' => 'Type du jeu-concours',
        //         'choices' => array('ALEA' => 'Tirage au sort', 'QR' => 'Quesion/Réponse', 'QCM' => 'QCM')
        //         ));
        $builder->add('dateDebut', 'date',
            array('label' => 'Date de début du concours',
                  'data' => new \DateTime,
                  'input' => 'datetime'
            ));
        $builder->add('dateArret', 'date',
            array('label' => 'Date de fin du concours',
                  'widget' => 'choice',
                  'format' => 'dd-MM-yyyy',
                  'data' => new \DateTime,
                  'input' => 'datetime'
            ));
        $builder->add('sponsor', 'text',
            array(
                'label' => 'Nom du sponsor du jeu',
                'required' => false,
            ));
        $builder->add('sponsorURL', 'text',
            array(
                'label' => 'URL du sponsor',
                'required' => false,
                'attr' => array('size' => 75)
            ));
         $builder->add('nombreGagnants', 'integer',
            array(
                'label' => 'Nombre de gagnants',
            ));

        $builder->add('gain', 'text',
            array(
                'label' => 'Cadeau offert au(x) gagnant(s)',
                'required' => false,
            ));
        $builder->add('transmission', 'checkbox',
            array(
                'label' => 'Transmission des données au sponsor',
                'required' => false
            ));
       $builder->add('open', 'checkbox',
            array(
                'label' => 'Concours ouvert aux non-inscrits',
                'required' => false
            ));
       $builder->add('reponsesVisibles', 'checkbox',
            array(
                'label' => 'Réponses soumises au vote',
                'required' => false
            ));
        $builder->add('questions', 'collection',
            array(
                'label' => '',
                'type' => new ConcoursQuestionType,
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ));
        $builder->add('lnDossier', 'entity', array(
            'label' => "Est-ce une partie d'un dossier ?",
            'class' => 'TDN\DossierRedactionBundle\Entity\Dossier',
            'required' => false,
            'property' => 'titre',
            'expanded' => false,
            'multiple' => false,
            'empty_value' => 'Non',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                          ->where("u.statut LIKE 'DOSSIER_%'");
        }));
        $builder->add('ordreDossier', 'integer', 
            array('label' => 'Ordre de classement dans le dossier',
                  'required' => false));
        $builder->add('corps', 'textarea');
     }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConcoursBundle\Entity\Concours',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'concours_add';
    }
}