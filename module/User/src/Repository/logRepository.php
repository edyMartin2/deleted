<?php


namespace User\Repository;


use Doctrine\ORM\EntityRepository;
use User\Entity\logEntity;

class logRepository extends EntityRepository
{
    public function getlog(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(logEntity::class, 'u')
            ->orderBy('u.id', 'DESC');

        return $queryBuilder->getQuery();
    }
}