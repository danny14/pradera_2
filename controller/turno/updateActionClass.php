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
                $id = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::ID,true));
                $descripcion = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION ,true));
                
                $ids= array(
                turnoTableClass::ID => $id
                );
                $data = array(
                turnoTableClass::DESCRIPCION => $descripcion
                );

                turnoTableClass::update($ids, $data);
            }
                routing::getInstance()->redirect('turno', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

