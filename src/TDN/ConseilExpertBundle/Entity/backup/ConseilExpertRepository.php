<?php

namespace TDN\ConseilExpertBundle\Entity;

use Doctrine\ORM\EntityRepository;

use TDN\DocumentBundle\Entity\DocumentRepository;

/**
 * ConseilExpertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConseilExpertRepository extends DocumentRepository
{
		public function findMostRead ($limite, $panel = NULL) {
		$qb = $this->createQueryBuilder('u');
		$qexpr = $qb->expr();
		$query = $qb->select('u');
		if ($panel != NULL) {
			$query = $query->innerjoin('u.rubriques', 'r')
						   ->where($qexpr->andX(
						   		$qexpr->like('u.statut', $qb->expr()->literal('CONSEIL_PUBLIE')),
						   		$qexpr->in('r.slug', ':listeRubriques')
						   	))
						   ->setParameter('listeRubriques', $panel);
		} else {
			$query = $query->where($qexpr->like('u.statut', $qb->expr()->literal('CONSEIL_PUBLIE')));
		}
		$query = $query->orderBy('u.commentThread', 'DESC')
	        		   ->setMaxResults($limite)
	        		   ->getQuery()
   	        		   ->useResultCache(true);

	     $last = $query->getResult();
	     return $last;
	}

	public function findMostLiked ($limite, $panel = NULL) {
		return parent::findMostLikedDocument($limite, 'CONSEIL_PUBLIE', $panel);
	}

	public function findMostRecent ($limite, $panel = NULL) {
		return parent::findMostRecentDocument($limite, 'CONSEIL_PUBLIE', $panel);
	}

	public function findMostRecentWithKeys ($limite, $keys) {
		if (empty($keys)) {
			return array();
		}

		return parent::findMostRecentDocumentWithKeys($limite, 'CONSEIL_PUBLIE', $keys);
	}

	public function findMostReadWithKeys ($limite, $keys) {
		if (empty($keys)) {
			return array();
		}

		return parent::findMostReadDocumentWithKeys($limite, 'CONSEIL_PUBLIE', $keys);
	}


}
