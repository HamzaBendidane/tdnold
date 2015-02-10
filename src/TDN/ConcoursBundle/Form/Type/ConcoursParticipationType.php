<?php

namespace TDN\ConcoursBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Form\Type\DocumentType;

class ConcoursParticipationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('mailParticipant', 'email',
            array(
                'label' => 'Indique ton e-mail pour jouer :',
                'required' => false,
            ));
        $builder->add('reponse', 'textarea',
            array(
                'label' => 'Ta réponse',
                'required' => false,
                'attr' => array('class' => 'reponse-concours')
            ));
     }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConcoursBundle\Entity\ConcoursParticipant',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'marylin_concours_participation';
    }
}