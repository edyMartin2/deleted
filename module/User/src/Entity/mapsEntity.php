<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\mapsRepository")
 * @ORM\Table(name="locations")
 */

class mapsEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="name")
     */
    private $name;

    /**
     * @ORM\Column(name="lat")
     */
    private $lat;

    /**
     * @ORM\Column(name="lng")
     */
    private $lng;

    /**
     * @ORM\Column(name="filters")
     */
    private $filters;

    /**
     * Returns id.
     * @return integer
     */
    public function getid(){ return $this->id;}

    /**
     * Returns name.
     * @return string
     */
    public function getname(){ return $this->name;}

    /**
     * Returns lat
     * @return string
     */
    public function getlat(){ return $this->lat;}

    /**
     * Returns lng.
     * @return string
     */
    public function getlng(){ return $this->lng;}
    
    /**
     * Returns filters.
     * @return string
     */
    public function getfilters(){ return $this->filters;}
    
    /**
     * Sets id
     * @param integer $id
     */
    public function setid($id){ $this->id = $id; }

    /**
     * Sets name
     * @param integer $name
     */
    public function setname($name){ $this->name = $name; }

    /**
     * Sets lat
     * @param integer $lat
     */
    public function setlat($lat){ $this->lat = $lat; }

    /**
     * Sets lng
     * @param integer $lng
     */
    public function setlng($lng){ $this->lng = $lng; }

    /**
     * Sets filters
     * @param integer $filters
     */
    public function setfilters($filters){ $this->filters = $filters; }
}
