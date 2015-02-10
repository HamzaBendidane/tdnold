<?php

namespace TDN\CauseuseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\ImageBundle\Form\Type\simpleImageType;
use TDN\DocumentBundle\Entity\DocumentRubriqueRepository as RubriqueRepository;

class CauseuseSoumissionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

       $builder->add('question', 'textarea', 
            array(
                'label' => 'Quelle est ta question ?'
            ));
       $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Tu peux joindre une image à ta question (max. 2Mo)',
                'required' => false
            ));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\CauseuseBundle\Entity\Question',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'tdn3_causeuse_soumission';
    }
}