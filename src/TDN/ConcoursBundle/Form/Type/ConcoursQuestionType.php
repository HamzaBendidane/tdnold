<?php

namespace TDN\ConcoursBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Form\Type\DocumentType;
use TDN\ConcoursBundle\Form\Type\ConcoursReponseType;

class ConcoursQuestionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('question', 'textarea',
            array(
                'label' => 'Quelle est la question ?',
                'attr' => array('style' => 'display:block; height:40px')
            ));
        $builder->add('filReponses', 'collection',
            array(
                'label' => '',
                'type' => new ConcoursReponseType,
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ));
        // $builder->add('exact', 'choice',
        //     array(
        //         'label' => 'Plusieurs réponses possibles ?',
        //         'choices' => array('1' => 'Oui', '0' => 'Non'),
        //         'expanded' => true,
        //         'multiple' => false
        //     ));
     }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConcoursBundle\Entity\ConcoursQuestion',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'marylin_concours_question';
    }
}