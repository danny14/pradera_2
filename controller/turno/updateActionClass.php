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
                $id = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID,true));
                $descripcion = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION ,true));
                
                $ids= array(
                razaTableClass::ID => $id
                );
                $data = array(
                razaTableClass::DESCRIPCION => $descripcion
                );

                razaTableClass::update($ids, $data);
            }
                routing::getInstance()->redirect('raza', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

