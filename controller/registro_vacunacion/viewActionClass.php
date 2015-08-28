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
           if(request::getInstance()->hasRequest(registroVacunacionTableClass::ID)){
               $fields = array (
               registroVacunacionTableClass::ID,
               registroVacunacionTableClass::FECHA_REGISTRO,
               registroVacunacionTableClass::ID_TRABAJADOR,
               registroVacunacionTableClass::HORA_VACUNA,
               registroCeloTableClass::ID_ANIMAL,
               registroVacunacionTableClass::ID_INSUMO
               
               );
               $where = array( 
               registroVacunacionTableClass::ID => request::getInstance()->getRequest(registroVacunacionTableClass::ID)
                       
             );
               $this->objRegistroVacunacion =  registroVacunacionTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
               $this->defineView('view', 'registro_vacunacion', session::getInstance()->getFormatOutput());
           }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

