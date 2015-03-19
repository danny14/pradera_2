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
                $id = request::getInstance()->getCookie(fecundadorTableClass::getNameField(fecundadorTableClass::ID,TRUE));
                $nombre = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE));
                $edad = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE));
                $peso = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE));
                $observacion = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE));
                $id_raza = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE));
                
                $ids = array(
                fecundadorTableClass::ID => $id
                );
                $data = array(
                fecundadorTableClass::NOMBRE => $nombre,
                fecundadorTableClass::EDAD => $edad,
                fecundadorTableClass::PESO => $peso,
                fecundadorTableClass::OBSERVACION => $observacion,
                fecundadorTableClass::ID_RAZA => $id_raza
                );
                
                fecundadorTableClass::update($ids, $data);
            }
                routing::getInstance()->redirect('fecundador', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

