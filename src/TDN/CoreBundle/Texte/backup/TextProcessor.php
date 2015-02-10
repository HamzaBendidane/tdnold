<?php

namespace TDN\CoreBundle\Texte;

class TextProcessor {   

    public function flattenAtSeparator($texte, $longueur)
    {
        $nakedTexte = strip_tags($texte);
        if (strlen($nakedTexte) > $longueur) {
            $sample = substr($nakedTexte,0,$longueur);
            $_x = strrpos($sample, ' ');
            $_y = strrpos($sample, '.');
            $_z = strrpos($sample, ',');
            $sample = substr($sample,0,max($_x,$_y,$_z));
            return $sample;
        } else {
            return $nakedTexte;
        }
    }
}
