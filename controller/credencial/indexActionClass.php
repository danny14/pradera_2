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
            $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE,
            credencialTableClass::CREATED_AT,
            credencialTableClass::UPDATED_AT
            );
            $this->objCredencial = credencialTableClass::getAll($fields, true);
            $this->defineView('index', 'credencial',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

