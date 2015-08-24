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
                $id = trim(request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID,true)));
                $descripcion = trim(request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION ,true)));
                
                $ids= array(
                razaTableClass::ID => $id
                );
                $data = array(
                razaTableClass::DESCRIPCION => $descripcion
                );

                razaTableClass::update($ids, $data);
            }
                session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
                routing::getInstance()->redirect('raza', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }

    private function Validate($descripcion) {
        /*
         * Falta Validar Caracteres Especiales xD
         */
        if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => razaTableClass::DESCRIPCION)).'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }else if (strlen($descripcion) > razaTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => razaTableClass::NOMBRE_LENGTH)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }else if (!ereg("^[a-zA-Z ]{3,140}$", $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => razaTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(razaTableClass::ID => request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID,true))));
            routing::getInstance()->forward('raza', 'insert');
        }
    }

}

