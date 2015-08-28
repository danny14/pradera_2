<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class viewActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {        
           if(request::getInstance()->hasRequest(registro_vacunacionTableClass::ID)){
               $fields = array (
               registro_vacunacionTableClass::ID,
               registro_vacunacionTableClass::FECHA_REGISTRO,
               registro_vacunacionTableClass::ID_TRABAJADOR
               
               );
               $where = array( 
               registro_vacunacionTableClass::ID => request::getInstance()->getRequest(registro_vacunacionTableClass::ID)
                       
             );
               $this->objRegistro_vacunacion =  registro_vacunacionTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
               $this->defineView('view', 'registro_vacunacion', session::getInstance()->getFormatOutput());
           }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

