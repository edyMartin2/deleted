<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered prueba.
 * @ORM\Entity(repositoryClass="\User\Repository\parqueRepository")
 * @ORM\Table(name="parque")
 */

class parqueEntity
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
                         * @ORM\Column(name="key_user")
                         */
                     protected $key_user;
                         /**
                         * @ORM\Column(name="nombre_es")
                         */
                     protected $nombre_es;
                         /**
                         * @ORM\Column(name="nombre_en")
                         */
                     protected $nombre_en;
                         /**
                         * @ORM\Column(name="adminParq")
                         */
                     protected $adminParq;
                         /**
                         * @ORM\Column(name="parqProp")
                         */
                     protected $parqProp;
                         /**
                         * @ORM\Column(name="parqIntoParq")
                         */
                     protected $parqIntoParq;
                         /**
                         * @ORM\Column(name="region")
                         */
                     protected $region;
                         /**
                         * @ORM\Column(name="mercado")
                         */
                     protected $mercado;
                         /**
                         * @ORM\Column(name="tipoDeIndustria")
                         */
                     protected $tipoDeIndustria;
                         /**
                         * @ORM\Column(name="superficieTotal")
                         */
                     protected $superficieTotal;
                         /**
                         * @ORM\Column(name="superficieUrban")
                         */
                     protected $superficieUrban;
                         /**
                         * @ORM\Column(name="superficieOcup")
                         */
                     protected $superficieOcup;
                         /**
                         * @ORM\Column(name="superficieDisp")
                         */
                     protected $superficieDisp;
                         /**
                         * @ORM\Column(name="tipoDePropiedad")
                         */
                     protected $tipoDePropiedad;
                         /**
                         * @ORM\Column(name="inicioOperaciones")
                         */
                     protected $inicioOperaciones;
                         /**
                         * @ORM\Column(name="numEmpleados")
                         */
                     protected $numEmpleados;
                         /**
                         * @ORM\Column(name="reconocimientoPracticas")
                         */
                     protected $reconocimientoPracticas;
                         /**
                         * @ORM\Column(name="ifraestructura")
                         */
                     protected $ifraestructura;
                         /**
                         * @ORM\Column(name="numeroDeNaves")
                         */
                     protected $numeroDeNaves;
                         /**
                         * @ORM\Column(name="observacion")
                         */
                     protected $observacion;
                         /**
                         * @ORM\Column(name="kmz")
                         */
                     protected $kmz;
                         /**
                         * @ORM\Column(name="planMaestro")
                         */
                     protected $planMaestro;
                         /**
                         * @ORM\Column(name="contactName")
                         */
                     protected $contactName;
                         /**
                         * @ORM\Column(name="contactEmail")
                         */
                     protected $contactEmail;

    
                        /**
                         * Returns id.
                         * @return integer
                         */
                        public function getid(){ return $this->id;}

                        
                        /**
                         * Returns key_corp.
                         * @return integer
                         */
                        public function getkey_corp(){ return $this->key_corp;}

                        
                        /**
                         * Returns key_user.
                         * @return integer
                         */
                        public function getkey_user(){ return $this->key_user;}

                        
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
                         * Returns adminParq.
                         * @return string
                         */
                        public function getadminParq(){ return $this->adminParq;}

                        
                        /**
                         * Returns parqProp.
                         * @return integer
                         */
                        public function getparqProp(){ return $this->parqProp;}

                        
                        /**
                         * Returns parqIntoParq.
                         * @return integer
                         */
                        public function getparqIntoParq(){ return $this->parqIntoParq;}

                        
                        /**
                         * Returns region.
                         * @return string
                         */
                        public function getregion(){ return $this->region;}

                        
                        /**
                         * Returns mercado.
                         * @return string
                         */
                        public function getmercado(){ return $this->mercado;}

                        
                        /**
                         * Returns tipoDeIndustria.
                         * @return string
                         */
                        public function gettipoDeIndustria(){ return $this->tipoDeIndustria;}

                        
                        /**
                         * Returns superficieTotal.
                         * @return string
                         */
                        public function getsuperficieTotal(){ return $this->superficieTotal;}

                        
                        /**
                         * Returns superficieUrban.
                         * @return string
                         */
                        public function getsuperficieUrban(){ return $this->superficieUrban;}

                        
                        /**
                         * Returns superficieOcup.
                         * @return string
                         */
                        public function getsuperficieOcup(){ return $this->superficieOcup;}

                        
                        /**
                         * Returns superficieDisp.
                         * @return string
                         */
                        public function getsuperficieDisp(){ return $this->superficieDisp;}

                        
                        /**
                         * Returns tipoDePropiedad.
                         * @return string
                         */
                        public function gettipoDePropiedad(){ return $this->tipoDePropiedad;}

                        
                        /**
                         * Returns inicioOperaciones.
                         * @return string
                         */
                        public function getinicioOperaciones(){ return $this->inicioOperaciones;}

                        
                        /**
                         * Returns numEmpleados.
                         * @return string
                         */
                        public function getnumEmpleados(){ return $this->numEmpleados;}

                        
                        /**
                         * Returns reconocimientoPracticas.
                         * @return string
                         */
                        public function getreconocimientoPracticas(){ return $this->reconocimientoPracticas;}

                        
                        /**
                         * Returns ifraestructura.
                         * @return string
                         */
                        public function getifraestructura(){ return $this->ifraestructura;}

                        
                        /**
                         * Returns numeroDeNaves.
                         * @return integer
                         */
                        public function getnumeroDeNaves(){ return $this->numeroDeNaves;}

                        
                        /**
                         * Returns observacion.
                         * @return string
                         */
                        public function getobservacion(){ return $this->observacion;}

                        
                        /**
                         * Returns kmz.
                         * @return string
                         */
                        public function getkmz(){ return $this->kmz;}

                        
                        /**
                         * Returns planMaestro.
                         * @return string
                         */
                        public function getplanMaestro(){ return $this->planMaestro;}

                        
                        /**
                         * Returns contactName.
                         * @return string
                         */
                        public function getcontactName(){ return $this->contactName;}

                        
                        /**
                         * Returns contactEmail.
                         * @return string
                         */
                        public function getcontactEmail(){ return $this->contactEmail;}

                        

    
                        /**
                         * Sets id
                         * @param int $id
                         */
                        public function setid($id){$this->id = $id;}
                        
                        /**
                         * Sets key_corp
                         * @param int $key_corp
                         */
                        public function setkey_corp($key_corp){$this->key_corp = $key_corp;}
                        
                        /**
                         * Sets key_user
                         * @param int $key_user
                         */
                        public function setkey_user($key_user){$this->key_user = $key_user;}
                        
                        /**
                         * Sets nombre_es
                         * @param int $nombre_es
                         */
                        public function setnombre_es($nombre_es){$this->nombre_es = $nombre_es;}
                        
                        /**
                         * Sets nombre_en
                         * @param int $nombre_en
                         */
                        public function setnombre_en($nombre_en){$this->nombre_en = $nombre_en;}
                        
                        /**
                         * Sets adminParq
                         * @param int $adminParq
                         */
                        public function setadminParq($adminParq){$this->adminParq = $adminParq;}
                        
                        /**
                         * Sets parqProp
                         * @param int $parqProp
                         */
                        public function setparqProp($parqProp){$this->parqProp = $parqProp;}
                        
                        /**
                         * Sets parqIntoParq
                         * @param int $parqIntoParq
                         */
                        public function setparqIntoParq($parqIntoParq){$this->parqIntoParq = $parqIntoParq;}
                        
                        /**
                         * Sets region
                         * @param int $region
                         */
                        public function setregion($region){$this->region = $region;}
                        
                        /**
                         * Sets mercado
                         * @param int $mercado
                         */
                        public function setmercado($mercado){$this->mercado = $mercado;}
                        
                        /**
                         * Sets tipoDeIndustria
                         * @param int $tipoDeIndustria
                         */
                        public function settipoDeIndustria($tipoDeIndustria){$this->tipoDeIndustria = $tipoDeIndustria;}
                        
                        /**
                         * Sets superficieTotal
                         * @param int $superficieTotal
                         */
                        public function setsuperficieTotal($superficieTotal){$this->superficieTotal = $superficieTotal;}
                        
                        /**
                         * Sets superficieUrban
                         * @param int $superficieUrban
                         */
                        public function setsuperficieUrban($superficieUrban){$this->superficieUrban = $superficieUrban;}
                        
                        /**
                         * Sets superficieOcup
                         * @param int $superficieOcup
                         */
                        public function setsuperficieOcup($superficieOcup){$this->superficieOcup = $superficieOcup;}
                        
                        /**
                         * Sets superficieDisp
                         * @param int $superficieDisp
                         */
                        public function setsuperficieDisp($superficieDisp){$this->superficieDisp = $superficieDisp;}
                        
                        /**
                         * Sets tipoDePropiedad
                         * @param int $tipoDePropiedad
                         */
                        public function settipoDePropiedad($tipoDePropiedad){$this->tipoDePropiedad = $tipoDePropiedad;}
                        
                        /**
                         * Sets inicioOperaciones
                         * @param int $inicioOperaciones
                         */
                        public function setinicioOperaciones($inicioOperaciones){$this->inicioOperaciones = $inicioOperaciones;}
                        
                        /**
                         * Sets numEmpleados
                         * @param int $numEmpleados
                         */
                        public function setnumEmpleados($numEmpleados){$this->numEmpleados = $numEmpleados;}
                        
                        /**
                         * Sets reconocimientoPracticas
                         * @param int $reconocimientoPracticas
                         */
                        public function setreconocimientoPracticas($reconocimientoPracticas){$this->reconocimientoPracticas = $reconocimientoPracticas;}
                        
                        /**
                         * Sets ifraestructura
                         * @param int $ifraestructura
                         */
                        public function setifraestructura($ifraestructura){$this->ifraestructura = $ifraestructura;}
                        
                        /**
                         * Sets numeroDeNaves
                         * @param int $numeroDeNaves
                         */
                        public function setnumeroDeNaves($numeroDeNaves){$this->numeroDeNaves = $numeroDeNaves;}
                        
                        /**
                         * Sets observacion
                         * @param int $observacion
                         */
                        public function setobservacion($observacion){$this->observacion = $observacion;}
                        
                        /**
                         * Sets kmz
                         * @param int $kmz
                         */
                        public function setkmz($kmz){$this->kmz = $kmz;}
                        
                        /**
                         * Sets planMaestro
                         * @param int $planMaestro
                         */
                        public function setplanMaestro($planMaestro){$this->planMaestro = $planMaestro;}
                        
                        /**
                         * Sets contactName
                         * @param int $contactName
                         */
                        public function setcontactName($contactName){$this->contactName = $contactName;}
                        
                        /**
                         * Sets contactEmail
                         * @param int $contactEmail
                         */
                        public function setcontactEmail($contactEmail){$this->contactEmail = $contactEmail;}
                        

}