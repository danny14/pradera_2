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
           if(request::getInstance()->hasRequest(tipo_insumoTableClass::ID)){
               $fields = array (
               tipo_insumoTableClass::ID,
               tipo_insumoTableClass::DESCRIPCION,
             
               );
               $where = array( 
               tipo_insumoTableClass::ID => request::getInstance()->getRequest(tipo_insumoTableClass::ID)
                       
             );
               $this->objTipo_insumo =  tipo_insumoTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
               $this->defineView('view', 'tipo_insumo', session::getInstance()->getFormatOutput());
           }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

