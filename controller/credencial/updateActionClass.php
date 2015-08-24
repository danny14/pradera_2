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
                $id = trim(request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID,true)));
                $nombre = trim(request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE ,true)));
                
                $ids= array(
                credencialTableClass::ID => $id
                );
                $data = array(
                credencialTableClass::NOMBRE => $nombre,
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
    private function Validate($nombre) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

        if ($nombre === '' or $nombre === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => credencialTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }else if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $nombre, '%character%' => credencialTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }else if (!ereg("^[a-zA-Z ]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => credencialTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(credencialTableClass::ID => request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID,true))));
            routing::getInstance()->forward('credencial', 'insert');
        }
    }
}

