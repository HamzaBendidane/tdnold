<?php

namespace TDN\DocumentBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Orx;
use Doctrine\ORM\Query\Expr\Andx;

/**
 * DocumentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocumentRepository extends EntityRepository
{
	public function count($critere = 'all') {
        $qb = $this->createQueryBuilder('u');
		$query = $qb->select('count(u.idDocument)');

		if ($critere != 'all') {
			$query = $query->innerjoin('u.rubriques', 'r')
						   ->leftjoin('r.rubriqueParente', 'p')
	        			   ->where($qb->expr()->orX(
	        					$qb->expr()->like('r.slug', ':rubrique'),
	        					$qb->expr()->like('p.slug', ':rubrique')
	        				))
	        			   ->setParameter('rubrique', $critere);
		}

        $nombre = $query->getQuery()->useResultCache(true, 900)->getOneOrNullResult();
        // $nombre = array('', '--');
        return $nombre;
    }

public function card($type, $critere = 'tdn') {
        $qb = $this->createQueryBuilder('v');
		$query = $qb->select('v.idDocument');

		if ($critere == 'all') {
			// $query = $query->where(1);
		} elseif ($critere != 'tdn') {
			$query = $query->innerjoin('v.rubriques', 'r')
						   ->leftjoin('r.rubriqueParente', 'p')
				    		->where($qb->expr()->andX(
				    			$qb->expr()->like('v.statut', ':type'),
				    			$qb->expr()->orX(
				    				$qb->expr()->like('r.slug', ':rubrique'),
				    				$qb->expr()->like('p.slug', ':rubrique')
				    			)))
				    		->setParameter('rubrique', $critere);
		} else {
			$query = $query->where($qb->expr()->like('v.statut',':type'));
		}

		$query = $query->setParameter('type', $type)
					   ->groupBy('v.idDocument')
					   ->getQuery()
					   ->useResultCache(true, 3600);

        $nombre = $query->getResult();
        // print_r(count($nombre)); die;
        return count($nombre);
    }

	public function findMostRecentDocument ($limite, $marqueur, $panel = NULL) {
		$qb = $this->createQueryBuilder('u');
		$qexpr = $qb->expr();
		$query = $qb->select('u');
		if (!is_array($marqueur)) $marqueur = array($marqueur);
		if ($panel != NULL) {
			$query = $query->innerjoin('u.rubriques', 'r')
						   ->where($qexpr->andX(
						   		$qexpr->in('u.statut', ':marqueur'),
						   		$qexpr->in('r.slug', ':listeRubriques')
						   	))
						   ->setParameter('listeRubriques', $panel);

		} else {
			$query = $query->where($qexpr->in('u.statut', ':marqueur'));
		}
		$query = $query->orderBy('u.datePublication', 'DESC')
					   ->setParameter('marqueur', $marqueur)
	        		   ->setMaxResults($limite)
	        		   ->getQuery();
	        		   // ->useResultCache(true, 900);

	     $last = $query->getResult();
	     return $last;
	}

	public function findMostRecentDocumentWithKeys ($limite, $marqueur, $keys) {
		$qb = $this->createQueryBuilder('u');
		$qexpr = $qb->expr();
		$query = $qb->select('u');

		$_orxCondition = $qexpr->orX();
		foreach ($keys as $k) {
			$k = "%$k%";
			$_orxCondition->add($qexpr->like('u.tags', $qexpr->literal($k)));
		}

		$query = $query->innerjoin('u.rubriques', 'r')
					   ->where($qexpr->andX(
					   		$qexpr->like('u.statut', ':marqueur'),
					   		$_orxCondition
					   	));

		$query = $query->orderBy('u.datePublication', 'DESC')
					   ->setParameter('marqueur', $marqueur)
	        		   ->setMaxResults($limite)
	        		   ->getQuery();

	     $last = $query->getResult();
	     return $last;
	}

	public function findMostReadDocumentWithKeys ($limite, $marqueur, $keys) 
	{
		$qb = $this->createQueryBuilder('u');
		$qexpr = $qb->expr();
		$query = $qb->select('u');

		$_orxCondition = $qexpr->orX();
		foreach ($keys as $k) {
			$k = "%$k%";
			$_orxCondition->add($qexpr->like('u.tags', $qexpr->literal($k)));
		}

		$query = $query->innerjoin('u.rubriques', 'r')
					   ->where($qexpr->andX(
					   		$qexpr->like('u.statut', ':marqueur'),
					   		$_orxCondition
					   	));

		$query = $query->orderBy('u.commentThread', 'DESC')
					   ->setParameter('marqueur', $marqueur)
	        		   ->setMaxResults($limite)
	        		   ->getQuery();

	     $last = $query->getResult();
	     return $last;
	}

	public function findMostLikedDocument ($limite, $marqueur, $panel = NULL) {
		$qb = $this->createQueryBuilder('u');
		$qexpr = $qb->expr();
		$query = $qb->select('u');
		if ($panel != NULL) {
			$query = $query->innerjoin('u.rubriques', 'r')
						   ->where($qexpr->andX(
						   		$qexpr->like('u.statut', ':marqueur'),
						   		$qexpr->in('r.slug', ':listeRubriques')
						   	))
						   ->setParameter('listeRubriques', $panel);

		} else {
			$query = $query->where($qexpr->like('u.statut', ':marqueur'));
		}
		$query = $query->orderBy('u.likes', 'DESC')
					   ->setParameter('marqueur', $marqueur)
	        		   ->setMaxResults($limite)
	        		   ->getQuery();

	     $last = $query->getResult();
	     return $last;
	}

	public function searchByAuteurID ($id, $limite = NULL, $offset = NULL) {
		if ((integer)$id == 0) return array();

		$qb = $this->createQueryBuilder('u');
		$query = $qb->select('u')
					->innerJoin('u.lnAuteur', 'a')
					->innerJoin('u.rubriques', 'r')
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
		return $items;
	}

	public function findBySeed ($seed) {

        $qb = $this->createQueryBuilder('u');
        $expressionsConjointes = explode('+', $seed);
        $expressionsAlternatives = array();
        foreach ($expressionsConjointes as $expr) {
        	$expressionsAlternatives[] = array();
        	$err = preg_match_all('/("[^"]+"|[\w\d]+)/i', $expr, $semes);
        	if (!empty($semes[1])) {
	        	foreach ($semes[1] as $m) {
	        		print_r($m);
	        		$expressionsAlternatives[count($expressionsAlternatives)-1][] = trim($m, '"');
	        	 } {
	        	}        		
        	}
        }
		$indexParam = 0;
		$paramsSeeds = array();
        $composeur = new Andx;
        $composeur->add($qb->expr()->like('u.statut', $qb->expr()->literal('%PUBLIE%')));
        foreach ($expressionsAlternatives as $expr) {
			$altern = new Orx;
        	foreach ($expr as $_s) {
				$_finalSeed = trim($_s);
				if ($_finalSeed != '') {
			        $_extSeed = "%".$_finalSeed."%";
					$paramsSeeds[] = $_extSeed;
					$altern->add($qb->expr()->like('u.titre', ':seed_'.$indexParam));
					$altern->add($qb->expr()->like('u.abstract', ':seed_'.$indexParam));
					$altern->add($qb->expr()->like('u.tags', ':seed_'.$indexParam));
					$indexParam += 1;
				}
        	}
        	$composeur->add($altern);
        }

        $query = $qb->select('u')
                    ->where($composeur);

        $i = 0;
        foreach ($paramsSeeds as $s) {
        	$query = $query->setParameter('seed_'.$i, $s);
        	$i += 1;
        }
        $query = $query->orderBy('u.datePublication', 'DESC')
    		  		   ->setMaxResults(100)
              		   ->getQuery();

        $resultats = $query->getResult();
        // print_r(count($resultats)); die;
        return $resultats;

	}

	public function findByWithWilcards ($wildcards, $constantes = NULL, $tri = NULL, $debut = NULL, $longueur = NULL)
	{
		$qb = $this->createQueryBuilder('u');
		$qexpr = $qb->expr();

		$query = $qb->select('u');
		$_andExpr = $qexpr->andX();
		foreach ($wildcards as $champ => $valeur) {
			$_andExpr->add($qexpr->like('u.'.$champ, $qexpr->literal('%'.$valeur.'%')));
		}
		foreach ($constantes as $champ => $valeur) {
			$_andExpr->add($qexpr->eq('u.'.$champ, $qexpr->literal($valeur)));
		}

		$query = $query->where($_andExpr)
					   ->setMaxResults(100)
					   ->getQuery()
					   ->useResultCache(true);

        $resultats = $query->getResult();
        return $resultats;
	}

}