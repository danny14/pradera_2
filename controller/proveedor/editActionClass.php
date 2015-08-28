<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
class editActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->hasGet(proveedorTableClass::ID)){
                $fields = array(
                proveedorTableClass::ID,
                proveedorTableClass::NOMBRE,
                proveedorTableClass::APELLIDO,
                proveedorTableClass::DIRECCION,
                proveedorTableClass::TELEFONO,
                proveedorTableClass::CORREO,
                proveedorTableClass::ID_CIUDAD
                );
                $where = array(
                proveedorTableClass::ID => request::getInstance()->getGet(proveedorTableClass::ID)
                );
                $this->objProveedor = proveedorTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                 /*
                 * Este campo es para traer los datos de la foranea CIUDAD
                 */
                
                $fields = array(
                ciudadTableClass::ID,
                ciudadTableClass::DESCRIPCION
                );
                $orderBy = array(
                ciudadTableClass::DESCRIPCION
                );
//                $where = array(
//                ciudadTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_CIUAD)
//                );
                
                $this->objCiudad = ciudadTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                $this->defineView('edit', 'proveedor', session::getInstance()->getFormatOutput());
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}
