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
                    $where[insumoTableClass::NOMBRE] = $filter['nombre'];
                }
                if(isset($filter['fecha_fabricacion']) and $filter['fecha_fabricacion'] !== NULL and $filter['fecha_fabricacion'] !== ''){
                    $where[insumoTableClass::FECHA_FABRICACION] = $filter['fecha_fabricacion'];
                }
                if(isset($filter['fecha_vencimiento']) and $filter['fecha_vencimiento'] !== NULL and $filter['fecha_vencimiento'] !== ''){
                    $where[insumoTableClass::FECHA_VENCIMIENTO] = $filter['fecha_vencimiento'];
                }
                if(isset($filter['valor']) and $filter['valor'] !== NULL and $filter['valor'] !== ''){
                    $where[insumoTableClass::VALOR] = $filter['valor'];
                }
                session::getInstance()->setAttribute('insumoIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('insumoIndexFilters')){
            $where = session::getInstance()->getAttribute('insumoIndexFilters');
            }
            
            $fields= array(
            insumoTableClass::ID,
            insumoTableClass::NOMBRE,
            insumoTableClass::FECHA_FABRICACION,
            insumoTableClass::FECHA_VENCIMIENTO,
            insumoTableClass::VALOR,
            insumoTableClass::ID_TIPO_INSUMO
            );
            $orderBy = array(
            insumoTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = insumoTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objInsumo =  insumoTableClass::getAll($fields, FALSE,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

