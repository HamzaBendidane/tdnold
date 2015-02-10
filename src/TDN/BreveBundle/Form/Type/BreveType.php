<?php

namespace TDN\BreveBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Entity\DocumentRubriqueRepository;

class BreveType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('message', 'textarea', array('label' => 'Poste ton info'));
        $builder->add('url', 'text', 
            array('label' => 'un lien ?',
                  'required' => false,
                  'attr' => array('size' => '20',
                                  'placeholder' => 'http://')));
        $builder->add('lnRubrique', 'entity', array(
            'label' => 'Rubrique',
            'class' => 'TDN\DocumentBundle\Entity\DocumentRubrique',
            'property' => 'titre',
            'empty_value' => 'Choisis une rubrique',
            'query_builder' => function(DocumentRubriqueRepository $er) {
                return $er
                        ->createQueryBuilder('u')
                        ->where('u.parent IS NULL AND u.statut = 1')
                        ->orderBy('u.titre', 'ASC');
        }));
     }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\BreveBundle\Entity\Breve',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'tdn3_breve';
    }
}