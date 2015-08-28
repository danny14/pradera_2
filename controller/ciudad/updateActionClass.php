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
                $id = trim(request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID,true)));
                $descripcion = trim(request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION ,true)));
                
                $this->Validate($descripcion);
                
                $ids= array(
                ciudadTableClass::ID => $id
                );
                $data = array(
                ciudadTableClass::DESCRIPCION => $descripcion
                );

                ciudadTableClass::update($ids, $data);
            }
                session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
                routing::getInstance()->redirect('ciudad', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    
    private function Validate($descripcion) {
        
        $fechaActual = date('Y-m-d');
        $flag = FALSE;
        
        /*
         * VALIDACION PARA DESCRIPCION
         */
         if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ciudadTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE), TRUE);
        }  else if (strlen($descripcion) > ciudadTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => ciudadTableClass::NOMBRE_LENGTH)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE), TRUE);
        }else if (!ereg("^[a-zA-Z ]{3,80}$", $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => ciudadTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(ciudadTableClass::ID => request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID,true))));
            routing::getInstance()->forward('ciudad', 'insert');
        }
    }
}

