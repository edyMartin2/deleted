<?php

//namespace User\Controller;
namespace User\Controller\Factory;

use User\Controller\apiController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


/**
 * This is the factory for apiController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class apiControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        // Instantiate the controller and inject dependencies
        return new apiController($entityManager);
    }
}