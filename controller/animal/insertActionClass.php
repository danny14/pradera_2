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
            razaTableClass::ID,
            razaTableClass::DESCRIPCION
            );
            $orderBy = array(
            razaTableClass::DESCRIPCION
            );
            $this->objRaza = razaTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            
            $fields = array(
            estadoTableClass::ID,
            estadoTableClass::DESCRIPCION
            );
            $orderBy = array(
            estadoTableClass::DESCRIPCION
            );
            $this->objEstado = estadoTableClass::getAll($fields, FALSE, $orderBy,'ASC');
            $this->defineView('insert', 'animal',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

