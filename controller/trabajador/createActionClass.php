<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class createActionClass extends controllerClass implements controllerActionInterface {
      /* public function execute inicializa las variables 
     * @return $nombre=> nombre (string)
     * @return $apellido=> apellido (string)
     * @return $direccion=> direccion (string)
     * @return $telefono=> telefono(integer)
     * @return $id_turno=> id_turno(integer)
     * @return $id_credencial=> id_credencial(integer)
     * @return $id_ciudad=> id_ciudad(integer)
     * todas estos datos se pasa en la varible @var $data
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $nombre = trim(request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, true)));
                $apellido = strtoupper(trim(request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true))));
                $direccion = trim(request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true)));
                $telefono = trim(request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true)));
                $id_turno = trim(request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TURNO, true)));
                $id_credencial = trim(request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true)));
                $id_ciudad = trim(request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true)));
                
                $this->Validate($nombre,$apellido,$direccion,$telefono,$id_turno,$id_credencial,$id_ciudad);

                $data = array(
                    trabajadorTableClass::NOMBRE => $nombre,
                    trabajadorTableClass::APELLIDO => $apellido,
                    trabajadorTableClass::DIRECCION => $direccion,
                    trabajadorTableClass::TELEFONO => $telefono,
                    trabajadorTableClass::ID_TURNO => $id_turno,
                    trabajadorTableClass::ID_CREDENCIAL => $id_credencial,
                    trabajadorTableClass::ID_CIUDAD => $id_ciudad
                );

                trabajadorTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
                bitacora::register('Insertar', trabajadorTableClass::getNameTable());
                routing::getInstance()->redirect('trabajador', 'index');
            } else {
                routing::getInstance()->redirect('trabajador', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                // 42601
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
//                    session::getInstance()->setError($exc->getMessage());
                break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                break;
            }
//            routing::getInstance()->redirect('trabajador', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');            
        }
    }
    /**
     * Validaciones para el Trabajador 
     */
    private function Validate($nombre,$apellido,$direccion,$telefono,$id_turno,$id_credencial,$id_ciudad) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        /*
         * VALIDACION PARA NOMBRE
         */
        if($nombre === '' or $nombre === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE), TRUE);
        }else if (strlen($nombre) > trabajadorTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> trabajadorTableClass::NOMBRE_LENGTH)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE), TRUE);                  
        }else if (!preg_match("/^[a-zA-Z ]{3,80}$/", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => trabajadorTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE), TRUE);
        }
        /*
         * VALIDACION PARA APELLIDO
         */
        if($apellido === '' or $apellido === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::APELLIDO)),'errorApellido');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, TRUE), TRUE);
        }else if (strlen($apellido) > trabajadorTableClass::APELLIDO_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> trabajadorTableClass::APELLIDO_LENGTH)),'errorApellido');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, TRUE), TRUE);                  
        }else if (!preg_match("/^[a-zA-Z ]{3,80}$/", $apellido)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => trabajadorTableClass::APELLIDO)),'errorApellido');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, TRUE), TRUE);
        }
        /*
         * VALIDACION PARA DIRECCION
         */
        if($direccion === '' or $direccion === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::DIRECCION)),'errorDireccion');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, TRUE), TRUE);
        }
        
        /*
         * VALIDACION PARA TELEFONO
         */
        if($telefono === '' or $telefono === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::TELEFONO)),'errorTelefono');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, TRUE), TRUE);
        }
        if (!is_numeric($telefono)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::TELEFONO)),'errorTelefono');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, TRUE), TRUE);
        }
        /*
         * VALIDACION PARA ID TURNO
         */
        if($id_turno === '' or $id_turno === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::ID_TURNO)),'errorTurno');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TURNO, TRUE), TRUE);
        }
        if (!is_numeric($telefono)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::ID_TURNO)),'errorTurno');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TURNO, TRUE), TRUE);
        }
        /*
         * VALIDACION PARA ID CREDENCIAL
         */
        if($id_credencial === '' or $id_credencial === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::ID_CREDENCIAL)),'errorCredencial');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, TRUE), TRUE);
        }
        if (!is_numeric($id_credencial)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::ID_CREDENCIAL)),'errorCredencial');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, TRUE), TRUE);
        }
        /*
         * VALIDACION PARA ID CIUDAD
         */
        if($id_ciudad === '' or $id_ciudad === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::ID_CIUDAD)),'errorCiudad');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, TRUE), TRUE);
        }
        if (!is_numeric($id_ciudad)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::ID_CIUDAD)),'errorCiudad');
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, TRUE), TRUE);
        }
        /* _______________________________ */
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('trabajador', 'insert');
        }
    }

}
