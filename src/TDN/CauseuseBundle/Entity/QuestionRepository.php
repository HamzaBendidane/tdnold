<?php

namespace TDN\CauseuseBundle\Entity;

use Doctrine\ORM\EntityRepository;

use TDN\DocumentBundle\Entity\DocumentRepository;


/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends DocumentRepository
{

	public function findMostRecent ($limite, $panel = NULL, $tree = false) {
		return parent::findMostRecentDocument ($limite, 'QUESTION_PUBLIEE', $panel, $tree = false);
   }

   public function findMostLiked ($limite, $panel = NULL) {
      return parent::findMostLikedDocument ($limite, 'QUESTION_PUBLIEE', $panel);
   }

	public function findByRubrique ($rubrique, $limite, $offset) {
		$qb = $this->createQueryBuilder('v');
		$query = $qb->select('v')
					->innerjoin('v.rubriques', 'r')
					->leftjoin('r.rubriqueParente', 'p')
	        		->where($qb->expr()->andX(
	        			$qb->expr()->like('v.statut', $qb->expr()->literal('QUESTION_PUBLIEE')),
	        			$qb->expr()->orX(
	        				$qb->expr()->like('r.slug', ':rubrique'),
	        				$qb->expr()->like('p.slug', ':rubrique')
	        			)))
	        		->setParameter('rubrique', $rubrique)
	        		->orderBy('v.datePublication', 'DESC')
	        		->groupBy('v.idDocument')
	        		->setFirstResult($offset*($limite-1))
	        		->setMaxResults($limite)
	        		->getQuery()
	        		->useResultCache(true, 900);

	    /*$query = "SELECT DISTINCT D FROM `Document` D JOIN DocumentThemes T ON T.for_document = D.id 
	    JOIN DocumentRubrique R1 ON T.for_document = R1.id JOIN DocumentRubrique R2 ON R1.rubriqueParente_id = R2.id 
	    WHERE D.typeDocument = 'video' AND D.statut LIKE 'VIDEO_PUBLIEE' AND (R1.slug LIKE '$rubrique' OR R2.slug LIKE '$rubrique')
	    LIMIT ($limite, $offset)";
	    */
	     $last = $query->getResult();
	     return $last;
	}

}
