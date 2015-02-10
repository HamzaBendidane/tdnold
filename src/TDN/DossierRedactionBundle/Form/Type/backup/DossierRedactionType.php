<?php

namespace TDN\DossierRedactionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository as RubriqueRepository;

use TDN\DocumentBundle\Form\Type\DocumentType;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Type\ThematiqueType;

use Doctrine\ORM\EntityRepository;

use TDN\ImageBundle\Form\Type\simpleImageType;

class DossierRedactionType extends DocumentType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('statut', 'choice', 
            array('label' => 'Etat de publication', 
                  'choices' => array('DOSSIER_BROUILLON' => 'Brouillon', 'DOSSIER_PUBLIE' => 'Publié', 'DOSSIER_ARCHIVE' => 'Archivé'),
                  'expanded' => true,
                  'multiple' => false
            ));
        $builder->add('lnDossier', 'entity', array(
            'label' => "Est-ce une partie d'un dossier ?",
            'class' => 'TDN\DossierRedactionBundle\Entity\Dossier',
            'attr' => array('disabled' => 'disabled'),
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
	    	'data_class' => 'TDN\DossierRedactionBundle\Entity\Dossier',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'DossierRedaction_Detail';
    }
}