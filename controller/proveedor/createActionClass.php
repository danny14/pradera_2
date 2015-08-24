<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class createActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $nombre = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE)));
                $apellido = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE)));
                $direccion = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE)));
                $telefono = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE)));
                $correo = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE)));
                $id_ciudad = trim(request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, TRUE)));
                
                $this->Validate($nombre,$apellido,$direccion,$telefono,$correo,$id_ciudad);
               
                $data = array(
                proveedorTableClass::NOMBRE => $nombre,
                proveedorTableClass::APELLIDO => $apellido,
                proveedorTableClass::DIRECCION => $direccion,
                proveedorTableClass::TELEFONO => $telefono,
                proveedorTableClass::CORREO => $correo,
                proveedorTableClass::ID_CIUDAD => $id_ciudad
                );
                proveedorTableClass::insert($data);
                bitacora::register('INSERTAR', proveedorTableClass::getNameTable());
                session::getInstance()->setSuccess('los datos fueron registrados de forma exitosa');
                routing::getInstance()->redirect('proveedor','index');
            }else{
                routing::getInstance()->redirect('proveedor', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
         
        }
    }
   private function Validate($nombre, $apellido, $direccion, $telefono, $correo, $id_ciudad) {
        $flag = FALSE;
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

        /*
         * Validacion para NOMBRE
         */
        if ($nombre === '' or $nombre === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => proveedorTableClass::NOMBRE)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);
        } else if (strlen($nombre) > proveedorTableClass::NOMBRE_LENGTH) {
            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $nombre, '%Character%' => proveedorTableClass::NOMBRE_LENGTH)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);
        } else if (!ereg("^[a-zA-Z ]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default', array('%field%' => proveedorTableClass::NOMBRE)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);
        }

        /*
         * Validacion para Apellido
         */
        if ($apellido === '' or $apellido === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => proveedorTableClass::APELLIDO)), 'errorApellido');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE), TRUE);
        } else if (strlen($apellido) > proveedorTableClass::APELLIDO_LENGTH) {
            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $nombre, '%Character%' => proveedorTableClass::APELLIDO_LENGTH)), 'errorApellido');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE), TRUE);
        } else if (!ereg("^[a-zA-Z ]{3,80}$", $apellido)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default', array('%field%' => proveedorTableClass::APELLIDO)), 'errorApellido');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE), TRUE);
        }
        /*
         * Validacion para Telefono
         */
        if ($telefono === '' or $telefono === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => proveedorTableClass::TELEFONO)), 'errorTelefono');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
        }else if (strlen($telefono) > proveedorTableClass::TELEFONO_LENGTH) {
            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $telefono, '%Character%' => proveedorTableClass::TELEFONO_LENGTH)), 'errorTelefono');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
        } else if (!is_numeric($telefono)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default', array('%field%' => proveedorTableClass::TELEFONO)), 'errorTelefono');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
        }
        /*
         * Validacion para Direccion
         */
        if ($direccion === '' or $direccion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => proveedorTableClass::DIRECCION)),'errorDireccion');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::direccion, TRUE), TRUE);
        }

        /*
         * Validacion para Correo
         */

        if ($correo === '' or $correo === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => proveedorTableClass::CORREO)),'errorCorreo');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE), TRUE);
        }else if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            session::getInstance()->setError(i18n::__('errorCharacterMail', NULL, 'default'),'errorCorreo');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE), TRUE);
        }
         /*
         * VALIDACION PARA ID CIUDAD
         */
        if($id_ciudad === '' or $id_ciudad === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => proveedorTableClass::ID_CIUDAD)),'errorCiudad');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, TRUE), TRUE);
        }else if (!is_numeric($id_ciudad)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => proveedorTableClass::ID_CIUDAD)),'errorCiudad');
            $flag = TRUE;
            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, TRUE), TRUE);
        }
        
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('proveedor', 'insert');
        }
    }

}
