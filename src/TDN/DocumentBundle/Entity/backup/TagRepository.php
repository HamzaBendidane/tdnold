<?php

namespace TDN\DocumentBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\DriverManager;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{

	public function findSimilars ($id) {

		$statement = $this->getEntityManager()->getConnection();

		// $rsm = new ResultSetMapping;
		// $rsm->addEntityResult('TDN\DocumentBundle\Entity\Document', 'd');
		// $rsm->addJoinedEntityResult('TDN\DocumentBundle\Entity\Tag', 't', 'd', 'filTags');
		// $rsm->addJoinedEntityResult('TDN\ImageBundle\Entity\Image', 'v', 'd', 'lnIllustration');
		// $rsm->addFieldResult('d', 'id', 'idDocument');
		// $rsm->addFieldResult('d', 'titre', 'titre');
		// $rsm->addFieldResult('d', 'slug', 'slug');
		// $rsm->addFieldResult('d', 'abstract', 'abstract');
		// $rsm->addFieldResult('d', 'date_publication', 'datePublication');
		// $rsm->addFieldResult('d', 'tags', 'tags');
		// $rsm->addScalarResult('t', 'id', 'proximite');
		// $rsm->addMetaResult('d', 'typeDocument', 'typeDocument'); // discriminator column
		// $rsm->setDiscriminatorColumn('d', 'typeDocument');

		$sql = "SELECT d.id, d.titre, d.abstract, d.slug, d.date_publication, d.tags, d.ln_illustration, d.typeDocument, v.id AS illustration
				FROM Document d 
				INNER JOIN DocumentIndex i ON i.for_document = d.id
				INNER JOIN Tag t ON i.for_tag = t.id
				LEFT JOIN Image v ON v.id = d.ln_illustration
				WHERE t.expression IN (
					SELECT t2.expression
					FROM Tag t2
					INNER JOIN DocumentIndex i2 ON i2.for_tag = t2.id
					WHERE i2.for_document = :idDoc
				)
				AND d.id <> :idDoc 
				AND d.statut IN ('ARTICLE_PUBLIE', 'ARTICLE_BROUILLON', 'ARTICLE_FEUILLET', 'CONSEIL_PUBLIE', 'DOSSIER_PUBLIE', 'QUESTION_PULIEE', 'VIDEO_PUBLIEE')
				GROUP BY d.id
				HAVING COUNT(t.id) > 1
				ORDER BY RAND()
				LIMIT 5";

		// $query = $this->getEntityManager()->createNativeQuery($sql, $rsm)
		// 			  ->setParameter('idDoc', $id)
		// 			  ->useResultCache(true, 36000);

		// $statement->prepare($sql);
		// $statement->bindValue('idDoc', $id);
		// $statement->execute();
		$similars = $statement->fetchAll($sql, array('idDoc' => $id));

		// $similars = $query->getResult();
		// Chaque objet est un sous-élément du tableau		
		// e.g. $similars[0][0]->getTags().' | ');

		return $similars;
	}

	public function findNotIndexed () {

		$rsm = new ResultSetMapping;
		$rsm->addEntityResult('TDN\DocumentBundle\Entity\Document', 'd');
		$rsm->addJoinedEntityResult('TDN\DocumentBundle\Entity\Tag', 't', 'd', 'filTags');
		$rsm->addFieldResult('d', 'id', 'idDocument');
		$rsm->addFieldResult('d', 'tags', 'tags');
		$rsm->addMetaResult('d', 'typeDocument', 'typeDocument'); // discriminator column
		$rsm->setDiscriminatorColumn('d', 'typeDocument');

		$sql = "SELECT d.id, d.tags, d.typeDocument 
				FROM Document d 
				LEFT JOIN DocumentIndex i ON i.for_document = d.id
				WHERE i.for_document IS NULL
				AND d.tags != ''
				AND d.statut IN ('ARTICLE_PUBLIE', 'ARTICLE_BROUILLON', 'ARTICLE_FEUILLET', 'CONSEIL_PUBLIE', 'DOSSIER_PUBLIE', 
					'QUESTION_PULIEE', 'VIDEO_PUBLIEE', 'CONCOURS_PUBLIE')
				ORDER BY d.id ASC
				LIMIT 50";

		$query = $this->getEntityManager()->createNativeQuery($sql, $rsm);

		return $query->getResult();
	}
}
