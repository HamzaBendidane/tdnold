<?php

namespace TDN\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository as RubriqueRepository;
use TDN\DocumentBundle\Form\Model\IndexCollection;
use TDN\DocumentBundle\Form\Type\ExpressionTagType;

class IndexCollectionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('index', 'collection',
            array(
                'type' => new ExpressionTagType(),
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true
            ));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DocumentBundle\Form\Model\IndexCollection',
     	));
	}

    public function getName()
    {
        return 'tdn3_index';
    }
}