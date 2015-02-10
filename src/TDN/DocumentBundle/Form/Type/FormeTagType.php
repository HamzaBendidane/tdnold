<?php

namespace TDN\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository as RubriqueRepository;

class FormeTagType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // Document Héritage
        $builder->add('forme', 'text', 
            array(
                'label' => 'Mot-clef',
            ));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DocumentBundle\Entity\Tag',
     	));
	}

    public function getName()
    {
        return 'tdn3_formeTag';
    }
}