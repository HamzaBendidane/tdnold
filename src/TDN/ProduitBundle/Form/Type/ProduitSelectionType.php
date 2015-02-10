<?php

namespace TDN\ProduitBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository as RubriqueRepository;
use TDN\ImageBundle\Form\Type\simpleImageType;
use TDN\DocumentBundle\Form\Type\ThematiqueType;

class ProduitSelectionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		// Document Héritage
        $builder->add('titre', 'text', 
            array('label' => 'Nom du produit',
                  'attr' => array('class' => 'champProduit', 'size' => 60)));
        $builder->add('slug', 'text', 
            array('label' => 'Chaîne d’URL',
                  'attr' => array('class' => 'champSlug', 'size' => 60),
                  'required' => false));
        $builder->add('abstract', 'textarea', 
            array('label' => 'Description'));
        $builder->add('tags', 'text', 
            array('attr' => array('class' => 'champTags', 'size' => 60)
                ));
        $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Image',
                'required' => false
            ));

        // Sélection
        $builder->add('marque', 'text',
            array('label' => 'Fabricant'));
        $builder->add('url', 'text',
            array('label' => 'URL',
                  'attr' => array('class' => 'champURL', 'size' => 60)
                  ));
        $builder->add('favori', 'checkbox', 
            array('label' => 'Coup de cœur', 
                  'required' => false
            ));
        $builder->add('prix', 'integer',
            array('label' => 'Prix',
                'attr' => array('class' => 'champPrix', 'size' => 8)
                ));
        $builder->add('monnaie', 'choice', 
        	array('label' => '', 
        		  'choices' => array('EURO' => 'euros', 'DOLLAR' => 'dollars'),
        		  'expanded' => false,
        		  'multiple' => false,
        		  'preferred_choices' => array('EURO')
        	));
        $builder->add('Critique', 'textarea', 
            array('label' => 'L’avis de TDN'));

     }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\ProduitBundle\Entity\Produit',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'marylin_produit_add';
    }
}