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
                if(isset($filter['nombre']) and $filter['nombre'] !== NULL and $filter['nombre'] !== ''){
                    $where[animalTableClass::NOMBRE] = $filter['nombre'];
                }
                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
                    $where[animalTableClass::FECHA_INGRESO] = array(
                        $filter['fechaCreacion1'],
                        $filter['fechaCreacion2']
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
                    );
                }
                //session::getInstance()->setAttribute('animalIndexFilters', $where);
            } //else if(session::getInstance()->hasAttribute('animalIndexFilters')){
//                $where = session::getInstance()->getAttribute('animalIndexFilters');
//            }
            $fields = array(
            animalTableClass::ID,
            animalTableClass::NOMBRE,
            animalTableClass::GENERO,
            animalTableClass::EDAD,
            animalTableClass::PESO,
            animalTableClass::FECHA_INGRESO,
            animalTableClass::NUMERO_PARTOS,
            animalTableClass::ID_RAZA,
            animalTableClass::ID_ESTADO
            );
            $orderBy = array(
            animalTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = animalTableClass::getTotalPages(3,$where);
            $this->objAnimal = animalTableClass::getAll($fields, FALSE ,$orderBy,'ASC',  3,$page,$where);
            $this->defineView('index', 'animal',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage()."<BR>".print_r($exc->getTraceAsString());
            
        }
    }
}

