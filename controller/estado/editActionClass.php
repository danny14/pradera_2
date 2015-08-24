<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class editActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->hasGet(estadoTableClass::ID)){
                
                $fields = array(
                estadoTableClass::ID,
                estadoTableClass::DESCRIPCION
                );
                $where = array(
                estadoTableClass::ID => request::getInstance()->getGet(estadoTableClass::ID)
                );
                $this->objEstado = estadoTableClass::getAll($fields, FALSE , NULL, NULL, NULL, NULL, $where);
                $this->defineView('edit', 'estado', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('estado', 'index');
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

