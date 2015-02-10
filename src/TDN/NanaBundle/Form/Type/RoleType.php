<?php

namespace TDN\NanaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider as CsrfProvider;

class RoleType extends AbstractType {
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('role', 'text', 
        	array(
        	));
        $builder->add('name', 'text', 
        	array(
        	));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TDN\NanaBundle\Entity\NanaRoles',
            'cascade' => true
        ));
    }

    public function getName()
    {
        return 'marylin_role_nana';
    }
}