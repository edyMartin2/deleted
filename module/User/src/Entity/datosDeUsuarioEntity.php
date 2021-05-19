<?php


namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\datosDeUsuarioRepository")
 * @ORM\Table(name="datosDeUsuario")
 */

class datosDeUsuarioEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="key_corp")
     */
    protected $key_corp;


    /**
     * @ORM\Column(name="idAmpip")
     */
    protected $idAmpip;


    /**
     * @ORM\Column(name="cargo")
     */
    protected $cargo;



    /**
     * @ORM\Column(name="telefonoOfficina")
     */
    protected $telefonoOfficina;



    /**
     * @ORM\Column(name="celular")
     */
    protected $celular;



    /**
     * @ORM\Column(name="direccionDeOfficina")
     */
    protected $direccionDeOfficina;



    /**
     * @ORM\Column(name="cumpleanios")
     */
    protected $cumpleanios;



    /**
     * @ORM\Column(name="compartirDatos")
     */
    protected $compartirDatos;

    /**
     * @ORM\Column(name="habilitar")
     */
    protected $habilitar;


    public function getidAmpip(){
        return $this->idAmpip;
    }

    /**
     * Sets user ID.
     * @param string $idAmpip
     */
    public function setidAmpip($idAmpip){
        $this->idAmpip = $idAmpip;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets user ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns user ID.
     * @return integer
     */
    public function getkey_corp()
    { return $this->key_corp; }

    /**
     * Sets user ID.
     * @param integer $key_corp
     */
    public function setkey_corp($key_corp)
    { $this->key_corp = $key_corp; }



    /**
     * Returns user ID.
     * @return string
     */
    public function getcargo()
    { return $this->cargo; }

    /**
     * Sets user ID.
     * @param string $cargo
     */
    public function setcargo($cargo)
    { $this->cargo = $cargo; }



    /**
     * Returns user ID.
     * @return string
     */
    public function gettelefonoOfficina()
    { return $this->telefonoOfficina; }

    /**
     * Sets user ID.
     * @param string $telefonoOfficina
     */
    public function settelefonoOfficina($telefonoOfficina)
    { $this->telefonoOfficina = $telefonoOfficina; }



    /**
     * Returns user ID.
     * @return string
     */
    public function getcelular()
    { return $this->celular; }

    /**
     * Sets user ID.
     * @param string $celular
     */
    public function setcelular($celular)
    { $this->celular = $celular; }



    /**
     * Returns user ID.
     * @return string
     */
    public function getdireccionDeOfficina()
    { return $this->direccionDeOfficina; }

    /**
     * Sets user ID.
     * @param string $direccionDeOfficina
     */
    public function setdireccionDeOfficina($direccionDeOfficina)
    { $this->direccionDeOfficina = $direccionDeOfficina; }



    /**
     * Returns user ID.
     * @return string
     */
    public function getcumpleanios()
    { return $this->cumpleanios; }

    /**
     * Sets user ID.
     * @param string $cumpleanios
     */
    public function setcumpleanios($cumpleanios)
    { $this->cumpleanios = $cumpleanios; }



    /**
     * Returns user ID.
     * @return integer
     */
    public function getcompartirDatos()
    { return $this->compartirDatos; }

    /**
     * Sets user ID.
     * @param integer $compartirDatos
     */
    public function setcompartirDatos($compartirDatos)
    { $this->compartirDatos = $compartirDatos; }

    /**
     * Returns user ID.
     * @return integer
     */
    public function gethabilitar()
    { return $this->habilitar; }

    /**
     * Sets user ID.
     * @param integer $habilitar
     */
    public function sethabilitar($habilitar)
    { $this->habilitar = $habilitar; }


}