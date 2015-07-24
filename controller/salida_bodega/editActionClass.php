<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasRequest(salidaBodegaTableClass::ID)){
                $fields= array(
                salidaBodegaTableClass::ID,
                salidaBodegaTableClass::FECHA,
                salidaBodegaTableClass::ID_TRABAJADOR,
                
                
                );
                $where = array(
                    salidaBodegaTableClass::ID => request::getInstance()->getRequest(salidaBodegaTableClass::ID)
                );
                $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                
                $fieldsTrabajador = array(
                 
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
                trabajadorTableClass::APELLIDO,
                trabajadorTableClass::DIRECCION,
                trabajadorTableClass::TELEFONO,
                trabajadorTableClass::ID_TURNO,
                trabajadorTableClass::ID_CREDENCIAL,
                trabajadorTableClass::ID_CIUDAD,
  
                );
//                $where = array(
//                trabajadorTableClass::ID => request::getInstance()->getRequest(salidaBodegaTableClass::ID_TRABAJADOR)
//                );
                
                $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'salida_bodega', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('salida_bodega', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
