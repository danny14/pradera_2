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
                $descripcion = trim(request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION,TRUE)));
                $this->Validate($descripcion);
                $data = array(
                razaTableClass::DESCRIPCION => $descripcion
                );
                
                razaTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fuero registrados de forma exitosa');
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
        $flag = FALSE;
        /*
         * Validacion para Descripcion
         */
        if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => razaTableClass::DESCRIPCION)));
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }elseif (strlen($descripcion) > razaTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => razaTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }elseif (!preg_match('/^[a-zA-Z ]*$/', $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => razaTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('raza', 'insert');
        }
    }

}

