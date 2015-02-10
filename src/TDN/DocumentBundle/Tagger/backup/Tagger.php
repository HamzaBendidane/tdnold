<?php

namespace TDN\DocumentBundle\Tagger;

use Doctrine\Common\Collections\Collection;

use TDN\DocumentBundle\Entity\Tag;

class Tagger
{
  protected $em;
  protected $entity;

  public function __construct($em)
  {
    $this->em = $em;
    // $this->entity = $entity;
  }

  /**
   * Construit et associe à un document les objets Tag issus de la liste
   * des mots-clefs donnés dans le cham de formulaire
   *
   * @param Document $document
   */
  public function tag($document, $indexCollection) {

    $rep_tag = $this->em->getRepository('TDN\DocumentBundle\Entity\Tag');
    // $tags = $document->getTags();
    if (!empty($indexCollection)) {
      $lemmesArray = $this->lemmatiseur($indexCollection);
      foreach ($lemmesArray as $tag) {
         if (!empty($tag['forme'])) {
          $index = $rep_tag->findOneByExpression($tag['forme']);
          if ($index instanceof Tag) {
            $fil = $document->getFilTags();
            $doublon = false;
            if ($document->getFilTags() instanceof Collection) {
              foreach ($document->getFilTags() as $t) {
                if ($t->getExpression() == $index->getExpression()) {
                  print_r("[".$t->getExpression(). " - ".$index->getExpression()."]");
                  $doublon = true;
                }
              }            
            }
            if (!$doublon) $document->addTag($index);
          } else {
            $newTag = new Tag;
            $newTag->setLemme($tag['lemme']);
            $newTag->setForme($tag['type']);
            $newTag->setExpression($tag['forme']);
            $this->em->persist($newTag);
            $document->addTag($newTag);
          }
        }
      }
      $this->normalizeTags($document, $lemmesArray);
      return $lemmesArray;
    }
    return false;
  }

  public function tagsUpdate($document, $indexCollection) {

    // Effacement des mots-clefs déjà inscrits
    $document->resetTags();
    $lemmesArray = $this->tag($document, $indexCollection);
    $this->normalizeTags($document, $lemmesArray);
    return $lemmesArray;
  }

  public function tagsBuilder($document) {

    $source = $document->getTags();
    if (!empty($source)) {
      if (!strstr($source, ',')) {
        $source = str_replace(' ', ',', $source);
      }
      $clefs = explode(',', $source);
      $clefs = array_unique($clefs);
      $source = implode(',', $clefs);
      $lemmesArray = $this->tag($document, $source);
      $this->normalizeTags($document, $lemmesArray);
      return $lemmesArray;
    }
  }

  protected function normalizeTags($document, $lemmesArray) {
    if ($lemmesArray !== false) {
      $formes = array();
      foreach ($lemmesArray as $tag) {
        if (!empty($tag)) {
          $formes[] = $tag['forme'];
        }
      }
      $document->setTags(implode(',', $formes));
    }
  }

  protected function lemmatiseur ($entrees) {
    $url = "http://cental.fltr.ucl.ac.be/treetagger/index.html";
    $file = 'logs/lemmesBuffer.txt';

    if (is_array($entrees)) {
      $tabEntrees = array();
      foreach ($entrees as $e) {
        $tabEntrees[] = $e->getExpression();
      }
      $serialEntrees = implode(', ', $tabEntrees);
      file_put_contents($file, $serialEntrees);
    } else {
      file_put_contents($file, $entrees);
    }

    $source = realpath($file);

    $pattern = '/href="(tmp\/([^\.]+)\.txt)"/';
    $patternTagger = '/(([^\s]+)\s*){3}\n/';
    $patternTagger = '/([^\s]+)\s*([^\s]+)\s*([^\s]+)\s*\n/';

    $channel = curl_init($url);
    $post = array('file_to_tag' => '@'.$source, 'submit' => '');
    curl_setopt($channel, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($channel, CURLOPT_POST,1);
    curl_setopt($channel, CURLOPT_POSTFIELDS, $post);

    $reponse = curl_exec($channel);

    curl_close($channel);

    $err = preg_match($pattern, $reponse, $matches);
    $target = $matches[1];
    $tagged = "http://cental.fltr.ucl.ac.be/treetagger/".$target;

    $lemmes = file_get_contents($tagged);
    print_r($lemmes);
    $err = preg_match_all($patternTagger, $lemmes, $lignes, PREG_SET_ORDER);

    $lemmesArray = array();
    foreach ($lignes as $l) {
      if ($l[2] === 'PUN') {
        $lemmesArray[] = array();
      } else {
        if ($l[3] === "<unknown>") {
          $l[3] = $l[1];
        }
        $index = empty($lemmesArray) ? 0 : count($lemmesArray) - 1;
        $lemmesArray[$index]['forme'] = (!isset($lemmesArray[$index]['forme'])) ? $l[1] : $lemmesArray[$index]['forme']. ' '.$l[1];
        $lemmesArray[$index]['type'] = (!isset($lemmesArray[$index]['type'])) ? $l[2] : $lemmesArray[$index]['type']. ' '.$l[2];
        $lemmesArray[$index]['lemme'] = (!isset($lemmesArray[$index]['lemme'])) ? $l[3] : $lemmesArray[$index]['lemme']. ' '.$l[3];
      }
    }
    return $lemmesArray;
  }
}