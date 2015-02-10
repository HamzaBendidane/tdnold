<?php

namespace TDN\ImageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Form\Type\DocumentType;

class VideoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('titre', 'text', array('label' => 'Titre de la vidéo'));
        $builder->add('slug', 'text');
        $builder->add('abstract', 'text');
        $builder->add('tags', 'text');
        $builder->add('statut', 'text');
        $builder->add('version', 'text');
        $builder->add('datePublication', 'date');
        $builder->add('dateModification', 'date');
     }

     public function buildMinForm (FormBuilderInterface $builder, array $options) {
         $builder->add('titre', 'text', array('label' => 'Titre de la vidéo'));
         $builder->add('fichier', 'file', array('label' => 'Téléchargez un image'));
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