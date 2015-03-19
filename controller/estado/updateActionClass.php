<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class updateActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $id = request::getInstance()->getPost(estadoTableClass::getNameField(estadoTableClass::ID,true));
                $descripcion = request::getInstance()->getPost(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION ,true));
                
                $ids= array(
                estadoTableClass::ID => $id
                );
                $data = array(
                estadoTableClass::DESCRIPCION => $descripcion
                );

                estadoTableClass::update($ids, $data);
            }
                routing::getInstance()->redirect('estado', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

