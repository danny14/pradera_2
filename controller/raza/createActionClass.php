<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class createActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $descripcion = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION,TRUE));
                
                $data = array(
                razaTableClass::DESCRIPCION => $descripcion
                );
                
                razaTableClass::insert($data);
                routing::getInstance()->redirect('raza', 'index');
            }else{
                routing::getInstance()->redirect('raza', 'index');
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

