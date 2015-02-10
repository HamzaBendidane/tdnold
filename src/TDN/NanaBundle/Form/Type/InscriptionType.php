<?php

namespace TDN\NanaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\DefaultCsrfProvider as CsrfProvider;

use TDN\NanaBundle\Form\Type\shortRegisterType;

class InscriptionType extends AbstractType {
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', new shortRegisterType());
        $builder->add('termsAccepted', 'checkbox', 
            array(
                'label' => 'J’accepte',
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'TDN\NanaBundle\Form\Model\Inscription',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'intention'       => 'register_check'
        ));
    }

    public function getName()
    {
        return 'tdn_nana_inscription';
    }
}