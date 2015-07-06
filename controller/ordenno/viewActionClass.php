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
           if(request::getInstance()->hasRequest(ordennoTableClass::ID)){
               $fields = array (
               ordennoTableClass::ID,
               ordennoTableClass::FECHA_ORDENNO,
               ordennoTableClass::CANTIDAD_LECHE,
               ordennoTableClass::ID_TRABAJADOR,
               ordennoTableClass::ID_ANIMAL
               
               );
               $where = array( 
               ordennoTableClass::ID => request::getInstance()->getRequest(ordennoTableClass::ID)
                       
             );
               $this->objOrdenno =  ordennoTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
               $this->defineView('view', 'ordenno', session::getInstance()->getFormatOutput());
           }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

