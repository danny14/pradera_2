<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')) {
                $descripcion = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, true));
       
                $data = array(
                ciudadTableClass::DESCRIPCION => $descripcion
                );
                
                ciudadTableClass::insert($data);
                routing::getInstance()->redirect('ciudad', 'index');
            } else {
                routing::getInstance()->redirect('ciudad', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
