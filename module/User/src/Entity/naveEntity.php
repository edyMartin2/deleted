<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\naveRepository")
 * @ORM\Table(name="nave")
 */

class naveEntity
{


    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(name="name")
     */
    protected $name;
    /**
     * @ORM\Column(name="parque_id")
     */
    protected $parque_id;


    /**
     * Returns id.
     */
    public function getid()
    {
        return $this->id;
    }


    /**
     * Returns name.
     */
    public function getname()
    {
        return $this->name;
    }


    /**
     * Returns parque_id.
     */
    public function getparque_id()
    {
        return $this->parque_id;
    }




    /**
     * Sets id
     * @param int $id
     */
    public function setid($id)
    {
        $this->id = $id;
    }

    /**
     * Sets name
     * @param string $name
     */
    public function setname($name)
    {
        $this->name = $name;
    }

    /**
     * Sets parque_id
     * @param string $parque_id
     */
    public function setparque_id($parque_id)
    {
        $this->parque_id = $parque_id;
    }
}
