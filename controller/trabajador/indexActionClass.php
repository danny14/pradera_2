<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing; 
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


class indexActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            $where = NULL;
//            if(request::getInstance()->hasPost('filter') and request::getInstance()->isMethod('POST')){
//                $filter = request::getInstance()->getPost('filter');
//                /**
//                 * Validacion de los filtros
//                 */
//                $nombre = $filter['nombre'];
//                $fecha_ini = $filter['fechaCreacion1'];
//                $fecha_fin = $filter['fechaCreacion2'];
//                
//                $this->Validate($nombre,$fecha_ini,$fecha_fin);
//                
//                if(isset($filter['nombre']) and $filter['nombre'] !== NULL and $filter['nombre'] !== ''){
//                    $where[animalTableClass::NOMBRE] = $filter['nombre'];
//                }
//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[animalTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
//                session::getInstance()->setAttribute('trabajadorIndexFilters', $where);
//            } else if(session::getInstance()->hasAttribute('trabajadorIndexFilters')){
//            $where = session::getInstance()->getAttribute('trabajadorIndexFilters');
//            }
            $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRE,
            trabajadorTableClass::APELLIDO,
            trabajadorTableClass::DIRECCION,
            trabajadorTableClass::TELEFONO,
            trabajadorTableClass::ID_TURNO,
            trabajadorTableClass::ID_CREDENCIAL,
            trabajadorTableClass::ID_CIUDAD,
            );
            $orderBy = array(
            trabajadorTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = trabajadorTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE ,$orderBy,'ASC', config::getRowGrid(),$page,$where);
            $this->defineView('index', 'trabajador',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
        private function Validate($nombre,$fecha_ini,$fecha_fin) {
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
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('trabajador', 'index');
        }
    }
}

