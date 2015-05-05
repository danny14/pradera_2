<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasGet(trabajadorTableClass::ID)){
                $fields= array(
                animalTableClass::ID,
                animalTableClass::NOMBRE,
                animalTableClass::APELLIDO,
                animalTableClass::DIRECCION,
                animalTableClass::TELEFONO,
                animalTableClass::ID_TURNO,
                animalTableClass::ID_CREDENCIAL,
                animalTableClass::ID_CIUDAD
                );
                $where = array(
                    trabajadorTableClass::ID => request::getInstance()->getGet(trabajadorTableClass::ID)
                );
                $this->objAnimal = trabajadorTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                
                $fields = array(
                turnoTableClass::ID,
                turnoTableClass::DESCRIPCION
                );
//                $where = array(
//                razaTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_RAZA)
//                );
                $this->objTurno = turnoTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                
                $fields = array(
                credencialTableClass::ID,
                credencialTableClass::NOMBRE
                );
//                $where = array(
//                estadoTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_ESTADO)
//                );
                
                $this->objCredencial = credencialTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                
                $fields = array(
                ciudadTableClass::ID,
                ciudadTableClass::DESCRIPCION
                );
//                $where = array(
//                estadoTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_ESTADO)
//                );
                
                $this->objCiudad = ciudadTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'trabajador', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('trabajador', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
