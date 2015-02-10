<?php

namespace TDN\ConseilExpertBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\NanaBundle\Form\Type\simpleExpertType;
use Doctrine\ORM\EntityRepository as RubriqueRepository;
use TDN\NanaBundle\Entity\NanaRepository;

class ConseilExpertDispatchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		// Document Héritage        $builder->add('abstract', 'textarea');
         // Article
       $builder->add('question', 'textarea', 
            array(
                'label' => 'La question de la lectrice'
            ));
        $builder->add('lnExpert', 'entity', array(
            'class' => 'TDN\NanaBundle\Entity\Nana',
            'property' => 'username',
            'empty_value' => 'Choisissez un expert',
            'required' => false,
            'query_builder' => function(NanaRepository $er) {
                return $er->queryExperts();
            }));
         $builder->add('statut', 'hidden');
      }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConseilExpertBundle\Entity\ConseilExpert',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'tdn3_conseilexpert_dispatch';
    }
}