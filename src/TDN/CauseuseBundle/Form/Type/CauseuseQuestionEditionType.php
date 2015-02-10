<?php

namespace TDN\CauseuseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\ImageBundle\Form\Type\simpleImageType;
use Doctrine\ORM\EntityRepository as RubriqueRepository;

use Doctrine\ORM\EntityRepository;

class CauseuseQuestionEditionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		// Document Héritage
        $builder->add('titre', 'text', 
            array('label' => 'Titre de l’article'));
        $builder->add('slug', 'text', 
            array('label' => 'Chaîne d’URL',
                   'required' => false));
        $builder->add('abstract', 'textarea');
        $builder->add('tags', 'text',
            array('label' => 'Mots-clefs',
                  'attr' => array('size' => 75)
            ));
        $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Image liée à la question',
                'required' => false
            ));
        $builder->add('statut', 'choice', 
        	array('label' => 'Etat de publication', 
        		  'choices' => 
                    array('QUESTION_POSEE' => 'Brouillon', 
                          'QUESTION_PUBLIEE' => 'publiée', 
                          'QUESTION_REFUSEE' => 'refusée'),
        		  'expanded' => true,
        		  'multiple' => false,
        		  'preferred_choices' => array('brouillon')
        	));
        $builder->add('version', 'text', 
            array('label' => 'Version',
                  'required' => false));
        $builder->add('datePublication', 'date',
            array('label' => 'Date de publication',
                  'empty_value' => array('year' => date('Y'), 'month' => date('m'), 'day' => date('d')),
                  'input' => 'datetime'
            ));
        // Causeuse
        $builder->add('question', 'textarea');
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
     }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\CauseuseBundle\Entity\Question',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'causeuse_question_edit';
    }
}