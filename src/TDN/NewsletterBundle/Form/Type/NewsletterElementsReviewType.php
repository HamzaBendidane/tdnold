<?php

namespace TDN\NewsletterBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class NewsletterElementsReviewType extends NewsletterElementsType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder, $options);

         $builder->add('datePublication', 'date', 
            array(
                'label' => 'Date de Publication',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'longueurLimitee')
            ));
   }


    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'TDN\NewsletterBundle\Entity\Newsletter',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'tdn3_newsletter_preparation';
    }
}