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
            
            $where = NULL;
            if(request::getInstance()->hasPost('filter')){
            $filter = request::getInstance()->getPost('filter');
            // aqui validar datos de filtros
            if(isset($filter['descripcion']) and $filter['descripcion'] !== NULL and $filter['descripcion'] !== ''){
            $where[estadoTableClass::DESCRIPCION] = $filter['descripcion'];
            }
            
            session::getInstance()->setAttribute('estadoIndexFilters', $where);
            }else if(session::getInstance()->hasAttribute('estadoIndexFilters')){
                
            $where = session::getInstance()->getAttribute('estadoIndexFilters');
            
            
            }
            
                

            $fields = array(
            estadoTableClass::ID,
            estadoTableClass::DESCRIPCION
            );
            $orderBy = array(
            estadoTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = estadoTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objEstado = estadoTableClass::getAll($fields, false,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'estado',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

