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
                $this->Validate($descripcion);
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
    private function Validate($descripcion) {
        if (strlen($descripcion) > razaTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => razaTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => razaTableClass::DESCRIPCION)));
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('raza', 'insert');
        }
    }

}

