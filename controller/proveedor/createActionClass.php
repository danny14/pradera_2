<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class createActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                 $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE));
                 $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE));
                 $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION ,TRUE));
                 $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorBaseTableClass::TELEFONO,TRUE));
                 $correo = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE));
                 $id_ciudad = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, TRUE));
                 
                 $data = array(
                 proveedorTableClass::NOMBRE => $nombre,
                 proveedorTableClass::APELLIDO => $apellido,
                 proveedorTableClass::DIRECCION => $direccion,
                 proveedorTableClass::TELEFONO => $telefono,
                 proveedorTableClass::CORREO => $correo,
                 proveedorTableClass::ID_CIUDAD => $id_ciudad
                 );
                 
                 proveedorTableClass::insert($data);
                 routing::getInstance()->redirect('proveedor', 'index');
            }else{
                routing::getInstance()->redirect('proveedor', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

