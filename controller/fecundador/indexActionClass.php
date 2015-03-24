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
                    $where[animalTableClass::NOMBRE] = $filter['nombre'];
                }
                if(isset($filter['edad']) and $filter['edad'] !== NULL and $filter['edad'] !== ''){
                    $where[fecundadorTableClass::NOMBRE] = $filter['edad'];
                }
                if(isset($filter['peso']) and $filter['peso'] !== NULL and $filter['peso'] !== ''){
                    $where[animalTableClass::PESO] = $filter['peso'];
                }
                session::getInstance()->setAttribute('fecundadorIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('fecundadorIndexFilters')){
            $where = session::getInstance()->getAttribute('fecundadorIndexFilters');
            }
            
            $fields= array(
            fecundadorTableClass::ID,
            fecundadorTableClass::NOMBRE,
            fecundadorTableClass::EDAD,
            fecundadorTableClass::PESO,
            fecundadorTableClass::OBSERVACION,
            fecundadorTableClass::ID_RAZA
            );
            $orderBy = array(
            fecundadorTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = fecundadorTableClass::getTotalPages(3,$where);
            $this->objFecundador =  fecundadorTableClass::getAll($fields, FALSE,$orderBy,'ASC',3,$page,$where);
            $this->defineView('index', 'fecundador', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

