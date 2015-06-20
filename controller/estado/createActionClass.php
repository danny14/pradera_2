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
                $descripcion = request::getInstance()->getPost(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION,TRUE));
                $this->Validate($descripcion);
                $data = array(
                estadoTableClass::DESCRIPCION => $descripcion
                );
                
                estadoTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos Fueron registrados exitosamente');
                routing::getInstance()->redirect('estado', 'index');
            }else{
                routing::getInstance()->redirect('estado', 'index');
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function Validate($descripcion) {
        
        if (strlen($descripcion) > estadoTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => estadoTableClass::DESCRIPCION_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE), TRUE);
        }

        if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => estadoTableClass::DESCRIPCION)));
            $flag = TRUE;
            session::getInstance()->setFlash(estadoTableClass::getNameField(estadoTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('estado', 'insert');
        }
    }

}

