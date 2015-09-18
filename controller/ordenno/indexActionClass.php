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

                if(isset($filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_1']) and $filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_1'] !== NULL and $filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_1'] !== '' and isset($filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_2']) and $filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_2'] !== NULL and $filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_2'] !== ''){
                    $fecha_ini = $filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO,TRUE).'_1'];
                    $fecha_fin = $filter[ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE).'_2'];
                    //$this->ValidateFecha($fecha_ini, $fecha_fin);
                    $where[ordennoTableClass::FECHA_ORDENNO] = array(
                        $fecha_ini,
                        $fecha_fin
                    );
                }
                
                if(isset($filter[ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)]) and $filter[ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)] !== NULL and $filter[ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)] !== ''){
                    $id_animal = $filter[ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE)];
                    $where[ordennoTableClass::ID_ANIMAL] = $id_animal;
                }
                
                session::getInstance()->setAttribute('ordennoIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('ordennoIndexFilters')){
            $where = session::getInstance()->getAttribute('ordennoIndexFilters');
            }
            $fields = array(
            animalTableClass::ID,
            animalTableClass::NOMBRE
            );
            $orderBy = array(
            animalTableClass::NOMBRE
            );
            $this->objAnimal = animalTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            
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

