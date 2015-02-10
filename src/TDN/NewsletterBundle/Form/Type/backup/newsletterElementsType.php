<?php

namespace TDN\NewsletterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class newsletterElementsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = new \DateTime;
        $moinsSeptJours = new \DateInterval('P7D');

        $builder->add('titre', 'text', 
            array(
                'label' => 'Titre',
                'attr' => array('size' => '80', 'maxlength' => '140')
            ));
       $builder->add('lnBonPlan', 'entity', array(
            'label' => 'Le bon plan du week-end',
            'class' => 'TDN\RedactionBundle\Entity\Article',
            'property' => 'titre',
            'query_builder' => function(EntityRepository $er) {
                $now = new \DateTime;
                $moinsSeptJours = new \DateInterval('P7D');
                $moinsTrenteJours = new \DateInterval('P30D');
                $statutsAutorises = array('ARTICLE_PUBLIE', 'ARTICLE_BROUILLON');
                $qb = $er->createQueryBuilder('u');
                return $qb->where($qb->expr()->andX(
                              $qb->expr()->gte('u.datePublication', ':after'),
                              $qb->expr()->in('u.statut', ':statut'),
                              $qb->expr()->like('u.titre', $qb->expr()->literal('%bon plan%'))
                            ))
                          ->setParameter('after',$now->sub($moinsTrenteJours))
                          ->setParameter('statut', $statutsAutorises)
                          ->orderBy('u.datePublication', 'DESC');
        }));
       $builder->add('lnLire', 'entity', array(
            'label' => 'A lire',
            'class' => 'TDN\DocumentBundle\Entity\Document',
            'property' => 'titre',
            'query_builder' => function(EntityRepository $er) {
                $now = new \DateTime;
                $moinsSeptJours = new \DateInterval('P7D');
                $moinsTrenteJours = new \DateInterval('P30D');
                $statutsAutorises = array('ARTICLE_PUBLIE', 'SELECTION_PUBLIEE', 'CONSEIL_PUBLIE', 'VIDEO_PUBLIEE', 'DOSSIER_PUBLIE', 'QUESTION_PUBLIEE', 'CONCOURS_PUBLIE');
                $qb = $er->createQueryBuilder('u');
                return $qb->where($qb->expr()->andX(
                              $qb->expr()->gte('u.datePublication', ':after'),
                              $qb->expr()->in('u.statut', ':publies')
                            ))
                          ->setParameter('after',$now->sub($moinsTrenteJours))
                          ->setParameter('publies', $statutsAutorises)
                          ->orderBy('u.datePublication', 'DESC');
        }));
       $builder->add('lnVideo', 'entity', array(
            'label' => 'La vidéo',
            'class' => 'TDN\VideoBundle\Entity\Video',
            'property' => 'titre',
            'query_builder' => function(EntityRepository $er) {
                $now = new \DateTime;
                $moinsSeptJours = new \DateInterval('P7D');
                $qb = $er->createQueryBuilder('u');
                return $qb->where($qb->expr()->andX(
                              $qb->expr()->gte('u.datePublication', ':after'),
                              $qb->expr()->like('u.statut', $qb->expr()->literal('VIDEO_PUBLIEE'))
                            ))
                          ->setParameter('after',$now->sub($moinsSeptJours))
                          ->orderBy('u.datePublication', 'DESC');
        }));
       $builder->add('lnArticleSponsor', 'entity', array(
            'label' => 'Article sponsorisé',
            'class' => 'TDN\RedactionBundle\Entity\Article',
            'property' => 'titre',
            'empty_value' => 'Pas d’article sponsorisé',
            'required' => false,
            'query_builder' => function(EntityRepository $er) {
                $now = new \DateTime;
                $moinsSeptJours = new \DateInterval('P7D');
                $qb = $er->createQueryBuilder('u');
                return $qb->where($qb->expr()->andX(
                              $qb->expr()->gte('u.datePublication', ':after'),
                              $qb->expr()->like('u.statut', $qb->expr()->literal('ARTICLE_PUBLIE')),
                              $qb->expr()->like('u.sponsor', ':true')
                            ))
                          ->setParameter('after',$now->sub($moinsSeptJours))
                          ->setParameter('true', true)
                          ->orderBy('u.datePublication', 'DESC');
        }));
       $builder->add('lnQuestion', 'entity', array(
            'label' => 'LA question de nana',
            'class' => 'TDN\CauseuseBundle\Entity\Question',
            'property' => 'titre',
            'query_builder' => function(EntityRepository $er) {
                $now = new \DateTime;
                $moinsSeptJours = new \DateInterval('P7D');
                $qb = $er->createQueryBuilder('u');
                return $qb->where($qb->expr()->andX(
                              $qb->expr()->gte('u.datePublication', ':after'),
                              $qb->expr()->like('u.statut', $qb->expr()->literal('QUESTION_PUBLIEE'))
                            ))
                          ->setParameter('after',$now->sub($moinsSeptJours))
                          ->orderBy('u.datePublication', 'DESC');
        }));
        $builder->add('editorial', 'textarea', 
            array(
                'label' => 'Editorial'
            ));
        $builder->add('AstroLoveBelier', 'textarea', 
            array(
                'label' => 'Astro Bélier',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveTaureau', 'textarea', 
            array(
                'label' => 'Astro Taureau',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveGemeaux', 'textarea', 
            array(
                'label' => 'Astro Gémeaux',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveCancer', 'textarea', 
            array(
                'label' => 'Astro Cancer',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveLion', 'textarea', 
            array(
                'label' => 'Astro Lion',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveVierge', 'textarea', 
            array(
                'label' => 'Astro Vierge',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveBalance', 'textarea', 
            array(
                'label' => 'Astro Balance',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveScorpion', 'textarea', 
            array(
                'label' => 'Astro Scorpion',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveSagittaire', 'textarea', 
            array(
                'label' => 'Astro Sagittaire',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveCapricorne', 'textarea', 
            array(
                'label' => 'Astro Capricorne',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLoveVerseau', 'textarea', 
            array(
                'label' => 'Astro Verseau',
                'attr' => array('class' => 'longueurLimitee')
            ));
        $builder->add('AstroLovePoissons', 'textarea', 
            array(
                'label' => 'Astro Poissons',
                'attr' => array('class' => 'longueurLimitee')
            ));
         $builder->add('datePublication', 'date', 
            array(
                'label' => 'Date de Publication',
                'empty_value' => array('year' => date('Y'), 'month' => date('m'), 'day' => date('d')),
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