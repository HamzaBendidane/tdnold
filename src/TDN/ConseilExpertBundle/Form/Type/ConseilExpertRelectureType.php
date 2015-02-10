<?php

namespace TDN\ConseilExpertBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\ImageBundle\Form\Type\simpleImageType;

use Doctrine\ORM\EntityRepository;

class ConseilExpertRelectureType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // Document Héritage
        $builder->add('titre', 'text', 
            array(
                'label' => 'Titre du conseil'
            ));
        $builder->add('slug', 'text', 
            array(
                'label' => 'chaine pour l’URL',
                'required' => false
            ));
    $builder->add('abstract', 'textarea', 
            array('label' => 'Chapô de l’article'));
      $builder->add('question', 'textarea', 
            array(
                'label' => 'Question de la lectrice'
            ));
       $builder->add('reponse', 'textarea', 
            array(
                'label' => 'Réponse de l’expert'
            ));
        $builder->add('statut', 'choice', 
            array('label' => 'Etat de publication', 
                  'choices' => array('CONSEIL_REPONDU' => 'En attente', 'CONSEIL_PUBLIE' => 'Publié', 'CONSEIL_ECARTE' => 'Ecarté'),
                  'expanded' => true,
                  'multiple' => false,
                  'preferred_choices' => array('En attente')
            ));
        $builder->add('datePublication', 'date',
            array('label' => 'Date de publication',
                  'empty_value' => array('year' => date('Y'), 'month' => date('m'), 'day' => date('d')),
                  'input' => 'datetime'
            ));
        $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Tu peux joindre une image à ta question',
                'required' => false
            ));
        $builder->add('tags', 'text', 
            array('label' => 'Mots-clefs',
                  'attr' => array('size' => 75)
            ));
        $builder->add('version', 'integer', 
            array(
                'label' => 'Version',
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
      }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConseilExpertBundle\Entity\ConseilExpert',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'TDN3_ConseilExpert_Relecture';
    }
}