<?php

namespace TDN\DossierRedactionBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class DossierRedactionNewType extends DossierRedactionType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // Document Héritage
        $builder->add('datePublication', 'date',
            array('label' => 'Date de publication',
                  'format' => 'dd-MM-yyyy',
                  'input' => 'datetime'
            ));

     }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\DossierRedactionBundle\Entity\Dossier',
            'cascade' => true
    	));
	}

    public function getName()
    {
        return 'DossierRedaction_Detail';
    }
}