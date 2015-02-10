<?php

namespace TDN\ConcoursBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConcoursReponseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('reponse', 'text',
            array(
                'label' => 'Réponse'
            ));
        $builder->add('exact', 'checkbox',
            array(
                'label' => 'Bonne réponse ?',
                'required' => false
            ));
     }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConcoursBundle\Entity\ConcoursReponse',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'marylin_concours_question';
    }
}