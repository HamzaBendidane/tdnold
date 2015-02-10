<?php

namespace TDN\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\ImageBundle\Form\Type\simpleImageType;

class SlideInspecteurType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		// Document Héritage
        $builder->add('pitch', 'text', 
            array(
                'label' => 'Pitch sur la page d’accueil',
                'required' => false
            ));
        $builder->add('ordre', 'integer', 
            array(
                'label' => 'Priorité',
                'required' => false,
                'data' => 1
            ));
        $builder->add('statut', 'choice', 
        	array('label' => 'Etat de publication', 
        		  'choices' => array('caché', 'mis en avant'),
        		  'expanded' => true,
        		  'multiple' => false,
                  'required' => false,
        		  'preferred_choices' => array('caché')
        	));
        $builder->add('lnCover', new simpleImageType(), 
            array(
                'label' => 'Choisis une image (format --- x --- px)',
                'required' => false
            ));
     }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DocumentBundle\Entity\Slider',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'document_slide';
    }
}