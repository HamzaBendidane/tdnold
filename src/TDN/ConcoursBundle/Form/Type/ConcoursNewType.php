<?php

namespace TDN\ConcoursBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\ImageBundle\Form\Type\simpleImageType;
use Doctrine\ORM\EntityRepository as RubriqueRepository;
use TDN\DocumentBundle\Form\Type\ThematiqueType;
use TDN\ConcoursBundle\Form\Type\ConcoursType;

use Doctrine\ORM\EntityRepository;

class ConcoursNewType extends ConcoursType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);

        // Document Héritage
        $builder->add('datePublication', 'date',
            array('label' => 'Date de publication',
                  'data' => new \DateTime,
                  'format' => 'dd-MM-yyyy',
                  'input' => 'datetime'
            ));
        $builder->add('dateDebut', 'date',
            array('label' => 'Date de début du concours',
                  'data' => new \DateTime,
                  'format' => 'dd-MM-yyyy',
                  'input' => 'datetime'
            ));
        $builder->add('dateArret', 'date',
            array('label' => 'Date de fin du concours',
                  'widget' => 'choice',
                  'format' => 'dd-MM-yyyy',
                  'data' => new \DateTime,
                  'input' => 'datetime'
            ));
     }

	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ConcoursBundle\Entity\Concours',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'concours_add';
    }
}