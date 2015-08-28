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
     * @return $nombre=> nombre (string)
     * todas estos datos se pasa en la varible @var $data
     * ** */
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $nombre = trim(request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE,TRUE)));
                
                $this->Validate($nombre);
                
                $data = array(
                credencialTableClass::NOMBRE => $nombre,
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
        $flag = FALSE;
        $fechaActual = date('Y-m-d');
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

        if ($nombre === '' or $nombre === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => credencialTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }else if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $nombre, '%character%' => credencialTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }else if (!preg_match("/^[a-zA-Z ]{3,80}$/", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => credencialTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('credencial', 'insert');
        }
    }

}

