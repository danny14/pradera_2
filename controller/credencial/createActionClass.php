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
                $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE,TRUE));
                $created_at = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::CREATED_AT,TRUE));
                $updated_at = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::UPDATED_AT,TRUE));
                $deleted_at = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::DELETED_AT,TRUE));
                $this->Validate($nombre,$created_at,$updated_at,$deleted_at);
                $data = array(
                credencialTableClass::NOMBRE => $nombre,
                credencialTableClass::CREATED_AT => $created_at,
                credencialTableClass::UPDATED_AT => $updated_at,
                credencialTableClass::DELETED_AT => $deleted_at
                    
                );
                
                credencialTableClass::insert($data);
                routing::getInstance()->redirect('credencial', 'index');
            }else{
                routing::getInstance()->redirect('credencial', 'index');
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function Validate($nombre) {
        if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $nombre, '%character%' => credencialTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }
        if ($nombre === '' or $nombre === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => credencialTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('credencial', 'insert');
        }
    }

}

