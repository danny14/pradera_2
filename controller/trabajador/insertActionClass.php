<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class insertActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {

            $fields = array(
            turnoTableClass::ID,
            turnoTableClass::DESCRIPCION
            );
            $orderBy = array(
            turnoTableClass::DESCRIPCION
            );
            $this->objTurno = turnoTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            
            $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE
            );
            $orderBy = array(
            credencialTableClass::NOMBRE
            );
            $this->objCredencial = credencialTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            
            $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::DESCRIPCION
            );
            $orderBy = array(
            ciudadTableClass::DESCRIPCION
            );
            $this->objCiudad = ciudadTableClass::getAll($fields, FALSE, $orderBy,'ASC');
            $this->defineView('insert', 'trabajador',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
}

