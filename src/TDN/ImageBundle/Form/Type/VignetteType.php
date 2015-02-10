<?php

namespace TDN\ImageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VignetteType extends AbstractType {

     public function buildForm (FormBuilderInterface $builder, array $options) {
         $builder->add('titre', 'text', array('label' => 'Titre de la vidéo'));
         $builder->add('upload', 'file', array('label' => 'Téléchargez un image'));
         $builder->add('tags', 'text');

    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ImageBundle\Entity\Image',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'image';
    }
}