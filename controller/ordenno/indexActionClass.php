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
                if(isset($filter['fecha_ordenno']) and $filter['fecha_ordenno'] !== NULL and $filter['fecha_ordenno'] !== ''){
                    $where[ordennoTableClass::FECHA_ORDENNO] = $filter['fecha_ordenno'];
                }
                if(isset($filter['cantidad_leche']) and $filter['cantidad_leche'] !== NULL and $filter['cantidad_leche'] !== ''){
                    $where[ordennoTableClass::CANTIDAD_LECHE] = $filter['cantidad_leche'];
              
                }
                session::getInstance()->setAttribute('ordennoIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('ordennoIndexFilters')){
            $where = session::getInstance()->getAttribute('ordennoIndexFilters');
            }
            
            $fields= array(
            ordennoTableClass::ID,
            ordennoTableClass::FECHA_ORDENNO,
            ordennoTableClass::CANTIDAD_LECHE,
            ordennoTableClass::ID_TRABAJADOR,
            ordennoTableClass::ID_ANIMAL
           
            );
            $orderBy = array(
            ordennoTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = ordennoTableClass::getTotalPages(config::getRowGrid(),$where);
            
            
            $this->objOrdenno =  ordennoTableClass::getAll($fields, FALSE,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'ordenno', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

