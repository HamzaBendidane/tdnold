<?php

namespace TDN\NanaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		$builder->add('nom', 'text');
		$builder->add('prenom', 'text');
        $builder->add('email', 'email');
        $builder->add('pseudo', 'text');
        $builder->add('passwd', 'repeated', array(
           'first_name' => 'password',
           'second_name' => 'confirm',
           'type' => 'password'
        ));
        $builder->add('dateNaissance', 'birthday');
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\NanaBundle\Entity\Nana',
    	));
	}

    public function getName()
    {
        return 'inscription_nana';
    }
}