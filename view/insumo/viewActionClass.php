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
           if(request::getInstance()->hasRequest(insumoTableClass::ID)){
               $fields = array (
               insumoTableClass::ID,
               insumoTableClass::NOMBRE,
               insumoTableClass::FECHA_FABRICACION,
               insumoTableClass::FECHA_VENCIMIENTO,
               insumoTableClass::VALOR,
               insumoTableClass::ID_TIPO_INSUMO,
               );
               $where = array( 
               insumoTableClass::ID => request::getInstance()->getRequest(insumoTableClass::ID)
                       
             );
               $this->objInsumo =  insumoTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
               $this->defineView('view', 'insumo', session::getInstance()->getFormatOutput());
           }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

