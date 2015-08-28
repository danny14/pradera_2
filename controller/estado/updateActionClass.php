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
                $id = trim(request::getInstance()->getPost(estadoTableClass::getNameField(estadoTableClass::ID,true)));
                $descripcion = trim(request::getInstance()->getPost(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION ,true)));
                
                $this->Validate($descripcion);
                
                $ids= array(
                estadoTableClass::ID => $id
                );
                $data = array(
                estadoTableClass::DESCRIPCION => $descripcion
                );

                estadoTableClass::update($ids, $data);
            }
                session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
                routing::getInstance()->redirect('estado', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function Validate($descripcion) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => estadoTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE), TRUE);
        }  else if (strlen($descripcion) > estadoTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => estadoTableClass::NOMBRE_LENGTH)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE), TRUE);
        }else if (!preg_match("/^[a-zA-Z ]{3,140}$/", $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => estadoTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(estadoTableClass::ID => request::getInstance()->getPost(estadoTableClass::getNameField(estadoTableClass::ID,true))));
            routing::getInstance()->forward('estado', 'insert');
        }
    }
}

