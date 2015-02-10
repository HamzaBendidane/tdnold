<?php

namespace TDN\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository as RubriqueRepository;
use TDN\DocumentBundle\Form\Model\Thematique;

class simpleRubriqueType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('rubriques', 'entity', array(
            'label' => "Choisis une rubrique pour ta question",
            'class' => 'TDN\DocumentBundle\Entity\DocumentRubrique',
            'property' => 'titre',
            'expanded' => false,
            'multiple' => false,
            'query_builder' => function(RubriqueRepository $er) {
                return $er->createQueryBuilder('u');
        }));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DocumentBundle\Entity\DocumentRubrique',
            // 'data_class' => NULL,
    	));
	}

    public function getName()
    {
        return 'tdn3_selecteur_rubriques';
    }
}