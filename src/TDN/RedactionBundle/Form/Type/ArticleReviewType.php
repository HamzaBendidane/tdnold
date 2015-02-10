<?php

namespace TDN\RedactionBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;


class ArticleReviewType extends ArticleType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

		// Document Héritage
        $builder->add('datePublication', 'date',
            array('label' => 'Date de publication',
                   'format' => 'dd-MM-yyyy',
                   'input' => 'datetime'
            ));

        // Article
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