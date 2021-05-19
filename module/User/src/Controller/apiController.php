<?php

namespace User\Controller;

use User\Entity\mapsEntity;
use User\Entity\corpEntity;
use User\Entity\datosDeUsuarioEntity;
use User\Entity\espacio_disponibleEntity;
use User\Entity\inquilino_naveEntity;
use User\Entity\logEntity;
use User\Entity\naveEntity;
use User\Entity\parqueEntity;
use User\Entity\parquesuserEntity;
use User\Entity\userEntity;
use User\Entity\Role;
use User\Entity\userRole;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;


class apiController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private $url;

    public function __construct($entityManager)
    {
        $this->url = "http://localhost:8000/panel/#/";
        $this->entityManager = $entityManager;
    }

    //******************SOLO PERMISOS*********************

    public function getPermision($id)
    {
        $permision = $this->entityManager->getRepository(userRole::class)->findBy(['user_id' => $id]);
        $result = [];

        foreach ($permision as $role) {
            if ($role->getId() != "") {
                $result["role_id"] = $role->getRoleId();
            } else {
                $result["error"] = 0;
            }
        }
        $getType = $this->entityManager->getRepository(Role::class)->findById($result["role_id"]);
        $result = [];

        foreach ($getType as $role) {
            if ($role->getId() != "") {
                $result["name"] = $role->getName();
            } else {
                $result["error"] = 0;
            }
        }
        return $result;
    }

    public function getcargo($id)
    {
        //$id = $this->params()->fromPost('id', '');
        $id_user = $this->entityManager->getRepository(userEntity::class)->findById($id);

        $list = [];
        foreach ($id_user as $ids) {
            $list["ids"] = $ids->gettypeOfUser();
        }

        $search_cargo = $this->entityManager->getRepository(Role::class)->findById($list["ids"]);

        $cargos = [];
        foreach ($search_cargo as $cargo) {
            $cargos["cargo"] = $cargo->getName();
        }
        return $cargos["cargo"];
    }

    public function  getparquesusuariosAction()
    {
        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost("id", 2);
            $permisos = $this->entityManager->getRepository(parquesuserEntity::class)->findBy(["persona" => $id]);
            $arr = array();
            $rolepermisos = [];

            foreach ($permisos as $permiso) {
                $rolepermisos["permiso"] = $permiso->getpermiso();
                array_push($arr, $rolepermisos);
            }

            return new JsonModel($arr);
        } else {
            return new JsonModel(["message" => "ruta post"]);
        }
    }
    /*
     * datosDelCorporativo CRUD
     *
     */
    public function corpAction()
    {
        if ($this->getRequest()->isPost()) {

            if ($this->getRequest()->isPost()) {
                $identify = $this->params()->fromPost('id', '');
                $response = $this->entityManager->getRepository(corpEntity::class)->findById($identify);
                $result = [];
                foreach ($response as $role) {
                    if ($role->getId() != "") {
                        $result["id"] = $role->getid();
                        $result["corporativo"] = $role->getcorporativo();
                        $result["nombre_es"] = $role->getnombre_es();
                        $result["nombre_en"] = $role->getnombre_en();
                        $result["tipoDeSocio"] = $role->gettipoDeSocio();
                        $result["rfc"] = $role->getrfc();
                        $result["direccion"] = $role->getdireccion();
                        $result["cp"] = $role->getcp();
                        $result["colonia"] = $role->getcolonia();
                        $result["estado"] = $role->getestado();
                        $result["municipio"] = $role->getmunicipio();
                        $result["celular"] = $role->getcelular();
                        $result["logo"] = $role->getlogo();
                        $result["inversionAnualSiguiente"] = $role->getinversionAnualSiguiente();
                        $result["inversionRealizadaActual"] = $role->getinversionRealizadaActual();
                        $result["inversionRealizadaAnterior"] = $role->getinversionRealizadaAnterior();
                        $result["validadoPor"] = $role->getvalidadoPor();
                        $result["fechaDeValidacion"] = $role->getfechaDeValidacion();
                        $result["fechaDeAlta"] = $role->getfechaDeAlta();
                        $result["fechaDeBaja"] = $role->getfechaDeBaja();
                        $result["status"] = $role->getstatus();
                        $result["habilitar"] = $role->gethabilitar();
                    } else {
                        $result["error"] = "2541";
                    }
                }

                return new JsonModel($result);
            } else {
                return $this->redirect()->toUrl(
                    $this->url
                );
            }
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //admin permisos
    public function createcorpAction()
    {
        if ($this->getRequest()->isPost()) {
            $corporativo = $this->params()->fromPost("corporativo", "");
            $nombre_es = $this->params()->fromPost("nombre_es", "");
            $nombre_en = $this->params()->fromPost("nombre_en", "");
            $tipoDeSocio = $this->params()->fromPost("tipoDeSocio", "");
            $rfc = $this->params()->fromPost("rfc", "");
            $direccion = $this->params()->fromPost("direccion", "");
            $cp = $this->params()->fromPost("cp", "");
            $colonia = $this->params()->fromPost("colonia", "");
            $estado = $this->params()->fromPost("estado", "");
            $municipio = $this->params()->fromPost("municipio", "");
            $telefono = $this->params()->fromPost("telefono", "");
            $logo = $this->params()->fromPost("logo", "");
            $inversionAnualSiguiente = $this->params()->fromPost("inversionAnualSiguiente", "");
            $inversionRealizadaActual = $this->params()->fromPost("inversionRealizadaActual", "");
            $inversionRealizadaAnterior = $this->params()->fromPost("inversionRealizadaAnterior", "");
            $validadoPor = $this->params()->fromPost("validadoPor", "");
            $status = $this->params()->fromPost("status", "");
            $habilitar = $this->params()->fromPost("habilitar", "");

            $idDeUsuario = $this->params()->fromPost("id", null);

            $isDispo = $this->entityManager->getRepository(corpEntity::class)->findBy(['rfc' => $rfc]);


            if ($isDispo == null) {
                $corporativoNew = new corpEntity();
                $corporativoNew->setcorporativo($corporativo);
                $corporativoNew->setnombre_es($nombre_es);
                $corporativoNew->setnombre_en($nombre_en);
                $corporativoNew->settipoDeSocio($tipoDeSocio);
                $corporativoNew->setrfc($rfc);
                $corporativoNew->setdireccion($direccion);
                $corporativoNew->setcp($cp);
                $corporativoNew->setcolonia($colonia);
                $corporativoNew->setestado($estado);
                $corporativoNew->setmunicipio($municipio);
                $corporativoNew->setcelular($telefono);
                $corporativoNew->setlogo($logo);
                $corporativoNew->setinversionAnualSiguiente($inversionAnualSiguiente);
                $corporativoNew->setinversionRealizadaActual($inversionRealizadaActual);
                $corporativoNew->setinversionRealizadaAnterior($inversionRealizadaAnterior);
                $corporativoNew->setvalidadoPor($validadoPor);
                $corporativoNew->setfechaDeValidacion(date('Y-m-d H:i:s'));
                $corporativoNew->setstatus($status);
                $corporativoNew->sethabilitar($habilitar);
                $this->entityManager->persist($corporativoNew);
                $this->entityManager->flush();

                $getId = $this->entityManager->getRepository(corpEntity::class)->findBy(["rfc" => $rfc]);

                $idKey_corp = [];
                foreach ($getId as $i) {
                    $idKey_corp["id"] = $i->getId();
                }

                $update = $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".key_corp", $idKey_corp["id"], $idDeUsuario);


                return new JsonModel(["message", "listo"]);
            } else {
                return new JsonModel(["message" => "El usuario " . $rfc . " ya tiene una cuenta"]);
            }
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //admin permisos
    public function updatecorpAction()
    {
        if ($this->getRequest()->isPost()) {
            //Id del usuario que edita
            $id = $this->params()->fromPost("id");
            $id_key = $this->params()->fromPost("id_key", "");
            $permiso = $this->getPermision($id);
            if ($permiso['name'] == "Administrator") {
                //id del corporativo no cambiable

                $nombre_es = $this->params()->fromPost("nombre_es", null);
                $nombre_en = $this->params()->fromPost("nombre_en", null);
                $direccion = $this->params()->fromPost("direccion", null);
                $cp = $this->params()->fromPost("cp", null);
                $colonia = $this->params()->fromPost("colonia", null);
                $estado = $this->params()->fromPost("estado", null);
                $municipio = $this->params()->fromPost("municipio", null);
                $telefono = $this->params()->fromPost("telefono", null);
                $inversionAnualSiguiente = $this->params()->fromPost("inversionAnualSiguiente", null);
                $habilitar = $this->params()->fromPost("habilitar", null);
                $search = $this->entityManager->getRepository(corpEntity::class)->findById($id_key);

                if ($search != null) {
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".nombre_es", $nombre_es, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".nombre_en", $nombre_en, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".direccion", $direccion, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".cp", $cp, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".colonia", $colonia, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".estado", $estado, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".municipio", $municipio, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".celular", $telefono, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".inversionAnualSiguiente", $inversionAnualSiguiente, $id_key);
                    $this->entityManager->getRepository(corpEntity::class)->updateUser(".habilitar", $habilitar, $id_key);
                    $this->logs("El usuario con id $id actualizo la corporacion con id  $id_key", $id);
                    return new JsonModel(["message" => "listo"]);
                } else {
                    $this->logs("El usuario con id $id intento actualizar la corporacion con id  $id_key", $id);
                    return new JsonModel(["message" => "corporacion no encontrada"]);
                }
            } else {
                $this->logs("El usuario con id $id intento actualizar la corṕoracion con id   $id_key pero no tiene suficientes permisos", $id);
                return new JsonModel(["message" => "permiso insuficiente"]);
            }
        } else {
            $this->logs("se intento acceder a la ruta mediante get", 0);
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function getallcorpsAction()
    {
        if ($this->getRequest()->isPost()) {
            $corps = $this->entityManager->getRepository(corpEntity::class)->findAll();
            $arregloCorps = array();
            $listCorps = [];
            foreach ($corps as $item) {
                $listCorps['id'] = $item->getid();
                $listCorps['rfc'] = $item->getrfc();
                $listCorps['name'] = $item->getnombre_es();
                $listCorps['status'] = $item->getstatus();

                array_push($arregloCorps, $listCorps);
            }
            $this->logs("Se obtubieron todas las corporaciones", "ADMIN");
            return new JsonModel($arregloCorps);
        } else {
            $this->logs("Se intento acceder a la ruta obtener corporaciones", "desc");
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function getallusercorpAction()
    {
        if ($this->getRequest()->isPost()) {
            $users = $this->entityManager->getRepository(userEntity::class)->findAll();

            $arregloUsuario = array();
            $listUsuario = [];

            foreach ($users as $item) {
                $listUsuario['id'] = $item->getId();
                $listUsuario['email'] = $item->getEmail();
                $listUsuario['name'] = $item->getFullName();

                array_push($arregloUsuario, $listUsuario);
            }
            $this->logs("Se obtubieron todos los usuarios", "ADMIN");
            return new JsonModel($arregloUsuario);
        } else {
            $this->logs("Se intento obtener uruarios por el metodo get", "desc");
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    /*
     * usuario CRUD
     *
     */
    public function loginAction()
    {
        if ($this->getRequest()->isPost()) {

            $email = $this->params()->fromPost('email', 'q');
            $pass = $this->params()->fromPost('pass', 'q');
            $decryptPass = $this->encript("enc", $pass, "4MP1P");
            $response = $this->entityManager->getRepository(userEntity::class)->findBy(['email' => $email, 'password' => $decryptPass, 'status' => 1]);
            $roleList = [];
            foreach ($response as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getId();
                    $roleList["name"] = $role->getFullName();
                    $roleList["email"] = $role->getEmail();
                    $roleList["userForAmpip"] = $role->getuseForAmpi();
                    $roleList["cargo"] = $role->gettypeOfUser();
                } else {
                    $roleList["error"] = "Usuario no reconocido comunicate con ampip por si el usuario aun no esta registrado";
                }
            }
            $this->logs("el usuario $email inicio secion", $email);
            return new JsonModel([$roleList]);
        } else {
            $this->logs("Se intento hacer login por get", "desc");
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //admin permisos
    public function createuserAction()
    {

        if ($this->getRequest()->isPost()) {
            $email = $this->params()->fromPost("email", "");
            $fullName = $this->params()->fromPost("fullname", "");
            $pass = $this->params()->fromPost("pass", "");
            $userForAmpip = $this->params()->fromPost("useForAmpi");
            $typeOfUser = $this->params()->fromPost("typeOfUser");
            $user = $this->entityManager->getRepository(userEntity::class)->findBy(['email' => $email]);


            if ($user == null) {
                $news = new userEntity();
                $news->setEmail($email);
                $news->setFullName($fullName);
                $news->setPassword($this->encript("enc", $pass, "4MP1P"));
                $news->setStatus(0);
                $news->setDateCreated(date('Y-m-d H:i:s'));
                $news->settypeOfUser(intval($typeOfUser));
                $news->setuseForAmpi(intval($userForAmpip));


                // Add the entity to the entity manager.
                $this->entityManager->persist($news);

                // Apply changes to database.
                $this->entityManager->flush();

                //crear la liga del usuario con su rol o tipo de usuario
                $idOfUser = $this->entityManager->getRepository(userEntity::class)->findBy(["email" => $email]);
                $id = null;

                foreach ($idOfUser as $user) {
                    $id = $user->getId();
                }
                if ($id != null) {
                    $role = new userRole();
                    $role->setUserid($id);
                    $role->setRoleid(4);
                    // Add the entity to the entity manager.
                    $this->entityManager->persist($role);

                    // Apply changes to database.
                    $this->entityManager->flush();
                }
                $this->logs("Se dio de alta al usuario $email", $email);
                return new JsonModel(["message" => 1]);
            } else {
                $this->logs("Se intento dar de alta al usuario $email", $email);
                return new JsonModel(["message" => "el usuario " . $email . " ya tiene una cuenta"]);
            }
        } else {
            $this->logs("se intento acceder a la ruta altaUsuarios con get", "desc");
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //cualquier usuario podra editarlo
    public function updateuserAction()
    {
        if ($this->getRequest()->isPost()) {

            $id = $this->params()->fromPost("id", "");
            $email = $this->params()->fromPost("email", "");
            $full_name = $this->params()->fromPost("full_name", "");
            $password = $this->params()->fromPost("password", "");
            $status = $this->params()->fromPost("status", "");
            $passwordResetToken = $this->params()->fromPost("passwordResetToken", "");

            $user = $this->entityManager->getRepository(userEntity::class)->findById($id);
            if ($user != null) {
                $this->entityManager->getRepository(userEntity::class)->updateUser(".email", $email, $id);
                $this->entityManager->getRepository(userEntity::class)->updateUser(".password", $this->encript("enc", $password, "4MP1P"), $id);
                $this->entityManager->getRepository(userEntity::class)->updateUser(".fullName", $full_name, $id);
                $this->entityManager->getRepository(userEntity::class)->updateUser(".status", $status, $id);
                //passwordResetToken  typeOfUser
                $this->entityManager->getRepository(userEntity::class)->updateUser(".passwordResetToken", $passwordResetToken, $id);
                $this->entityManager->getRepository(userEntity::class)->updateUser(".passwordResetTokenCreationDate", date('Y-m-d H:i:s'), $id);
                //$this->entityManager->getRepository(userEntity::class)->updateUser(".typeOfUser", $typeOfUser, $id);
                $this->logs("Se modifico el usuario $email", $email);
                return new JsonModel(["message" => "el usuario " . $email . " se ah modificado"]);
            } else {
                $this->logs("se intento modificar el usuario $email pero no existe", $email);
                return new JsonModel(["message" => "El usuario con email " . $email . " no existe"]);
            }
        } else {
            $this->logs("Se intento acceder a actualizar usuario por get", "DESC");
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }


    public function getalluserAction()
    {

        if ($this->getRequest()->isPost()) {
            $usersNotAllowed = $this->entityManager->getRepository(userEntity::class)->findBy(['status' => 0]);
            $roleList = [];
            foreach ($usersNotAllowed as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getId();
                    $roleList["name"] = $role->getFullName();
                    $roleList["email"] = $role->getEmail();
                } else {
                    $roleList["error"] = "no hay usuarios";
                }
            }
            $this->logs("Se obtubieron todos los usuarios no activos", "ADMIN");
            return new JsonModel([$roleList]);
        } else {
            $this->logs("Se intento ingresar a la ruta de obtener usuarios con get", "DESC");
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function activeuserAction()
    {
        if ($this->getRequest()->isPost()) {
            $id_key = $this->params()->fromPost("id_key");
            $corpAsig = $this->params()->fromPost("corpAsig");
            $rolasign = $this->params()->fromPost("rolasign");
            $id = $this->params()->fromPost("id");
            $parqueasig = $this->params()->fromPost("parqueasig");

            $permisos = $this->getPermision($id_key);
            if ($permisos['name'] == "Administrator") {
                $this->logs("Se activo el usuario con id : $id", $id_key);
                $this->entityManager->getRepository(userEntity::class)->updateUser(".status", 1, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUserActive(".key_corp", $corpAsig, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUserActive(".cargo", $rolasign, $id);
                return new JsonModel(["message" => "activado"]);
            } else {
                $this->logs("el usuario con id $id_key intento activar al usuario con id $id (permisos insuficientes)", $id_key);
                return new JsonModel([$permisos]);
            }

            return new JsonModel(["message" => "echo"]);
        } else {
            $this->logs("Se intento acceder con get a la ruta activarusuarios", "ADMIN");
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    /*
     * datosDelusuario CRUD
     */

    public function getdatauserAction()
    {

        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost("id", "");

            $dataUser = $this->entityManager->getRepository(datosDeUsuarioEntity::class)->findBy(['idAmpip' => $id]);
            $data = [];

            foreach ($dataUser as $item) {
                $data['id'] = $item->getId();
                $data['key_corp'] = $item->getkey_corp();
                $data['cargo'] = $item->getcargo();
                $data['telefonoOfficina'] = $item->gettelefonoOfficina();
                $data['celular'] = $item->getcelular();
                $data['direccionDeOfficina'] = $item->getdireccionDeOfficina();
                $data['cumpleanios'] = $item->getcumpleanios();
                $data['compartirDatos'] = $item->getcompartirDatos();
                $data['habilitar'] = $item->gethabilitar();
            }
            $this->logs("el usuario con id $id obtubo sus datos", $id);
            return new JsonModel($data);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //admin permisos
    public function createdatauserAction()
    {

        if ($this->getRequest()->isPost()) {
            //id de usuario de la tabla User
            $id = $this->params()->fromPost("id", "");

            $telefonoOfficina = $this->params()->fromPost("telefonoOfficina", "");
            $celular = $this->params()->fromPost("celular", "");
            $direccionDeOfficina = $this->params()->fromPost("direccionDeOfficina", "");
            $cumpleanios = $this->params()->fromPost("cumpleanios", "");
            $compartirDatos = $this->params()->fromPost("compartirDatos", "");
            $cargo = $this->getcargo($id);
            $findUser = $this->entityManager->getRepository(datosDeUsuarioEntity::class)->findBy(['idAmpip' => $id]);


            if ($findUser != null) {
                return new JsonModel(["message" => "Ya hay datos"]);
                $this->logs("el usuario con id $id intento crear nuevos datos error de duplicidad", $id);
            } else {
                $newDatauser = new datosDeUsuarioEntity();
                $newDatauser->settelefonoOfficina($telefonoOfficina);
                $newDatauser->setcelular($celular);
                $newDatauser->setdireccionDeOfficina($direccionDeOfficina);
                $newDatauser->setcumpleanios($cumpleanios);
                $newDatauser->setcompartirDatos($compartirDatos);
                $newDatauser->sethabilitar(1);
                $newDatauser->setidAmpip($id);
                $newDatauser->setcargo($cargo);
                $this->entityManager->persist($newDatauser);
                $this->entityManager->flush();
                return new JsonModel(["message" => "creado"]);
                $this->logs("el usuario con id $id creo sus datos", $id);
            }
        } else {

            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //admin permision
    public function updatedatauserAction()
    {
        if ($this->getRequest()->isPost()) {
            $id_key = $this->params()->fromPost("id_key", "");
            $id = $this->params()->fromPost("id", "");
            $cargo = $this->params()->fromPost("cargo", "");
            $telefonoOfficina = $this->params()->fromPost("telefonoOfficina", "");
            $celular = $this->params()->fromPost("celular", "");
            $direccionDeOfficina = $this->params()->fromPost("direccionDeOfficina", "");
            $cumpleanios = $this->params()->fromPost("cumpleanios", "");
            $compartirDatos = $this->params()->fromPost("compartirDatos", "");
            $habilitar = $this->params()->fromPost("habilitar", "");

            $permisos = $this->getPermision($id_key);
            if ($permisos['name'] == "Administrator") {
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".cargo", $cargo, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".telefonoOfficina", $telefonoOfficina, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".celular", $celular, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".direccionDeOfficina", $direccionDeOfficina, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".cumpleanios", $cumpleanios, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".compartirDatos", $compartirDatos, $id);
                $this->entityManager->getRepository(datosDeUsuarioEntity::class)->updateUser(".habilitar", $habilitar, $id);
                return new JsonModel(["message" => "listo"]);
                $this->logs("el usuario con id $id actualizo sus datos", $id);
            } else {
                $this->logs("el usuario con id $id no tiene permisos suficientes para actualizar informacion ", $id);
                return new JsonModel(["message" => "sin permisos requeridos"]);
            }
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }


    /*
     * parques CRUD
     */

    public function getparkAction()
    {
        $id = $this->params()->fromPost("id", "");
        if ($this->getRequest()->isPost()) {
            $result = $this->entityManager->getRepository(parqueEntity::class)->findById($id);
            $roleList = [];
            foreach ($result as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getid();
                    $roleList["key_corp"] = $role->getkey_corp();
                    $roleList["key_user"] = $role->getkey_user();
                    $roleList["nombre_es"] = $role->getnombre_es();
                    $roleList["nombre_en"] = $role->getnombre_en();
                    $roleList["adminParq"] = $role->getadminParq();
                    $roleList["parqProp"] = $role->getparqProp();
                    $roleList["parqIntoParq"] = $role->getparqIntoParq();
                    $roleList["region"] = $role->getregion();
                    $roleList["mercado"] = $role->getmercado();
                    $roleList["tipoDeIndustria"] = $role->gettipoDeIndustria();
                    $roleList["superficieTotal"] = $role->getsuperficieTotal();
                    $roleList["superficieUrban"] = $role->getsuperficieUrban();
                    $roleList["superficieOcup"] = $role->getsuperficieOcup();
                    $roleList["superficieDisp"] = $role->getsuperficieDisp();
                    $roleList["tipoDePropiedad"] = $role->gettipoDePropiedad();
                    $roleList["inicioOperaciones"] = $role->getinicioOperaciones();
                    $roleList["numEmpleados"] = $role->getnumEmpleados();
                    $roleList["reconocimientoPracticas"] = $role->getreconocimientoPracticas();
                    $roleList["ifraestructura"] = $role->getifraestructura();
                    $roleList["numeroDeNaves"] = $role->getnumeroDeNaves();
                    $roleList["observacion"] = $role->getobservacion();
                    $roleList["kmz"] = $role->getkmz();
                    $roleList["planMaestro"] = $role->getplanMaestro();
                    $roleList["contactName"] = $role->getcontactName();
                    $roleList["contactEmail"] = $role->getcontactEmail();
                } else {
                    $roleList["error"] = "2541";
                }
            }
            return new JsonModel([$roleList]);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //admin permisos
    public function createparkAction()
    {
        if ($this->getRequest()->isPost()) {
            $key_corp = $this->params()->fromPost("key_corp");
            $key_user = $this->params()->fromPost("key_user", null);
            $nombre_es = $this->params()->fromPost("nombre_es");
            $nombre_en = $this->params()->fromPost("nombre_en", "");
            $adminParq = $this->params()->fromPost("adminParq", null);
            $parqProp = $this->params()->fromPost("parqProp");
            $parqIntoParq = $this->params()->fromPost("parqIntoParq", 0);
            $region = $this->params()->fromPost("region");
            $mercado = $this->params()->fromPost("mercado");
            $tipoDeIndustria = $this->params()->fromPost("tipoDeIndustria");
            $superficieTotal = $this->params()->fromPost("superficieTotal");
            $superficieUrban = $this->params()->fromPost("superficieUrban");
            $superficieOcup = $this->params()->fromPost("superficieOcup");
            $superficieDisp = $this->params()->fromPost("superficieDisp");
            $tipoDePropiedad = $this->params()->fromPost("tipoDePropiedad");
            $inicioOperaciones = $this->params()->fromPost("inicioOperaciones", date('Y-m-d H:i:s'));
            $numEmpleados = $this->params()->fromPost("numEmpleados");
            $reconocimientoPracticas = $this->params()->fromPost("reconocimientoPracticas", null);
            $ifraestructura = $this->params()->fromPost("ifraestructura");
            $numeroDeNaves = $this->params()->fromPost("numeroDeNaves");
            $observacion = $this->params()->fromPost("observacion");
            $kmz = $this->params()->fromPost("kmz");
            $planMaestro = $this->params()->fromPost("planMaestro");
            $contactName = $this->params()->fromPost("contactName");
            $contactEmail = $this->params()->fromPost("contactEmail");
            $isDispo = $this->entityManager->getRepository(parqueEntity::class)->findBy(["nombre_es" => $nombre_es, "key_corp" => $key_corp]);


            if ($isDispo == null) {
                $newpark = new parqueEntity();

                $newpark->setkey_corp($key_corp);
                $newpark->setkey_user($key_user);
                $newpark->setnombre_es($nombre_es);
                $newpark->setnombre_en($nombre_en);
                $newpark->setadminParq($adminParq);
                $newpark->setparqProp($parqProp);
                $newpark->setparqIntoParq($parqIntoParq);
                $newpark->setregion($region);
                $newpark->setmercado($mercado);
                $newpark->settipoDeIndustria($tipoDeIndustria);
                $newpark->setsuperficieTotal($superficieTotal);
                $newpark->setsuperficieUrban($superficieUrban);
                $newpark->setsuperficieOcup($superficieOcup);
                $newpark->setsuperficieDisp($superficieDisp);
                $newpark->settipoDePropiedad($tipoDePropiedad);
                $newpark->setinicioOperaciones($inicioOperaciones);
                $newpark->setnumEmpleados($numEmpleados);
                $newpark->setreconocimientoPracticas($reconocimientoPracticas);
                $newpark->setifraestructura($ifraestructura);
                $newpark->setnumeroDeNaves($numeroDeNaves);
                $newpark->setobservacion($observacion);
                $newpark->setkmz($kmz);
                $newpark->setplanMaestro($planMaestro);
                $newpark->setcontactName($contactName);
                $newpark->setcontactEmail($contactEmail);
                $this->entityManager->persist($newpark);
                $this->entityManager->flush();
                return new JsonModel(["message" => "Listo"]);
            } else {
                return new JsonModel(["err" => "parque con mismo nombre registrado"]);
            }
        } else {
            return $this->redirect()->toUrl($this->url);
        }
    }

    //admin permisos
    public function updateparkAction()
    {
        if ($this->getRequest()->isPost()) {
            //id para poder editar
            $key_id = $this->params()->fromPost("key_id");
            $id = $this->params()->fromPost("id", "");
            $nombre_es = $this->params()->fromPost("nombre_es");
            $nombre_en = $this->params()->fromPost("nombre_en", "");
            $adminParq = $this->params()->fromPost("adminParq");
            $parqProp = $this->params()->fromPost("parqProp");
            $parqIntoParq = $this->params()->fromPost("parqIntoParq");
            $region = $this->params()->fromPost("region");
            $mercado = $this->params()->fromPost("mercado");
            $tipoDeIndustria = $this->params()->fromPost("tipoDeIndustria");
            $superficieTotal = $this->params()->fromPost("superficieTotal");
            $superficieUrban = $this->params()->fromPost("superficieUrban");
            $superficieOcup = $this->params()->fromPost("superficieOcup");
            $superficieDisp = $this->params()->fromPost("superficieDisp");
            $tipoDePropiedad = $this->params()->fromPost("tipoDePropiedad");
            $numEmpleados = $this->params()->fromPost("numEmpleados");
            $reconocimientoPracticas = $this->params()->fromPost("reconocimientoPracticas");
            $ifraestructura = $this->params()->fromPost("ifraestructura");
            $numeroDeNaves = $this->params()->fromPost("numeroDeNaves");
            $observacion = $this->params()->fromPost("observacion");
            $kmz = $this->params()->fromPost("kmz");
            $planMaestro = $this->params()->fromPost("planMaestro");
            $contactName = $this->params()->fromPost("contactName");
            $contactEmail = $this->params()->fromPost("contactEmail");

            $user = $this->entityManager->getRepository(parqueEntity::class)->findById($id);
            $permiso = $this->getPermision($key_id);
            if ($permiso['name'] == "Administrator") {
                if ($user != null) {
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".nombre_es", $nombre_es, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".nombre_en", $nombre_en, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".adminParq", $adminParq, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".parqProp", $parqProp, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".parqIntoParq", $parqIntoParq, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".region", $region, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".mercado", $mercado, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".tipoDeIndustria", $tipoDeIndustria, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".superficieTotal", $superficieTotal, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".superficieUrban", $superficieUrban, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".superficieOcup", $superficieOcup, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".superficieDisp", $superficieDisp, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".tipoDePropiedad", $tipoDePropiedad, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".numEmpleados", $numEmpleados, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".reconocimientoPracticas", $reconocimientoPracticas, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".ifraestructura", $ifraestructura, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".numeroDeNaves", $numeroDeNaves, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".observacion", $observacion, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".kmz", $kmz, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".planMaestro", $planMaestro, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".contactName", $contactName, $id);
                    $this->entityManager->getRepository(parqueEntity::class)->updatePark(".contactEmail", $contactEmail, $id);

                    return new JsonModel(["message" => "echo"]);
                } else {
                    return new JsonModel(["message" => "El id no existe"]);
                }
            } else {
                return new JsonModel(["message" => "Usuario no permitido"]);
            }
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    //
    public function getallparkAction()
    {
        $id = $this->params()->fromPost("id", "");
        if ($this->getRequest()->isPost()) {
            $result = $this->entityManager->getRepository(parqueEntity::class)->findBy(["key_corp" => $id]);
            $arr = array();
            $roleList = [];

            foreach ($result as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getid();
                    $roleList["key_corp"] = $role->getkey_corp();
                    $roleList["key_user"] = $role->getkey_user();
                    $roleList["nombre_es"] = $role->getnombre_es();
                    $roleList["nombre_en"] = $role->getnombre_en();
                    $roleList["adminParq"] = $role->getadminParq();
                    $roleList["parqProp"] = $role->getparqProp();
                    $roleList["parqIntoParq"] = $role->getparqIntoParq();
                    $roleList["region"] = $role->getregion();
                    $roleList["mercado"] = $role->getmercado();
                    $roleList["tipoDeIndustria"] = $role->gettipoDeIndustria();
                    $roleList["superficieTotal"] = $role->getsuperficieTotal();
                    $roleList["superficieUrban"] = $role->getsuperficieUrban();
                    $roleList["superficieOcup"] = $role->getsuperficieOcup();
                    $roleList["superficieDisp"] = $role->getsuperficieDisp();
                    $roleList["tipoDePropiedad"] = $role->gettipoDePropiedad();
                    $roleList["inicioOperaciones"] = $role->getinicioOperaciones();
                    $roleList["numEmpleados"] = $role->getnumEmpleados();
                    $roleList["reconocimientoPracticas"] = $role->getreconocimientoPracticas();
                    $roleList["ifraestructura"] = $role->getifraestructura();
                    $roleList["numeroDeNaves"] = $role->getnumeroDeNaves();
                    $roleList["observacion"] = $role->getobservacion();
                    $roleList["kmz"] = $role->getkmz();
                    $roleList["planMaestro"] = $role->getplanMaestro();
                    $roleList["contactName"] = $role->getcontactName();
                    $roleList["contactEmail"] = $role->getcontactEmail();
                    array_push($arr, $roleList);
                } else {
                    $roleList["error"] = "2541";
                }
            }

            return new JsonModel($arr);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function getparksAction()
    {
        if ($this->getRequest()->isPost()) {
            $result = $this->entityManager->getRepository(parqueEntity::class)->findAll();
            $arr = array();
            $roleList = [];

            foreach ($result as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getid();
                    $roleList["key_corp"] = $role->getkey_corp();
                    $roleList["key_user"] = $role->getkey_user();
                    $roleList["nombre_es"] = $role->getnombre_es();
                    $roleList["nombre_en"] = $role->getnombre_en();
                    $roleList["adminParq"] = $role->getadminParq();
                    $roleList["parqProp"] = $role->getparqProp();
                    $roleList["parqIntoParq"] = $role->getparqIntoParq();
                    $roleList["region"] = $role->getregion();
                    $roleList["mercado"] = $role->getmercado();
                    $roleList["tipoDeIndustria"] = $role->gettipoDeIndustria();
                    $roleList["superficieTotal"] = $role->getsuperficieTotal();
                    $roleList["superficieUrban"] = $role->getsuperficieUrban();
                    $roleList["superficieOcup"] = $role->getsuperficieOcup();
                    $roleList["superficieDisp"] = $role->getsuperficieDisp();
                    $roleList["tipoDePropiedad"] = $role->gettipoDePropiedad();
                    $roleList["inicioOperaciones"] = $role->getinicioOperaciones();
                    $roleList["numEmpleados"] = $role->getnumEmpleados();
                    $roleList["reconocimientoPracticas"] = $role->getreconocimientoPracticas();
                    $roleList["ifraestructura"] = $role->getifraestructura();
                    $roleList["numeroDeNaves"] = $role->getnumeroDeNaves();
                    $roleList["observacion"] = $role->getobservacion();
                    $roleList["kmz"] = $role->getkmz();
                    $roleList["planMaestro"] = $role->getplanMaestro();
                    $roleList["contactName"] = $role->getcontactName();
                    $roleList["contactEmail"] = $role->getcontactEmail();
                    array_push($arr, $roleList);
                } else {
                    $roleList["error"] = "2541";
                }
            }

            return new JsonModel($arr);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    /*
     * nave
     */

    public function createnaveAction()
    {
        $name = $this->params()->fromPost("name", "q");
        $idParque = $this->params()->fromPost("idParque", "q");

        $newNave = new naveEntity();
        $newNave->setname($name);
        $newNave->setparque_id($idParque);

        $this->entityManager->persist($newNave);
        $this->entityManager->flush();

        return new JsonModel(["message" => "Creado"]);
    }

    public function getnaveAction()
    {
        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost("id", "");
            $nave = $this->entityManager->getRepository(naveEntity::class)->findById($id);


            $roleList = [];
            foreach ($nave as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getId();
                    $roleList["name"] = $role->getname();
                    $roleList["parque_id"] = $role->getparque_id();
                } else {
                    $roleList["error"] = "2541";
                }
            }


            return new JsonModel($roleList);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function getallnaveAction()
    {
        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost("id", "");
            $nave = $this->entityManager->getRepository(naveEntity::class)->findBy(["parque_id" => $id]);

            $arr = array();
            $roleList = [];
            foreach ($nave as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getId();
                    $roleList["name"] = $role->getname();
                    $roleList["parque_id"] = $role->getparque_id();
                    array_push($arr, $roleList);
                } else {
                    $roleList["error"] = "2541";
                }
            }


            return new JsonModel($arr);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    /*
     *inquilino
     */


    public function getinquilinoAction()
    {
        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost("id");
            $inquilino = $this->entityManager->getRepository(inquilino_naveEntity::class)->findById($id);

            $roleList = [];
            foreach ($inquilino as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getid();
                    $roleList["corporativo"] = $role->getcorporativo();
                    $roleList["tipoDeNave"] = $role->gettipoDeNave();
                    $roleList["nombre_es"] = $role->getnombre_es();
                    $roleList["nombre_en"] = $role->getnombre_en();
                    $roleList["propietario"] = $role->getpropietario();
                    $roleList["id_nave"] = $role->getid_nave();
                    $roleList["nombreEmpresa"] = $role->getnombreEmpresa();
                    $roleList["numEmpleados"] = $role->getnumEmpleados();
                    $roleList["paisOrigen"] = $role->getpaisOrigen();
                    $roleList["productoInsignia"] = $role->getproductoInsignia();
                    $roleList["sectorEmpresarial"] = $role->getsectorEmpresarial();
                    $roleList["id_SCIAN"] = $role->getid_SCIAN();
                    $roleList["id_DENUE"] = $role->getid_DENUE();
                    $roleList["antiguedad"] = $role->getantiguedad();
                    $roleList["isAmpip"] = $role->getisAmpip();
                    $roleList["x"] = $role->getmedidaX();
                    $roleList["y"] = $role->getmedidaY();
                    $roleList["z"] = $role->getmedidaZ();
                } else {
                    $roleList["error"] = "2541";
                }
            }

            return new JsonModel($roleList);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function setinquilinoAction()
    {

        if ($this->getRequest()->isPost()) {
            $corporativo = $this->params()->fromPost("corporativo");
            $tipoDeNave = $this->params()->fromPost("tipoDeNave");
            $nombre_es = $this->params()->fromPost("nombre_es");
            $nombre_en = $this->params()->fromPost("nombre_en");
            $propietario = $this->params()->fromPost("propietario");
            $id_nave = $this->params()->fromPost("id_nave");
            $nombreEmpresa = $this->params()->fromPost("nombreEmpresa");
            $numEmpleados = $this->params()->fromPost("numEmpleados");
            $paisOrigen = $this->params()->fromPost("paisOrigen");
            $productoInsignia = $this->params()->fromPost("productoInsignia");
            $sectorEmpresarial = $this->params()->fromPost("sectorEmpresarial");
            $id_SCIAN = $this->params()->fromPost("id_SCIAN");
            $id_DENUE = $this->params()->fromPost("id_DENUE");
            $antiguedad = $this->params()->fromPost("antiguedad");
            $isAmpip = $this->params()->fromPost("isAmpip");
            $medidaX = $this->params()->fromPost("medidaX");
            $medidaY = $this->params()->fromPost("medidaY");
            $medidaZ = $this->params()->fromPost("medidaZ");
            $search = $this->entityManager->getRepository(inquilino_naveEntity::class)->findBy(["nombre_es" => $nombre_es]);
            if ($search == null) {
                $newInquilino = new inquilino_naveEntity();
                $newInquilino->setcorporativo($corporativo);
                $newInquilino->settipoDeNave($tipoDeNave);
                $newInquilino->setnombre_es($nombre_es);
                $newInquilino->setnombre_en($nombre_en);
                $newInquilino->setpropietario($propietario);
                $newInquilino->setid_nave($id_nave);
                $newInquilino->setnombreEmpresa($nombreEmpresa);
                $newInquilino->setnumEmpleados($numEmpleados);
                $newInquilino->setpaisOrigen($paisOrigen);
                $newInquilino->setproductoInsignia($productoInsignia);
                $newInquilino->setsectorEmpresarial($sectorEmpresarial);
                $newInquilino->setid_SCIAN($id_SCIAN);
                $newInquilino->setid_DENUE($id_DENUE);
                $newInquilino->setantiguedad($antiguedad);
                $newInquilino->setisAmpip($isAmpip);
                $newInquilino->setmedidaX($medidaX);
                $newInquilino->setmedidaZ($medidaZ);
                $newInquilino->setmedidaY($medidaY);
                $this->entityManager->persist($newInquilino);
                $this->entityManager->flush();

                return new JsonModel(["message" => "listo"]);
            } else {
                return new JsonModel(["message" => "El inquilino ya esta existe"]);
            }
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function updateinquilinoAction()
    {
        if ($this->getRequest()->isPost()) {
            $key_id = $this->params()->fromPost("key", "");
            $id = $this->params()->fromPost("id", "");
            $tipoDeNave = $this->params()->fromPost("tipoDeNave", "");
            $nombre_es = $this->params()->fromPost("nombre_es", "");
            $nombre_en = $this->params()->fromPost("nombre_en", "");
            $propietario = $this->params()->fromPost("propietario", "");
            $nombreEmpresa = $this->params()->fromPost("nombreEmpresa", "");
            $numEmpleados = $this->params()->fromPost("numEmpleados", "");
            $paisOrigen = $this->params()->fromPost("paisOrigen", "");
            $productoInsignia = $this->params()->fromPost("productoInsignia", "");
            $sectorEmpresarial = $this->params()->fromPost("sectorEmpresarial", "");
            $id_SCIAN = $this->params()->fromPost("id_SCIAN", "");
            $id_DENUE = $this->params()->fromPost("id_DENUE", "");
            $antiguedad = $this->params()->fromPost("antiguedad", "");
            $isAmpip = $this->params()->fromPost("isAmpip", "");
            $medidaX = $this->params()->fromPost("medidaX");
            $medidaY = $this->params()->fromPost("medidaY");
            $medidaZ = $this->params()->fromPost("medidaZ");

            $permiso = $this->getPermision($key_id);
            if ($permiso['name'] == "Administrator") {
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".tipoDeNave", $tipoDeNave, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".nombre_es", $nombre_es, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".nombre_en", $nombre_en, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".propietario", $propietario, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".nombreEmpresa", $nombreEmpresa, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".numEmpleados", $numEmpleados, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".paisOrigen", $paisOrigen, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".productoInsignia", $productoInsignia, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".sectorEmpresarial", $sectorEmpresarial, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".id_SCIAN", $id_SCIAN, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".id_DENUE", $id_DENUE, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".antiguedad", $antiguedad, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".isAmpip", $isAmpip, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".medidaX", $medidaX, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".medidaY", $medidaY, $id);
                $this->entityManager->getRepository(inquilino_naveEntity::class)->updateData(".medidaZ", $medidaZ, $id);
                return new JsonModel(["message" => "listo"]);
            } else {
                return new JsonModel(["message" => "permiso Insuficiente"]);
            }
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function getallAction()
    {
        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost("id");
            $inquilino = $this->entityManager->getRepository(inquilino_naveEntity::class)->findBy(["id_nave" => $id]);

            $arr = array();
            $roleList = [];
            foreach ($inquilino as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getid();
                    $roleList["corporativo"] = $role->getcorporativo();
                    $roleList["tipoDeNave"] = $role->gettipoDeNave();
                    $roleList["nombre_es"] = $role->getnombre_es();
                    $roleList["nombre_en"] = $role->getnombre_en();
                    $roleList["propietario"] = $role->getpropietario();
                    $roleList["id_nave"] = $role->getid_nave();
                    $roleList["nombreEmpresa"] = $role->getnombreEmpresa();
                    $roleList["numEmpleados"] = $role->getnumEmpleados();
                    $roleList["paisOrigen"] = $role->getpaisOrigen();
                    $roleList["productoInsignia"] = $role->getproductoInsignia();
                    $roleList["sectorEmpresarial"] = $role->getsectorEmpresarial();
                    $roleList["id_SCIAN"] = $role->getid_SCIAN();
                    $roleList["id_DENUE"] = $role->getid_DENUE();
                    $roleList["antiguedad"] = $role->getantiguedad();
                    $roleList["isAmpip"] = $role->getisAmpip();
                    array_push($arr, $roleList);
                } else {
                    $roleList["error"] = "2541";
                }
            }

            return new JsonModel($arr);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    /*
     * DEJAR AL ULTIMO
     */
    public function espacioAction()
    {
        if ($this->getRequest()->isPost()) {
            $id = $this->params()->fromPost("id");
            $inquilino = $this->entityManager->getRepository(espacio_disponibleEntity::class)->findById($id);

            $roleList = [];
            foreach ($inquilino as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getid();
                    $roleList["corporativo"] = $role->getcorporativo();
                    $roleList["ubicacion"] = $role->getubicacion();
                    $roleList["tipo"] = $role->gettipo();
                    $roleList["tipoDeDispo"] = $role->gettipoDeDispo();
                    $roleList["uso"] = $role->getuso();
                    $roleList["municipio"] = $role->getmunicipio();
                    $roleList["estado"] = $role->getestado();
                    $roleList["web"] = $role->getweb();
                    $roleList["contacto"] = $role->getcontacto();
                    $roleList["precioPromedio"] = $role->getprecioPromedio();
                    $roleList["datoDeContacto"] = $role->getdatoDeContacto();
                    $roleList["id_parque"] = $role->getid_parque();
                    $roleList["x"] = $role->getmedidaX();
                    $roleList["y"] = $role->getmedidaY();
                    $roleList["z"] = $role->getmedidaZ();
                } else {
                    $roleList["error"] = "2541";
                }
            }

            return new JsonModel($roleList);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function setespacioAction()
    {
        if ($this->getRequest()->isPost()) {

            $corporativo = $this->params()->fromPost("corporativo");
            $ubicacion = $this->params()->fromPost("ubicacion");
            $tipo = $this->params()->fromPost("tipo");
            $tipoDeDispo = $this->params()->fromPost("tipoDeDispo");
            $uso = $this->params()->fromPost("uso");
            $municipio = $this->params()->fromPost("municipio");
            $estado = $this->params()->fromPost("estado");
            $web = $this->params()->fromPost("web");
            $contacto = $this->params()->fromPost("contacto");
            $precioPromedio = $this->params()->fromPost("precioPromedio");
            $datoDeContacto = $this->params()->fromPost("datoDeContacto");
            $nave_id = $this->params()->fromPost("nave_id");
            $medidaX = $this->params()->fromPost("medidaX");
            $medidaY = $this->params()->fromPost("medidaY");
            $medidaZ = $this->params()->fromPost("medidaZ");
            $espacio = $this->entityManager->getRepository(espacio_disponibleEntity::class)->findBy(['nave_id' => $nave_id]);

            if ($espacio == null) {
                $newespacio = new inquilino_naveEntity();
                $newespacio->setcorporativo($corporativo);
                $newespacio->setcorporativo($ubicacion);
                $newespacio->setcorporativo($tipo);
                $newespacio->setcorporativo($tipoDeDispo);
                $newespacio->setcorporativo($uso);
                $newespacio->setcorporativo($municipio);
                $newespacio->setcorporativo($estado);
                $newespacio->setcorporativo($web);
                $newespacio->setcorporativo($contacto);
                $newespacio->setcorporativo($precioPromedio);
                $newespacio->setcorporativo($datoDeContacto);
                $newespacio->setcorporativo($nave_id);
                $newespacio->setmedidaX($medidaX);
                $newespacio->setmedidaY($medidaY);
                $newespacio->setmedidaZ($medidaZ);
            } else {
                return new JsonModel(["message" => "ya tiene espacio asignado para esta nave"]);
            }

            $this->entityManager->persist($newespacio);
            $this->entityManager->flush();
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }

    public function updateespacioAction()
    {

        if ($this->getRequest()->isPost()) {
            //id de solicitud
            $id_key = $this->params()->fromPost("id_key", "");
            //lo demas
            $id = $this->params()->fromPost("id", "");
            $corporativo = $this->params()->fromPost("corporativo", "");
            $ubicacion = $this->params()->fromPost("ubicacion", "");
            $tipo = $this->params()->fromPost("tipo", "");
            $tipoDeDispo = $this->params()->fromPost("tipoDeDispo", "");
            $uso = $this->params()->fromPost("uso", "");
            $municipio = $this->params()->fromPost("municipio", "");
            $estado = $this->params()->fromPost("estado", "");
            $web = $this->params()->fromPost("web", "");
            $contacto = $this->params()->fromPost("contacto", "");
            $precioPromedio = $this->params()->fromPost("precioPromedio", "");
            $datoDeContacto = $this->params()->fromPost("datoDeContacto", "");
            $nave_id = $this->params()->fromPost("nave_id", "");
            $medidaX = $this->params()->fromPost("medidaX");
            $medidaY = $this->params()->fromPost("medidaY");
            $medidaZ = $this->params()->fromPost("medidaZ");
            $permiso = $this->getPermision($id_key);

            if ($permiso['name'] == "Administrator") {
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".id", $id, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".corporativo", $corporativo, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".ubicacion", $ubicacion, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".tipo", $tipo, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".tipoDeDispo", $tipoDeDispo, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".uso", $uso, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".municipio", $municipio, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".estado", $estado, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".web", $web, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".contacto", $contacto, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".precioPromedio", $precioPromedio, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".datoDeContacto", $datoDeContacto, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".nave_id", $nave_id, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".medidaX", $medidaX, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".medidaY", $medidaY, $id);
                $this->entityManager->getRepository(espacio_disponibleEntity::class)->updateData(".medidaZ", $medidaZ, $id);

                return new JsonModel(["message" => "Listo"]);
            } else {
                return new JsonModel(["message" => "permisos insuficientes"]);
            }
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }


    public function getroleAction()
    {
        if ($this->getRequest()->isPost()) {
            $getRoles = $this->entityManager->getRepository(Role::class)->findAll();


            $arr = array();
            $roleList = [];
            foreach ($getRoles as $role) {
                if ($role->getId() != "") {
                    $roleList["id"] = $role->getId();
                    $roleList["name"] = $role->getName();
                    $roleList["description"] = $role->getDescription();
                } else {
                    $roleList["error"] = "2541";
                }

                array_push($arr, $roleList);
            }

            return new JsonModel($arr);
        } else {
            return $this->redirect()->toUrl(
                $this->url
            );
        }
    }


    public function encript($option, $message, $key)
    {


        if ($option == "enc") {
            $result = '';
            for ($i = 0; $i < strlen($message); $i++) {
                $char = substr($message, $i, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) + ord($keychar));
                $result .= $char;
            }
            return base64_encode($result);
        } else {
            $result = "";
            $string = base64_decode($message);
            for ($i = 0; $i < strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) - ord($keychar));
                $result .= $char;
            }

            return $result;
        }
    }

    public function logs($message, $user)
    {


        $log = new logEntity();
        $log->setmessage($message);
        $log->setuser($user);
        $log->settime(date('Y-m-d H:i:s'));

        $this->entityManager->persist($log);
        $this->entityManager->flush();

        return new JsonModel(["message" => ["listo"]]);
    }


    public function getuseridloginAction()
    {
        $email = $this->params()->fromPost('email', 'q');
        $pass = $this->params()->fromPost('pass', 'q');
        $decryptPass = $this->encript("enc", $pass, "4MP1P");
        $response = $this->entityManager->getRepository(userEntity::class)->findBy(['email' => $email, 'password' => $decryptPass]);
        $roleList = [];
        foreach ($response as $role) {
            if ($role->getId() != "") {
                $roleList["id"] = $role->getId();
            } else {
                $roleList["error"] = "Usuario no reconocido comunicate con ampip por si el usuario aun no esta registrado";
            }
        }
        $this->logs("el usuario $email inicio secion", $email);
        return new JsonModel([$roleList]);
    }

    public function setpermisosAction()
    {
        if ($this->getRequest()->isPost()) {
            $idUser = $this->params()->fromPost("idUser", "");
            $idParque = $this->params()->fromPost("idParque", "");
            $permiso = $this->params()->fromPost("permiso", "");

            if ($idUser != "" && $idParque != "" && $permiso != "") {
                $userPermisoParque = new parquesuserEntity();
                $userPermisoParque->setid_parque($idParque);
                $userPermisoParque->setPersona($idUser);
                $userPermisoParque->setpermiso($permiso);
                $this->entityManager->persist($userPermisoParque);
                $this->entityManager->flush();
                return new JsonModel(["message" => "Se otorgaron permisos"]);
            } else {
                return new JsonModel(["message" => "Datos nulos"]);
            }
        } else {
            return new JsonModel(["message" => "ruta solo post"]);
        }
    }

    public function activeinactiveAction()
    {
        if ($this->getRequest()->isPost()) {
            $type = $this->params()->fromPost("type");
            $table = $this->params()->fromPost("table");
            $id = $this->params()->fromPost("id");
            $key_corp = $this->params()->fromPost("parque", 0);
            switch ($type) {
                case "a":
                    switch ($table) {
                        case "c":
                            $this->entityManager->getRepository(corpEntity::class)->updateUser(".status", 1, $id);
                            return new JsonModel(["message" => "listo"]);
                        case "u":
                            $this->entityManager->getRepository(userEntity::class)->updateUser(".status", 1, $id);
                            return new JsonModel(["message" => "listo"]);
                        case "p":
                            $this->entityManager->getRepository(parqueEntity::class)->updatePark(".key_corp", $key_corp, $id);
                            return new JsonModel(["" => ""]);
                    }

                    return new JsonModel(["message" => "listo"]);

                case "i":
                    switch ($table) {
                        case "c":
                            $this->entityManager->getRepository(corpEntity::class)->updateUser(".status", null, $id);
                            return new JsonModel(["message" => "listo"]);

                        case "u":
                            $this->entityManager->getRepository(userEntity::class)->updateUser(".status", null, $id);
                            return new JsonModel(["message" => "listo"]);
                        case "p":
                            $this->entityManager->getRepository(parqueEntity::class)->updatePark(".key_corp", 0, $id);
                            return new JsonModel(["" => ""]);
                    }
                    return new JsonModel(["message" => "listo"]);
            }
        }

        return new JsonModel(["message" => "solo post"]);
    }
    //para el widget mapa de bilda
    public function mapsAction()
    {
        if ($this->getRequest()->isPost()) {
            $maker = $this->entityManager->getRepository(mapsEntity::class)->findAll();
            $makersArray = array();
            $arr = [];

            foreach ($maker as $make){
                $arr['id'] = $make->getId();
                $arr['name'] = $make->getname();
                $arr['lat'] = $make->getlat();
                $arr['lng'] = $make->getlng();
                $arr['filters'] = $make->getfilters();
                array_push($makersArray, $arr);
            }
            $this->logs("Se obtubieron todos los parques", "WM");
            return new JsonModel($makersArray);

        } else {
            return new JsonModel(["message" => "solo post"]);
        }
    }


    public function testAction() {
        return new JsonModel(["message" => "Hello de nueno world"]);
    }
}
