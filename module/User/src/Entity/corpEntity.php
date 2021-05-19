<?php


namespace User\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\corpRepository")
 * @ORM\Table(name="datosDelCorporativo")
 */

class corpEntity
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
     * @ORM\Column(name="nombre_es")
     */
    protected $nombre_es;
    /**
     * @ORM\Column(name="nombre_en")
     */
    protected $nombre_en;
    /**
     * @ORM\Column(name="tipoDeSocio")
     */
    protected $tipoDeSocio;
    /**
     * @ORM\Column(name="rfc")
     */
    protected $rfc;
    /**
     * @ORM\Column(name="direccion")
     */
    protected $direccion;
    /**
     * @ORM\Column(name="cp")
     */
    protected $cp;
    /**
     * @ORM\Column(name="colonia")
     */
    protected $colonia;
    /**
     * @ORM\Column(name="estado")
     */
    protected $estado;
    /**
     * @ORM\Column(name="municipio")
     */
    protected $municipio;
    /**
     * @ORM\Column(name="celular")
     */
    protected $celular;
    /**
     * @ORM\Column(name="logo")
     */
    protected $logo;
    /**
     * @ORM\Column(name="inversionAnualSiguiente")
     */
    protected $inversionAnualSiguiente;
    /**
     * @ORM\Column(name="inversionRealizadaActual")
     */
    protected $inversionRealizadaActual;
    /**
     * @ORM\Column(name="inversionRealizadaAnterior")
     */
    protected $inversionRealizadaAnterior;
    /**
     * @ORM\Column(name="validadoPor")
     */
    protected $validadoPor;
    /**
     * @ORM\Column(name="fechaDeValidacion")
     */
    protected $fechaDeValidacion;
    /**
     * @ORM\Column(name="fechaDeAlta")
     */
    protected $fechaDeAlta;
    /**
     * @ORM\Column(name="fechaDeBaja")
     */
    protected $fechaDeBaja;
    /**
     * @ORM\Column(name="status")
     */
    protected $status;
    /**
     * @ORM\Column(name="habilitar")
     */
    protected $habilitar;


    /**
     * Returns id.
     * @return  integer
     */
    public function getid(){ return $this->id;}


    /**
     * Returns corporativo.
     * @return  string
     */
    public function getcorporativo(){ return $this->corporativo;}


    /**
     * Returns nombre_es.
     * @return string
     */
    public function getnombre_es(){ return $this->nombre_es;}


    /**
     * Returns nombre_en.
     * @return string
     */
    public function getnombre_en(){ return $this->nombre_en;}


    /**
     * Returns tipoDeSocio.
     * @return string
     */
    public function gettipoDeSocio(){ return $this->tipoDeSocio;}


    /**
     * Returns rfc.
     * @return string
     */
    public function getrfc(){ return $this->rfc;}


    /**
     * Returns direccion.
     * @return string
     */
    public function getdireccion(){ return $this->direccion;}


    /**
     * Returns cp.
     * @return integer
     */
    public function getcp(){ return $this->cp;}


    /**
     * Returns colonia.
     * @return string
     */
    public function getcolonia(){ return $this->colonia;}


    /**
     * Returns estado.
     * @return string
     */
    public function getestado(){ return $this->estado;}


    /**
     * Returns municipio.
     * @return string
     */
    public function getmunicipio(){ return $this->municipio;}


    /**
     * Returns celular.
     * @return string
     */
    public function getcelular(){ return $this->celular;}


    /**
     * Returns logo.
     * @return string
     */
    public function getlogo(){ return $this->logo;}


    /**
     * Returns inversionAnualSiguiente.
     * @return string
     */
    public function getinversionAnualSiguiente(){ return $this->inversionAnualSiguiente;}


    /**
     * Returns inversionRealizadaActual.
     * @return string
     */
    public function getinversionRealizadaActual(){ return $this->inversionRealizadaActual;}


    /**
     * Returns inversionRealizadaAnterior.
     * @return string
     */
    public function getinversionRealizadaAnterior(){ return $this->inversionRealizadaAnterior;}


    /**
     * Returns validadoPor.
     * @return string
     */
    public function getvalidadoPor(){ return $this->validadoPor;}


    /**
     * Returns fechaDeValidacion.
     * @return string
     */
    public function getfechaDeValidacion(){ return $this->fechaDeValidacion;}


    /**
     * Returns fechaDeAlta.
     * @return string
     */
    public function getfechaDeAlta(){ return $this->fechaDeAlta;}


    /**
     * Returns fechaDeBaja.
     * @return string
     */
    public function getfechaDeBaja(){ return $this->fechaDeBaja;}


    /**
     * Returns status.
     * @return string
     */
    public function getstatus(){ return $this->status;}


    /**
     * Returns habilitar.
     * @return string
     */
    public function gethabilitar(){ return $this->habilitar;}




    /**
     * Sets id
     * @param int $id
     */
    public function setid($id){$this->id = $id;}

    /**
     * Sets corporativo
     * @param string $corporativo
     */
    public function setcorporativo($corporativo){$this->corporativo = $corporativo;}

    /**
     * Sets nombre_es
     * @param string $nombre_es
     */
    public function setnombre_es($nombre_es){$this->nombre_es = $nombre_es;}

    /**
     * Sets nombre_en
     * @param string $nombre_en
     */
    public function setnombre_en($nombre_en){$this->nombre_en = $nombre_en;}

    /**
     * Sets tipoDeSocio
     * @param string $tipoDeSocio
     */
    public function settipoDeSocio($tipoDeSocio){$this->tipoDeSocio = $tipoDeSocio;}

    /**
     * Sets rfc
     * @param string $rfc
     */
    public function setrfc($rfc){$this->rfc = $rfc;}

    /**
     * Sets direccion
     * @param string $direccion
     */
    public function setdireccion($direccion){$this->direccion = $direccion;}

    /**
     * Sets cp
     * @param int $cp
     */
    public function setcp($cp){$this->cp = $cp;}

    /**
     * Sets colonia
     * @param string $colonia
     */
    public function setcolonia($colonia){$this->colonia = $colonia;}

    /**
     * Sets estado
     * @param string $estado
     */
    public function setestado($estado){$this->estado = $estado;}

    /**
     * Sets municipio
     * @param string $municipio
     */
    public function setmunicipio($municipio){$this->municipio = $municipio;}

    /**
     * Sets celular
     * @param string $celular
     */
    public function setcelular($celular){$this->celular = $celular;}

    /**
     * Sets logo
     * @param string $logo
     */
    public function setlogo($logo){$this->logo = $logo;}

    /**
     * Sets inversionAnualSiguiente
     * @param string $inversionAnualSiguiente
     */
    public function setinversionAnualSiguiente($inversionAnualSiguiente){$this->inversionAnualSiguiente = $inversionAnualSiguiente;}

    /**
     * Sets inversionRealizadaActual
     * @param string $inversionRealizadaActual
     */
    public function setinversionRealizadaActual($inversionRealizadaActual){$this->inversionRealizadaActual = $inversionRealizadaActual;}

    /**
     * Sets inversionRealizadaAnterior
     * @param string $inversionRealizadaAnterior
     */
    public function setinversionRealizadaAnterior($inversionRealizadaAnterior){$this->inversionRealizadaAnterior = $inversionRealizadaAnterior;}

    /**
     * Sets validadoPor
     * @param string $validadoPor
     */
    public function setvalidadoPor($validadoPor){$this->validadoPor = $validadoPor;}

    /**
     * Sets fechaDeValidacion
     * @param string $fechaDeValidacion
     */
    public function setfechaDeValidacion($fechaDeValidacion){$this->fechaDeValidacion = $fechaDeValidacion;}

    /**
     * Sets fechaDeAlta
     * @param string $fechaDeAlta
     */
    public function setfechaDeAlta($fechaDeAlta){$this->fechaDeAlta = $fechaDeAlta;}

    /**
     * Sets fechaDeBaja
     * @param string $fechaDeBaja
     */
    public function setfechaDeBaja($fechaDeBaja){$this->fechaDeBaja = $fechaDeBaja;}

    /**
     * Sets status
     * @param string $status
     */
    public function setstatus($status){$this->status = $status;}

    /**
     * Sets habilitar
     * @param string $habilitar
     */
    public function sethabilitar($habilitar){$this->habilitar = $habilitar;}

}