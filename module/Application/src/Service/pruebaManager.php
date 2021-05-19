<?php

namespace Application\Service;
use Application\Entity\prueba;

class pruebaManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct($entityManager, $config)
    {
        $this->entityManager = $entityManager;
        $this->config = $config;
    }



    public function search(){
        $ret = $this->entityManager->getRepository(prueba::class).find();
        return $ret;
    }
}