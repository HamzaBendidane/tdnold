<?php

namespace TDN\RedactionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

use TDN\RedactionBundle\Form\Type\SelectionShoppingType;

class SelectionShoppingReviewType extends SelectionShoppingType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);

		// Document Héritage
        $builder->add('datePublication', 'date',
            array('label' => 'Date de publication',
                  'format' => 'dd-MM-yyyy',
                  'input' => 'datetime'
            ));
     }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\RedactionBundle\Entity\SelectionShopping',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'marylin_shopping_add';
    }
}