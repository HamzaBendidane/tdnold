<?php

namespace TDN\RedactionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use TDN\DocumentBundle\Form\Type\DocumentType;
use TDN\DocumentBundle\Form\Type\SlideType;
use TDN\DocumentBundle\Form\Type\ThematiqueType;

use Doctrine\ORM\EntityRepository;

use TDN\ImageBundle\Form\Type\simpleImageType;


class ArticleType extends DocumentType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

		// Document Héritage
        $builder->add('statut', 'choice', 
        	array('label' => 'Etat de publication', 
        		  'choices' => array('ARTICLE_BROUILLON' => 'Brouillon', 'ARTICLE_PUBLIE' => 'Publié', 'ARTICLE_FEUILLET' => 'Pièce de dossier'),
        		  'expanded' => true,
        		  'multiple' => false
        	));
        $builder->add('version', 'text', 
            array('label' => 'Version',
                  'required' => false));

        // Article
        $builder->add('corps', 'textarea');
        $builder->add('sponsor', 'checkbox', array('label' => "Article sponsorisé", 'required' => false));
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
	    	'data_class' => 'TDN\RedactionBundle\Entity\Article',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'article_add';
    }
}