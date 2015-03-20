<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')) {
                $fecha = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true));
                $hora = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, true));
                $id_tipo_doc = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TIPO_DOC, true));
                $id_trabajador = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, true));
                $id_proveedor = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, true));
       
                $data = array(
                entradaBodegaTableClass::FECHA => $fecha,
                entradaBodegaTableClass::HORA => $hora,
                entradaBodegaTableClass::ID_TIPO_DOC => $id_tipo_doc,
                entradaBodegaTableClass::ID_TRABAJADOR => $id_trabajador,
                entradaBodegaTableClass::ID_PROVEEDOR => $id_proveedor
                );
                
                entradaBodegaTableClass::insert($data);
                routing::getInstance()->redirect('entrada_bodega', 'index');
            } else {
                routing::getInstance()->redirect('entrada_bodega', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
