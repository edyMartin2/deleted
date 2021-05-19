<?php


namespace User\Repository;
use Doctrine\ORM\EntityRepository;
use User\Entity\userRole;
use Doctrine\ORM\Query;

//User\Repository\UserRoleRepository
class userRoleRepository extends EntityRepository
{
    /**
     * Retrieves all users in descending dateCreated order.
     * @return Query
     */

    public function getUserRole(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(userRole::class, 'u')
            ->orderBy('u.id', 'DESC');

        $arr = $queryBuilder->getQuery()->toArray();

        $js = json_encode($arr);
        return $js;
    }
}