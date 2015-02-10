<?php

namespace TDN\DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository as RubriqueRepository;
use TDN\DocumentBundle\Entity\DocumentRubrique;

class modifyRubriqueType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $source = $options['data'];
        $builder->add('titre', 'text', array('label' => 'Nom de la rubrique'));
        $builder->add('slug', 'text', array('label' => 'Marqueur interne', 'required' => false));
        $builder->add('abstract', 'textarea', array('label' => 'Résumé pour les auteurs', 'required' => false));
        $builder->add('couleur', 'text', array('label' => 'Couleur associée'));
        $builder->add('sponsorLink', 'text', array('label' => 'Lien sponsor (fond de page)', 'required' => false));
        $builder->add('sponsorImage', 'text', array('label' => 'Image sponsor (fond de page', 'required' => false));
        $builder->add('parent', 'entity', array(
            'label' => 'Rubrique mère',
            'class' => 'TDN\DocumentBundle\Entity\DocumentRubrique',
            'property' => 'titre',
            'empty_value' => 'Aucune',
            'required' => false,
            // 'preferred_choices' => array($source),
            'query_builder' => function(RubriqueRepository $er) {
                return $er
                        ->createQueryBuilder('u')
                        ->where('u.parent = 0 AND u.statut = 1')
                        ->orderBy('u.titre', 'ASC');
        }));
        $builder->add('statut', 'choice', array(
            'label' => 'Statut de la rubrique',
            'expanded' => true,
            'multiple' => false,
            'choices' => array('1' => 'Activée', '0' => 'Désactivée')
            ));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DocumentBundle\Entity\DocumentRubrique',
    	));
	}

    public function getName()
    {
        return 'tdn3_modify_rubrique';
    }
}