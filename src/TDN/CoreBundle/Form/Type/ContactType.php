<?php

namespace TDN\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('requete', 'choice', array(
            'label' => 'C’est à quel propos ?',
            'choices' => array(
                'bug' => 'Signaler un bug',
                'question' => 'Poser une question',
                'suggestion' => 'Suggérer une idée pour améliorer TDN'),
            'empty_value' => 'Choisis une option'
            ));
        $builder->add('email', 'email', array(
            'label' => 'Ton e-mail',
            'max_length' => 80,
            'attr' => array('size' => 50),
            'trim' => true
            ));
        $builder->add('message', 'textarea', array(
            'label' => 'Ecris ton message',
            ));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\CoreBundle\Form\Model\Contact',
    	));
	}

    public function getName()
    {
        return 'tdn3_contact';
    }
}