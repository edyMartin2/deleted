<?php


namespace User\Repository;


use Doctrine\ORM\EntityRepository;
use User\Entity\inquilino_naveEntity;

class inquilinoNaveRepository extends EntityRepository
{
    public function getInqui(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(inquilino_naveEntity::class, 'u')
            ->orderBy('u.id', 'DESC');

        $arr = $queryBuilder->getQuery()->toArray();

        $js = json_encode($arr);
        return $js;
    }

    public function updateData($campo,$valor, $id){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->update(inquilino_naveEntity::class,'u')
            ->set('u'.$campo, '?1')
            ->setParameter(1,$valor)
            ->where('u.id = ?2')
            ->setParameter(2, $id)
            ->getQuery()

            ->getSingleScalarResult();
        return true;
    }
}