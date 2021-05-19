<?php


namespace User\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use User\Entity\parqueEntity;

class parqueRepository extends EntityRepository
{
    /**
     * Retrieves all users in descending dateCreated order.
     * @return Query
     */

    public function getPark(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(parqueEntity::class, 'u')
            ->orderBy('u.id', 'DESC');

            return  $queryBuilder->getQuery();

    }

    public function updatePark($campo,$valor, $id){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->update(parqueEntity::class,'u')
            ->set('u'.$campo, '?1')
            ->setParameter(1,$valor)
            ->where('u.id = ?2')
            ->setParameter(2, $id)
            ->getQuery()

            ->getSingleScalarResult();
        return true;
    }
}