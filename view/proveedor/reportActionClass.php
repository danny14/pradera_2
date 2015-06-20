<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class reportActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            $where = NULL ;
            if(request::getInstance()->hasPost('report')){
                $report =  request::getInstance()->getPost('report');
                
                if( isset($report['nombre']) and $report['nombre'] !== NULL and $report['nombre'] !== ''){
                    $where[proveedorTableClass::NOMBRE] = $report['nombre'];
                }
                
                if( isset($report['apellido']) and $report['apellido'] !== NULL and $report['apellido'] !== ''){
                    $where[proveedorTableClass::APELLIDO] = $report['apellido'];
                }
                
                if( isset($report['direccion']) and $report['direccion'] !== NULL and $report['direccion'] !== ''){
                    $where[proveedorTableClass::DIRECCION] = $report['direccion'];
                }
                 if( isset($report['telefono']) and $report['telefono'] !== NULL and $report['telefono'] !== ''){
                    $where[proveedorTableClass::TELEFONO] = $report['telefono'];
                }
                if( isset($report['correo']) and $report['correo'] !== NULL and $report['correo'] !== ''){
                    $where[proveedorTableClass::CORREO] = $report['correo'];
                }
                $fields = array(
                proveedorTableClass::ID,
                proveedorTableClass::NOMBRE,
                proveedorTableClass::APELLIDO,
                proveedorTableClass::DIRECCION,
                proveedorTableClass::TELEFONO,
                proveedorTableClass::CORREO,
                proveedorTableClass::ID_CIUDAD
                );
                $orderBy = array(
                proveedorTableClass::ID
                    
                );
                $this->objProveedor = proveedorTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL , NULL , $where);
                $this->defineView('report', 'proveedor', session::getInstance()->getFormatOutput());
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            
        }
    }
    }

