<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class createActionClass extends controllerClass implements controllerActionInterface{
     /* public function execute inicializa las variables 
     * @return $descripcion=> descripcion (string)
     * todas estos datos se pasa en la varible @var $data
     * ** */
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $descripcion = trim(request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION,TRUE)));
                
                $this->Validate($descripcion);
                
                $data = array(
                ciudadTableClass::DESCRIPCION => $descripcion
                );
                
                ciudadTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fuero registrados de forma exitosa');
                routing::getInstance()->redirect('ciudad', 'index');
            }else{
                routing::getInstance()->redirect('ciudad', 'index');
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function Validate($descripcion) {
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
            routing::getInstance()->forward('ciudad', 'insert');
        }
    }

}

