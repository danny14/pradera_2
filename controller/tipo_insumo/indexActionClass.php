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
                if(isset($filter['descripcion']) and $filter['descripcion'] !== NULL and $filter['descripcion'] !== ''){
                    $where[tipoInsumoTableClass::DESCRIPCION] = $filter['descripcion'];
               
                }
                session::getInstance()->setAttribute('tipoInsumoIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('tipoInsumoIndexFilters')){
            $where = session::getInstance()->getAttribute('tipoInsumoIndexFilters');
            }
            
            $fields= array(
            tipoInsumoTableClass::ID,
            tipoInsumoTableClass::DESCRIPCION,
           
            );
            $orderBy = array(
            tipoInsumoTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = tipoInsumoTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objTipoInsumo =  tipoInsumoTableClass::getAll($fields, FALSE,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'tipo_insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

