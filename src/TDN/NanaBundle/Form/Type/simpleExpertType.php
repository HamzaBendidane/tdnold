<?php

namespace TDN\NanaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository as RubriqueRepository;

class simpleExpertType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('expert', 'entity', array(
            'class' => 'TDN\NanaBundle\Entity\Nana',
            'property' => 'username',
            'empty_value' => 'Choisissez un expert',
            'query_builder' => function(RubriqueRepository $er) {
                return $er->createQueryBuilder('u');
        }));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\NanaBundle\Entity\Nana',
            // 'data_class' => NULL,
    	));
	}

    public function getName()
    {
        return 'tdn3_selecteur_rubriques';
    }
}