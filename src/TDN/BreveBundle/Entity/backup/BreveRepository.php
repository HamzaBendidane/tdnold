<?php

namespace TDN\BreveBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BreveRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BreveRepository extends EntityRepository
{
	public function findMostRecent ($limite, $rubrique = NULL) {
		$qb = $this->createQueryBuilder('u');
		$qexpr = $qb->expr();
		$query = $qb->select('u');
		if ($rubrique != NULL) {
			$query = $query->innerJoin('u.lnRubrique', 'r')
						   ->where($qexpr->andX(
						   		$qexpr->eq('r.slug', ':rubrique'),
						   		$qexpr->like('u.statut', $qexpr->literal('BREVE_PUBLIEE'))))
						   ->setParameter('rubrique', $rubrique);

		}
		$query = $query->orderBy('u.datePublication', 'DESC')
	        		   ->setMaxResults($limite)
	        		   ->getQuery()
	        		   ->useResultCache(true, 120);

	     $last = $query->getResult();
	     return $last;
	}

	public function searchByAuteurID ($id, $limite = NULL, $offset = NULL) {
		if ((integer)$id == 0) return array();

		$qb = $this->createQueryBuilder('u');
		$query = $qb->select('u.message, u.id')
					->innerJoin('u.lnAuteur', 'a')
					->where($qb->expr()->eq('a.idNana', ':id'))
					->setParameter('id', $id);
		if ((integer)$limite > 0) {
			$query = $query->setMaxResults($limite);
		}
		if ((integer)$offset > 0) {
			$query = $query->setFirstResult($offset);
		}
		$query = $query->getQuery();

		$items =$query->getResult();
		// print_r($items);
		return $items;
	}

}
