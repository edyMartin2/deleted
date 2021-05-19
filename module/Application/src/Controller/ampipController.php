<?php


namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Application\Entity\prueba;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ampipController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */


    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexcAction (){
        $ret = $this->entityManager->getRepository(prueba::class)->findBy([],["name"=>"DESC"]);

        return new JsonModel([
            "Hoa"=>$ret
        ]);
    }
}