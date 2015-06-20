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
           if(request::getInstance()->hasRequest(proveedorTableClass::ID)){
               $fields = array (
               proveedorTableClass::ID,
               proveedorTableClass::NOMBRE,
               proveedorTableClass::APELLIDO,
               proveedorTableClass::DIRECCION,
               proveedorTableClass::TELEFONO,
               proveedorTableClass::CORREO,
               proveedorTableClass::ID_CIUDAD,
               );
               $where = array( 
               proveedorTableClass::ID => request::getInstance()->getRequest(proveedorTableClass::ID)
                       
             );
               $this->objProveedor =  proveedorTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
               $this->defineView('view', 'proveedor', session::getInstance()->getFormatOutput());
           }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

