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
                $descripcion = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION,TRUE));
                $this->Validate($descripcion);
                $data = array(
                turnoTableClass::DESCRIPCION => $descripcion
                );
                
                turnoTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fuero registrados de forma exitosa');
                routing::getInstance()->redirect('turno', 'index');
            }else{
                routing::getInstance()->redirect('turno', 'index');
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function Validate($descripcion) {
        if (strlen($descripcion) > turnoTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => turnoTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => turnoTableClass::DESCRIPCION)));
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('turno', 'insert');
        }
    }

}

