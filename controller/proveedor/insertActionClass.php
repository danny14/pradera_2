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
            ciudadTableClass::ID,
            ciudadTableClass::DESCRIPCION
            );
            $orderBy= array(
            ciudadTableClass::DESCRIPCION
            );
            $this->objCiudad = ciudadTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRE,
            trabajadorTableClass::APELLIDO
            );
            $orderBy = array(
            trabajadorTableClass::NOMBRE
            );
            $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            $this->defineView('insert', 'proveedor', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

