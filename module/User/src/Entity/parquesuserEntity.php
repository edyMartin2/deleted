<?php


namespace User\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\parqueuserRepository")
 * @ORM\Table(name="parques_usuarios")
 */


class parquesuserEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    private $id;
    /*
     * @ORM\Column(name="user")
     */
    private $user;
    /**
     * @ORM\Column(name="id_parque")
     */
    private $id_parque;

    /**
     * @ORM\Column(name="persona")
     */
    private $persona;
    /**
     * @ORM\Column(name="permiso")
     */
    private $permiso;

    /**
     * Returns id.
     * @return integer
     */
    public function getid(){ return $this->id;}

    /**
     * Returns user.
     * @return integer
     */
    public function getuser(){ return $this->user;}

    /**
     * Returns id_parque.
     * @return integer
     */
    public function getid_parque(){ return $this->id_parque;}

    /**
     * Returns id_parque.
     * @return String
     */
    public function getpermiso(){ return $this->permiso;}

    /**
     * Sets id
     * @param int $id
     */
    public function setid($id){$this->id = $id;}


    /**
     * Sets id_parque
     * @param integer $id_parque
     */
    public function setid_parque($id_parque){$this->id_parque = $id_parque;}

    /**
     * Sets id_permiso
     * @param String $permiso
     */
    public function setpermiso($permiso){$this->permiso = $permiso;}

    /**
     * Sets user
     * @param integer $user
     */

    public function setUser($user){if ($user != null){$this->user = $user;} else {$this->user = 2;}}

    /**
     * Sets persona
     * @param String $persona
     */
    public function setPersona($persona){$this->persona = $persona;}
}