<?php


namespace Application\Service\Factory;


class pruebaManagerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $config = $container->get('Config');

        return new UserManager($entityManager, $config);
    }
}