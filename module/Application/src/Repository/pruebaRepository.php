<?php


namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\prueba;

class pruebaRepository extends EntityRepository
{
    /**
     * Retrieves all users in descending dateCreated order.
     * @return Query
     */

    public  function getPrueba(){
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(prueba::class, 'u')
            ->orderBy('u.id', 'DESC');

        return $queryBuilder->getQuery();
    }
}