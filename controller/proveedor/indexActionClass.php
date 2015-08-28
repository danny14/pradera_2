<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class indexActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            /**
             * filtros para el index con paginacion incluida
             */
            $where = NULL;
            if(request::getInstance()->hasPost('filter')){
                $filter = request::getInstance()->getPost('filter');
                // aqui validar datos de filtros
                if(isset($filter['nombre']) and $filter['nombre'] !== NULL and $filter['nombre'] !== ''){
                    $nombre = $filter['nombre'];
                    $this->validateName($nombre);
                    $where[proveedorTableClass::NOMBRE] = $nombre;
                }
                if(isset($filter['apellido']) and $filter['apellido'] !== NULL and $filter['apellido'] !== ''){
                    $where[proveedorTableClass::APELLIDO] = $filter['apellido'];
                }
                if(isset($filter['direccion']) and $filter['direccion'] !== NULL and $filter['direccion'] !== ''){
                    $where[proveedorTableClass::DIRECCION] = $filter['direccion'];
                }
                if(isset($filter['telefono']) and $filter['telefono'] !== NULL and $filter['telefono'] !== ''){
                    $where[proveedorTableClass::TELEFONO] = $filter['telefono'];
                }
                 if(isset($filter['correo']) and $filter['correo'] !== NULL and $filter['correo'] !== ''){
                    $where[proveedorTableClass::CORREO] = $filter['correo'];
                }
                session::getInstance()->setAttribute('proveedorIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('proveedorIndexFilters')){
            $where = session::getInstance()->getAttribute('proveedorIndexFilters');
            }
            
            $fields= array(
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
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = proveedorTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objProveedor =  proveedorTableClass::getAll($fields, FALSE,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'proveedor', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

