<?php

namespace TDN\RedactionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository as RubriqueRepository;

use Doctrine\ORM\EntityRepository;

use TDN\ImageBundle\Form\Type\simpleImageType;
use TDN\ProduitBundle\Form\Type\ProduitSelectionType as ProduitType;

class SelectionShoppingType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		// Document Héritage
        $builder->add('titre', 'text', 
            array('label' => 'Titre de la sélection'));
        $builder->add('slug', 'text', 
            array('label' => 'Chaîne d’URL',
                   'required' => false));
        $builder->add('abstract', 'textarea', 
            array('label' => 'Chapô de la sélection'));
        $builder->add('tags', 'text', 
            array('label' => 'Mots-clefs',
                  'attr' => array('size' => 75)
            ));
        $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Vignette liée au document',
                'required' => false
            ));
        $builder->add('statut', 'choice', 
        	array('label' => 'Etat de publication', 
        		  'choices' => array('SELECTION_BROUILLON' => 'Brouillon', 'SELECTION_PUBLIEE' => 'Publié'),
        		  'expanded' => true,
        		  'multiple' => false,
        		  'preferred_choices' => array('brouillon')
        	));
        $builder->add('version', 'text', 
            array('label' => 'Version',
                  'required' => false));

        // Produit
        $builder->add('setProduit', 'collection', 
            array('type' => new ProduitType(),
                  'allow_add' => true,
                  'allow_delete' => true,
                  'options' => array('label' => '', 'attr' => array('class' => 'fieldSetProduit'))
            ));

        $builder->add('lnDossier', 'entity', array(
            'label' => "Est-ce une partie d'un dossier ?",
            'class' => 'TDN\DossierRedactionBundle\Entity\Dossier',
            'required' => false,
            'property' => 'titre',
            'expanded' => false,
            'multiple' => false,
            'empty_value' => 'Non',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                          ->where("u.statut LIKE 'DOSSIER_%'");
        }));
        $builder->add('ordreDossier', 'integer', 
            array('label' => 'Ordre de classement dans le dossier',
                  'required' => false));
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