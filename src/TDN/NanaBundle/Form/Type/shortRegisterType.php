<?php

namespace TDN\NanaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class shortRegisterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('email', 'email',
            array(
                'label' => 'E-mail',
                'error_bubbling' => true
            ));
        $builder->add('username', 'text',
            array(
                'label' => 'Pseudo',
                'error_bubbling' => true
            ));
        $builder->add('password', 'repeated',
            array(
                'type' => 'password',
                'invalid_message' => 'Les mots de passe doivent correspondre',
                'options' => array('required' => true),
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => '(Validation)'),
                'error_bubbling' => true
        ));
        $_annees = array();
        $now = new \DateTime;
        $an = (integer)$now->format('Y');
        for($i = $an - 80; $i <= $an - 7; $i++) $_annees[] = $i;
        $builder->add('dateNaissance', 'birthday',
            array(
                'label' => 'Né(e) le',
                'years' => $_annees,
                'empty_value' => '---',
                'error_bubbling' => true
        ));
        $builder->add('sexe', 'choice',
            array(
                'label' => 'sexe',
                'multiple' => false,
                'expanded' => true,
                'choices' => array('2' => 'Fille', '1' => 'Garçon'),
                'preferred_choices' => array('2'),
                'error_bubbling' => true
        ));
        $builder->add('offresPartenaires', 'choice',
            array(
                'label' => 'Je souhaite recevoir par e-mail la newsletter de TDN avec l’astrolove, les cadeaux et les bons plans de TrucsDeNana et ses partenaires',
                'multiple' => false,
                'expanded' => true,
                'choices' => array('1' => 'Oui', '0' => 'Non'),
                'preferred_choices' => array('1'),
                'error_bubbling' => true
        ));
        // $builder->add('newsletter', 'choice',
        //     array(
        //         'label' => 'Je m’abonne à la newsletter de TDN',
        //         'multiple' => false,
        //         'expanded' => true,
        //         'choices' => array('1' => 'Oui', '0' => 'Non'),
        //         'preferred_choices' => array('1'),
        //         'error_bubbling' => true
        // ));
    }


	public function setDefaultOptions(OptionsResolverInterface $resolver) {

	    $resolver->setDefaults(array(
	    	'data_class' => 'TDN\NanaBundle\Entity\Nana',
    	));
	}

    public function getName()
    {
        return 'marylin_shortregister_nana';
    }
}