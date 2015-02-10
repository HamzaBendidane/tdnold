<?php

namespace TDN\CoreBundle\URL;

class URLShortener {   

    public function url_shortener($url)
    {
        $ch = curl_init();  
        $timeout = 5;  
        curl_setopt($ch, CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);  
        $data = curl_exec($ch);  
        curl_close($ch);  
        return $data;  
    }

    public function urlTagger($texte)
    {
        $err = preg_match_all('#(http://[^\s]+)#', $texte, $links, PREG_OFFSET_CAPTURE);
        foreach($links[1] as $l) {
            $source = $l[0];
            $short = $this->url_shortener($source);
            $err = preg_match('#http://([^/]+)/?#', $source, $domaine);
            $url = "<a class='autoTaggedLink' target='_blank' href='$short'>".$domaine[1]."</a>";
            $texte = str_replace($source, $url, $texte);
        }

        return $texte;
    }
}
