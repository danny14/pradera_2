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
                if(isset($filter[proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE)]) and $filter[proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE)] !== NULL AND $filter[proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE)] !== ''){
                        $nombre = $filter[proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE)];
                        $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
                }
                if(isset($filter[proveedorTableClass::getNameField(proveedorTableClass::APELLIDO,TRUE)]) and $filter[proveedorTableClass::getNameField(proveedorTableClass::APELLIDO,TRUE)] !== NULL AND $filter[proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE)] !== ''){
                        $apellido = $filter[proveedorTableClass::getNameField(proveedorTableClass::APELLIDO,TRUE)];
                        $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
                }
                if(isset($filter[proveedorTableClass::getNameField(proveedorTableClass::DIRECCION,TRUE)]) and $filter[proveedorTableClass::getNameField(proveedorTableClass::DIRECCION,TRUE)] !== NULL AND $filter[proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE)] !== ''){
                        $direccion = $filter[proveedorTableClass::getNameField(proveedorTableClass::DIRECCION,TRUE)];
                        $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::DIRECCION) . ' LIKE ' . '\'' . $direccion . '%\'  '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::DIRECCION) . ' LIKE ' . '\'%' . $direccion . '%\' '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::DIRECCION) . ' LIKE ' . '\'%' . $direccion . '\') ';
                }
                if(isset($filter[proveedorTableClass::getNameField(proveedorTableClass::TELEFONO,TRUE)]) and $filter[proveedorTableClass::getNameField(proveedorTableClass::TELEFONO,TRUE)] !== NULL AND $filter[proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE)] !== ''){
                        $telefono = $filter[proveedorTableClass::getNameField(proveedorTableClass::TELEFONO,TRUE)];
                        $where[proveedorTableClass::TELEFONO] = $telefono;
                }
                if(isset($filter[proveedorTableClass::getNameField(proveedorTableClass::CORREO,TRUE)]) and $filter[proveedorTableClass::getNameField(proveedorTableClass::CORREO,TRUE)] !== NULL AND $filter[proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE)] !== ''){
                        $correo = $filter[proveedorTableClass::getNameField(proveedorTableClass::CORREO,TRUE)];
                        $where[] = '(' . proveedorTableClass::getNameField(proveedorTableClass::CORREO) . ' LIKE ' . '\'' . $correo . '%\'  '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::CORREO) . ' LIKE ' . '\'%' . $correo . '%\' '
                                . 'OR ' . proveedorTableClass::getNameField(proveedorTableClass::CORREO) . ' LIKE ' . '\'%' . $correo . '\') ';
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

