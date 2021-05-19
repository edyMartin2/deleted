<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\espacioDisponibleRepository")
 * @ORM\Table(name="espacio_disponible")
 */

class espacio_disponibleEntity
{


    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(name="corporativo")
     */
    protected $corporativo;
    /**
     * @ORM\Column(name="ubicacion")
     */
    protected $ubicacion;
    /**
     * @ORM\Column(name="tipo")
     */
    protected $tipo;
    /**
     * @ORM\Column(name="tipoDeDispo")
     */
    protected $tipoDeDispo;
    /**
     * @ORM\Column(name="uso")
     */
    protected $uso;
    /**
     * @ORM\Column(name="municipio")
     */
    protected $municipio;
    /**
     * @ORM\Column(name="estado")
     */
    protected $estado;
    /**
     * @ORM\Column(name="web")
     */
    protected $web;
    /**
     * @ORM\Column(name="contacto")
     */
    protected $contacto;
    /**
     * @ORM\Column(name="precioPromedio")
     */
    protected $precioPromedio;
    /**
     * @ORM\Column(name="datoDeContacto")
     */
    protected $datoDeContacto;
    /**
     * @ORM\Column(name="id_parque")
     */
    protected $id_parque;
    /**
     * @ORM\Column(name="medidaX")
     */
    protected $medidaX;
    /**
     * @ORM\Column(name="medidaY")
     */
    protected $medidaY;
    /**
     * @ORM\Column(name="medidaZ")
     */
    protected $medidaZ;


    /**
     * Returns id.
     * @return integer
     */
    public function getid()
    {
        return $this->id;
    }


    /**
     * Returns corporativo.
     * @return string 
     */
    public function getcorporativo()
    {
        return $this->corporativo;
    }


    /**
     * Returns medidaX.
     * @return string
     */

    function getmedidaX(){return $this->medidaX;}
    /**
     * Returns medidaY.
     * @return string
     */

    function getmedidaY(){ return $this->medidaY;}
    /**
     * Returns medidaZ.
     * @return string
     */

    function getmedidaZ(){return $this->medidaZ;}

    /**
     * Returns ubicacion.
     * @return string 
     */
    public function getubicacion()
    {
        return $this->ubicacion;
    }


    /**
     * Returns tipo.
     * @return string 
     */
    public function gettipo()
    {
        return $this->tipo;
    }


    /**
     * Returns tipoDeDispo.
     * @return string 
     */
    public function gettipoDeDispo()
    {
        return $this->tipoDeDispo;
    }


    /**
     * Returns uso.
     * @return string 
     */
    public function getuso()
    {
        return $this->uso;
    }


    /**
     * Returns municipio.
     * @return string 
     */
    public function getmunicipio()
    {
        return $this->municipio;
    }


    /**
     * Returns estado.
     * @return string 
     */
    public function getestado()
    {
        return $this->estado;
    }


    /**
     * Returns web.
     * @return string 
     */
    public function getweb()
    {
        return $this->web;
    }


    /**
     * Returns contacto.
     * @return string 
     */
    public function getcontacto()
    {
        return $this->contacto;
    }


    /**
     * Returns precioPromedio.
     * @return integer 
     */
    public function getprecioPromedio()
    {
        return $this->precioPromedio;
    }


    /**
     * Returns datoDeContacto.
     * @return string 
     */
    public function getdatoDeContacto()
    {
        return $this->datoDeContacto;
    }


    /**
     * Returns id_parque.
     * @return integer
     */
    public function getid_parque()
    {
        return $this->id_parque;
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
     * Sets corporativo
     * @param int $corporativo
     */
    public function setcorporativo($corporativo)
    {
        $this->corporativo = $corporativo;
    }

    /**
     * Sets ubicacion
     * @param int $ubicacion
     */
    public function setubicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    /**
     * Sets tipo
     * @param int $tipo
     */
    public function settipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Sets tipoDeDispo
     * @param int $tipoDeDispo
     */
    public function settipoDeDispo($tipoDeDispo)
    {
        $this->tipoDeDispo = $tipoDeDispo;
    }

    /**
     * Sets uso
     * @param int $uso
     */
    public function setuso($uso)
    {
        $this->uso = $uso;
    }

    /**
     * Sets municipio
     * @param int $municipio
     */
    public function setmunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    /**
     * Sets estado
     * @param int $estado
     */
    public function setestado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Sets web
     * @param int $web
     */
    public function setweb($web)
    {
        $this->web = $web;
    }

    /**
     * Sets contacto
     * @param int $contacto
     */
    public function setcontacto($contacto)
    {
        $this->contacto = $contacto;
    }

    /**
     * Sets precioPromedio
     * @param int $precioPromedio
     */
    public function setprecioPromedio($precioPromedio)
    {
        $this->precioPromedio = $precioPromedio;
    }

    /**
     * Sets datoDeContacto
     * @param int $datoDeContacto
     */
    public function setdatoDeContacto($datoDeContacto)
    {
        $this->datoDeContacto = $datoDeContacto;
    }

    /**
     * Sets id_parque
     * @param int $id_parque
     */
    public function setid_parque($id_parque)
    {
        $this->id_parque = $id_parque;
    }

    /**
     * Sets isAmpip
     * @param int $medidaX
     */
    public function setmedidaX($medidaX){ $this->medidaX = $medidaX; }

    /**
     * Sets isAmpip
     * @param int $medidaY
     */
    public function setmedidaY($medidaY){ $this->medidaY = $medidaY; }


    /**
     * Sets isAmpip
     * @param int $medidaX
     */
    public function setmedidaZ($medidaZ){ $this->medidaZ = $medidaZ; }
}
