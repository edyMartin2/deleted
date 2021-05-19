<?php


namespace User\Repository;
use Doctrine\ORM\EntityRepository;
use User\Entity\mapsEntity;
use Doctrine\ORM\Query;

class mapsRepository extends EntityRepository{
    /**
     * Retrieves all users in descending dateCreated order.
     * @return Query
     */
    public function getCorp(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(mapsEntity::class, 'u')
            ->orderBy('u.id', 'DESC');

        $arr = $queryBuilder->getQuery()->toArray();

        $js = json_encode($arr);
        return $js;
    }

}
