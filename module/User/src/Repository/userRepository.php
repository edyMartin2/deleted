<?php


namespace User\Repository;


use Doctrine\ORM\EntityRepository;
use User\Entity\userEntity;
use Doctrine\ORM\Query;
class userRepository extends EntityRepository
{

    /**
     * Retrieves all users in descending dateCreated order.
     * @return Query
     */


    public function getUser(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(userEntity::class, 'u')
            ->orderBy('u.id', 'DESC');
        $arr = $queryBuilder->getQuery()->toArray();
        $js = json_encode($arr);
        return $js;
    }

    public function updateUser($campo,$valor,$id){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->update(userEntity::class,'u')
            ->set('u'.$campo, '?1')
            ->setParameter(1,$valor)
            ->where('u.id = ?2')
            ->setParameter(2, $id)
            ->getQuery()

            ->getSingleScalarResult();
        return true;
    }
}