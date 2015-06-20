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
//            if (request::getInstance()->hasPost('filter')) {
//                $filter = request::getInstance()->getPost('filter');
//                // aqui validar datos de filtros
//                if (isset($filter['descripcion']) and $filter['descripcion'] !== NULL and $filter['descripcion'] !== '') {
//                    $where[credencialTableClass::DESCRIPCION] = $filter['descripcion'];
//                }
//                session::getInstance()->setAttribute('credencialIndexFilters', $where);
//            } else if (session::getInstance()->hasAttribute('credencialIndexFilters')) {
//                $where = session::getInstance()->getAttribute('credencialIndexFilters');
//            }
            $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE,
            credencialTableClass::CREATED_AT,
            credencialTableClass::UPDATED_AT,
            credencialTableClass::DELETED_AT
            );
            $orderBy = array(
            credencialTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = credencialTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objCredencial = credencialTableClass::getAll($fields, false,$orderBy,'ASC',config::getRowGrid(),$page);
            $this->defineView('index', 'credencial',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

