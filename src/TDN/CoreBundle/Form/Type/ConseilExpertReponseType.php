<?php

namespace TDN\ConseilExpertBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\NanaBundle\Form\Type\simpleExpertType;

class ConseilExpertReponseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		// Document Héritage        $builder->add('abstract', 'textarea');
         // Article
       $builder->add('reponse', 'textarea', 
            array(
                'label' => 'Donne un conseil à cette lectrice'
            ));
       $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Tu peux joindre une image à ta réponse',
                'required' => false
            ));
      }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConseilExpertBundle\Entity\ConseilExpert',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'tdn3_conseilexpert_reponse';
    }
}