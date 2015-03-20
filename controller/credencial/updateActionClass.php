<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $id = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID,true));
                $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE ,true));
                $created_at = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::CREATED_AT, true));
                
                $ids= array(
                credencialTableClass::ID => $id
                );
                $data = array(
                credencialTableClass::NOMBRE => $nombre,
                credencialTableClass::CREATED_AT => $created_at
                );

                credencialTableClass::update($ids, $data);
            }
            routing::getInstance()->redirect('credencial', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
