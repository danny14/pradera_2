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
            bitacoraTableClass::ID,
            bitacoraTableClass::USUARIO_ID,
            bitacoraTableClass::ACCION,
            bitacoraTableClass::TABLA,
            bitacoraTableClass::REGISTRO,
            bitacoraTableClass::OBSERVACION,
            bitacoraTableClass::FECHA
            
            );
            $this->objBitacora = bitacoraTableClass::getAll($fields, false);
            $this->defineView('index', 'bitacora',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage()."<BR>".print_r($exc->getTraceAsString());
            
        }
    }
}

