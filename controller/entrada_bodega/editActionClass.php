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
            if(request::getInstance()->hasGet(entradaBodegaTableClass::ID)){
                $fields= array(
                entradaBodegaTableClass::ID,
                entradaBodegaTableClass::FECHA,
                entradaBodegaTableClass::HORA,
                entradaBodegaTableClass::ID_TRABAJADOR,
                entradaBodegaTableClass::ID_PROVEEDOR,
                );
                $where = array(
                    entradaBodegaTableClass::ID => request::getInstance()->getGet(entradaBodegaTableClass::ID)
                );
                $this->objEntradaBodega = entradaBodegaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                
                $fields = array(
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE
                );
//                $where = array(
//                razaTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_RAZA)
//                );
                $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                
                $fields = array(
                proveedorTableClass::ID,
                proveedorTableClass::NOMBRE
                );
//                $where = array(
//                estadoTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_ESTADO)
//                );
                
                $this->objProveedor = proveedorTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'entrada_bodega', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('entrada_bodega', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
