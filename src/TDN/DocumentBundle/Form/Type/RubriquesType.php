<?php

namespace TDN\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Form\Type\DocumentType;

class DocumentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		$builder->add('rubriques', 'choice');
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DocumentBundle\Entity\DocumentRubrique',
    	));
	}

    public function getName()
    {
        return 'liste_rubriques';
    }
}