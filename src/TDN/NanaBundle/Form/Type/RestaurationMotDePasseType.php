<?php

namespace TDN\NanaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class restaurationMotDePasseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('username', 'text',
            array(
                'label' => 'Pseudo'
            ));
        $builder->add('password', 'repeated',
            array(
                'type' => 'password',
                'invalid_message' => 'Les mots de passe doivent correspondre',
                'options' => array('required' => true),
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Répète le mot de passe (Validation)')
        ));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\NanaBundle\Entity\Nana',
    	));
	}

    public function getName()
    {
        return 'marylin_restorePassword';
    }
}