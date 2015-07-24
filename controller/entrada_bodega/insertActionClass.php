<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class insertActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {

            $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRE,
            trabajadorTableClass::APELLIDO
            );
            $orderBy = array(
            trabajadorTableClass::NOMBRE
            );
            $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            
            $fields = array(
            proveedorBaseTableClass::ID,
            proveedorTableClass::NOMBRE,
            proveedorTableClass::APELLIDO
            );
            $orderBy = array(
            proveedorTableClass::NOMBRE
            );
            $this->objProveedor = proveedorTableClass::getAll($fields, FALSE, $orderBy,'ASC');
            $this->defineView('insert', 'entrada_bodega',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
}

