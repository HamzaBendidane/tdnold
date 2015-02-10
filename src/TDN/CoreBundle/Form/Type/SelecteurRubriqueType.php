<?php

namespace TDN\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		$builder->add('rubrique', 'entity' array(
                'class' => 'TDNCoreBundle:Rubrique',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')->orderBy('u.username', 'ASC');
                    }
                )
        );
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