<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\inquilinoNaveRepository")
 * @ORM\Table(name="inquilino_nave")
 */

class inquilino_naveEntity
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
     * @ORM\Column(name="tipoDeNave")
     */
    protected $tipoDeNave;
    /**
     * @ORM\Column(name="nombre_es")
     */
    protected $nombre_es;
    /**
     * @ORM\Column(name="nombre_en")
     */
    protected $nombre_en;
    /**
     * @ORM\Column(name="propietario")
     */
    protected $propietario;
    /**
     * @ORM\Column(name="id_nave")
     */
    protected $id_nave;
    /**
     * @ORM\Column(name="nombreEmpresa")
     */
    protected $nombreEmpresa;
    /**
     * @ORM\Column(name="numEmpleados")
     */
    protected $numEmpleados;
    /**
     * @ORM\Column(name="paisOrigen")
     */
    protected $paisOrigen;
    /**
     * @ORM\Column(name="productoInsignia")
     */
    protected $productoInsignia;
    /**
     * @ORM\Column(name="sectorEmpresarial")
     */
    protected $sectorEmpresarial;
    /**
     * @ORM\Column(name="id_SCIAN")
     */
    protected $id_SCIAN;
    /**
     * @ORM\Column(name="id_DENUE")
     */
    protected $id_DENUE;
    /**
     * @ORM\Column(name="antiguedad")
     */
    protected $antiguedad;
    /**
     * @ORM\Column(name="isAmpip")
     */
    protected $isAmpip;

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
     * Returns tipoDeNave.
     * @return string
     */
    public function gettipoDeNave()
    {
        return $this->tipoDeNave;
    }


    /**
     * Returns nombre_es.
     * @return string
     */
    public function getnombre_es()
    {
        return $this->nombre_es;
    }


    /**
     * Returns nombre_en.
     * @return string
     */
    public function getnombre_en()
    {
        return $this->nombre_en;
    }


    /**
     * Returns propietario.
     * @return string
     */
    public function getpropietario()
    {
        return $this->propietario;
    }


    /**
     * Returns id_nave.
     * @return integer
     */
    public function getid_nave()
    {
        return $this->id_nave;
    }


    /**
     * Returns nombreEmpresa.
     * @return string
     */
    public function getnombreEmpresa()
    {
        return $this->nombreEmpresa;
    }


    /**
     * Returns numEmpleados.
     * @return string
     */
    public function getnumEmpleados()
    {
        return $this->numEmpleados;
    }


    /**
     * Returns paisOrigen.
     * @return string 
     */
    public function getpaisOrigen()
    {
        return $this->paisOrigen;
    }


    /**
     * Returns productoInsignia.
     * @return string 
     */
    public function getproductoInsignia()
    {
        return $this->productoInsignia;
    }


    /**
     * Returns sectorEmpresarial.
     * @return string 
     */
    public function getsectorEmpresarial()
    {
        return $this->sectorEmpresarial;
    }


    /**
     * Returns id_SCIAN.
     * @return string 
     */
    public function getid_SCIAN()
    {
        return $this->id_SCIAN;
    }


    /**
     * Returns id_DENUE.
     * @return string 
     */
    public function getid_DENUE()
    {
        return $this->id_DENUE;
    }


    /**
     * Returns antiguedad.
     * @return integer
     */
    public function getantiguedad()
    {
        return $this->antiguedad;
    }


    /**
     * Returns isAmpip.
     * @return string
     */
    public function getisAmpip()
    {
        return $this->isAmpip;
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
     * Sets tipoDeNave
     * @param int $tipoDeNave
     */
    public function settipoDeNave($tipoDeNave)
    {
        $this->tipoDeNave = $tipoDeNave;
    }

    /**
     * Sets nombre_es
     * @param int $nombre_es
     */
    public function setnombre_es($nombre_es)
    {
        $this->nombre_es = $nombre_es;
    }

    /**
     * Sets nombre_en
     * @param int $nombre_en
     */
    public function setnombre_en($nombre_en)
    {
        $this->nombre_en = $nombre_en;
    }

    /**
     * Sets propietario
     * @param int $propietario
     */
    public function setpropietario($propietario)
    {
        $this->propietario = $propietario;
    }

    /**
     * Sets id_nave
     * @param int $id_nave
     */
    public function setid_nave($id_nave)
    {
        $this->id_nave = $id_nave;
    }

    /**
     * Sets nombreEmpresa
     * @param int $nombreEmpresa
     */
    public function setnombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;
    }

    /**
     * Sets numEmpleados
     * @param int $numEmpleados
     */
    public function setnumEmpleados($numEmpleados)
    {
        $this->numEmpleados = $numEmpleados;
    }

    /**
     * Sets paisOrigen
     * @param int $paisOrigen
     */
    public function setpaisOrigen($paisOrigen)
    {
        $this->paisOrigen = $paisOrigen;
    }

    /**
     * Sets productoInsignia
     * @param int $productoInsignia
     */
    public function setproductoInsignia($productoInsignia)
    {
        $this->productoInsignia = $productoInsignia;
    }

    /**
     * Sets sectorEmpresarial
     * @param int $sectorEmpresarial
     */
    public function setsectorEmpresarial($sectorEmpresarial)
    {
        $this->sectorEmpresarial = $sectorEmpresarial;
    }

    /**
     * Sets id_SCIAN
     * @param int $id_SCIAN
     */
    public function setid_SCIAN($id_SCIAN)
    {
        $this->id_SCIAN = $id_SCIAN;
    }

    /**
     * Sets id_DENUE
     * @param int $id_DENUE
     */
    public function setid_DENUE($id_DENUE)
    {
        $this->id_DENUE = $id_DENUE;
    }

    /**
     * Sets antiguedad
     * @param int $antiguedad
     */
    public function setantiguedad($antiguedad)
    {
        $this->antiguedad = $antiguedad;
    }

    /**
     * Sets isAmpip
     * @param int $isAmpip
     */
    public function setisAmpip($isAmpip)
    {
        $this->isAmpip = $isAmpip;
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
