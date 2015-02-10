<?php

namespace TDN\DocumentBundle\Twig;

use TDN\DocumentBundle\Entity\DocumentRubrique;

class RubriqueExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('rubriquePrincipale', array($this, 'rubriquePrincipaleFunction')),
            new \Twig_SimpleFunction('hasSponsor', array($this, 'hasSponsorFunction')),
        );
    }

    public function rubriquePrincipaleFunction($rubrique)
    {
        if ($rubrique instanceof DocumentRubrique) {
            $parent = $rubrique->getRubriqueParente();
            if ($parent instanceof DocumentRubrique) {
                $marqueur = $parent->getSlug();
            } else {
                $marqueur = $rubrique->getSlug();
            }
        } else {
            $marqueur = $rubrique;
        }

        return $marqueur;
    }

    public function hasSponsorFunction($rubrique)
    {
        if (is_object($rubrique)) {
            $link = $rubrique->getSponsorLink();
            $debut = $rubrique->getDatePublication();
            $now = new \DateTime();
            if (!(is_null($link) || ($debut > $now))) {
                $style = "background-image: url(/assets/images/sponsors/".$rubrique->getsponsorImage().");";
                $style .= "background-repeat: no-repeat; ";
                $style .= "background-position:  50% top; ";
                $style .= "background-attachment: fixed; ";
                $style .= "background-color: #FFF;";
                // $style .= "background-color: ".$rubrique->getCouleur().";";
            } else {
                $style = '';
            }
        } else {
            $style = 'display:block;';
        }

        return $style;
    }

    public function getName()
    {
        return 'rubrique_extension';
    }
}