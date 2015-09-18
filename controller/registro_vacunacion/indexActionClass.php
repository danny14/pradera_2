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
                if(isset($filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE).'_1']) and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE).'_1'] !== NULL and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE).'_1'] !== '' and isset($filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE).'_2']) and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE).'_2'] !== NULL and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE).'_2'] !== ''){
                    
                    $fecha_ini = $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE).'_1'];
                    $fecha_fin = $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE).'_2'];
//                    $this->ValidateFecha($fecha_ini, $fecha_fin);
                    $where[registroVacunacionTableClass::FECHA_REGISTRO] = array(
                        $fecha_ini,
                        $fecha_fin
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
                    );
                }
                 if(isset($filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)]) and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)] !== NULL and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)] !== ''){
                    $id_animal = $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)];
                     $where[registroVacunacionTableClass::ID_ANIMAL] = $id_animal;
                }
                 if(isset($filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE)]) and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE)] !== NULL and $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE)] !== ''){
                     $id_insumo = $filter[registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE)];
                    $where[registroVacunacionTableClass::HORA_VACUNA] = $id_insumo;
                 }
                 
                    
                session::getInstance()->setAttribute('registroVacunacionIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('registroVacunacionIndexFilters')){
            $where = session::getInstance()->getAttribute('registroVacunacionIndexFilters');
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
            insumoTableClass::ID,
            insumoTableClass::NOMBRE
            );
            $orderBy = array(
            insumoTableClass::NOMBRE
            );
            $this->objInsumo = insumoTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            
            $fields= array(
            registroVacunacionTableClass::ID,
            registroVacunacionTableClass::FECHA_REGISTRO,
            registroVacunacionTableClass::DOSIS_VACUNA,
            registroVacunacionTableClass::HORA_VACUNA,
            registroVacunacionTableClass::ID_ANIMAL,
            registroVacunacionTableClass::ID_INSUMO,
            registroVacunacionTableClass::ID_TRABAJADOR
            );
            $orderBy = array(
            registroVacunacionTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = registroVacunacionTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objRegistroVacunacion =  registroVacunacionTableClass::getAll($fields, FALSE,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'registro_vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

