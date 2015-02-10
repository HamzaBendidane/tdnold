<?php

namespace TDN\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

use TDN\ImageBundle\Form\Type\simpleImageType;

class DocumentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // Document Héritage
        $builder->add('titre', 'text', 
            array('label' => 'Titre'));
        $builder->add('slug', 'text', 
            array('label' => 'Chaîne d’URL',
                   'required' => false));
        $builder->add('abstract', 'textarea', 
            array('label' => 'Chapô'));
        // $builder->add('tags', 'text', 
        //     array('label' => 'Mots-clefs',
        //           'required' => false,
        //           'attr' => array('size' => 75)
        //     ));
        $builder->add('lnIllustration', new simpleImageType(), 
            array(
                'label' => 'Illustration liée au document',
                'required' => false
            ));
        // Date de publication du document --> Voir formulaire fils
        // Statut du document dans le workflow --> Voir formulaire fils
        // Version --> Champ supprimé
        $builder->add('lnPromu', new SlideType(), 
            array(
                'label' => 'Promotion en page d’accueil',
                'required' => false
            ));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DocumentBundle\Entity\Document',
    	));
	}

    public function getName()
    {
        return 'document';
    }
}