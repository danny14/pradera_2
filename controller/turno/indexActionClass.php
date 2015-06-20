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
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
                // aqui validar datos de filtros
                if (isset($filter['descripcion']) and $filter['descripcion'] !== NULL and $filter['descripcion'] !== '') {
                    $where[turnoTableClass::DESCRIPCION] = $filter['descripcion'];
                }
                session::getInstance()->setAttribute('turnoIndexFilters', $where);
            } else if (session::getInstance()->hasAttribute('turnoIndexFilters')) {
                $where = session::getInstance()->getAttribute('turnoIndexFilters');
            }
            $fields = array(
            turnoTableClass::ID,
            turnoTableClass::DESCRIPCION
            );
            $orderBy = array(
            turnoTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = turnoTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objTurno = turnoTableClass::getAll($fields, false,$orderBy,'ASC',config::getRowGrid(),$page);
            $this->defineView('index', 'turno',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

