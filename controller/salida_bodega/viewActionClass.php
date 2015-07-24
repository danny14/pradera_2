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
          if(request::getInstance()->hasRequest(salidaBodegaTableClass::ID)){
            $fields = array(
            salidaBodegaTableClass::ID,
            salidaBodegaTableClass::FECHA,
            salidaBodegaTableClass::ID_TRABAJADOR,    
            );
            $where = array(
            salidaBodegaTableClass::ID => request::getInstance()->getRequest(salidaBodegaTableClass::ID)
            );
            
                $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'salida_bodega', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('salida_bodega', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
