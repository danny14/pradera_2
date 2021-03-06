<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class indexActionClass extends controllerClass implements controllerActionInterface {
  public function execute() {
        try {
          //$pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
            /**
             * filtros para el index con paginacion incluida
             */
             $where = NULL;
            if(request::getInstance()->hasPost('filter')){
                $filter = request::getInstance()->getPost('filter');
                // aqui validar datos de filtros
                if(isset($filter['Animal']) and $filter['Animal'] !== NULL and $filter['Animal'] !== ''){
                    $where[registroCeloTableClass::ID_ANIMAL] = $filter['Animal'];
                }
                
                  if(isset($filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE).'_1']) and $filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE).'_1'] !== NULL and $filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE).'_1'] !== '' and isset($filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE).'_2']) and $filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE).'_2'] !== NULL and $filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE).'_2'] !== ''){
                    $fecha_ini = $filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA,TRUE).'_1'];
                    $fecha_fin = $filter[registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE).'_2'];
                    $this->ValidateFecha( $fecha_ini, $fecha_fin);
                    $where[registroCeloTableClass::FECHA] = array(
                        $fecha_ini,
                        $fecha_fin
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
                    );
                }

                session::getInstance()->setAttribute('registroCeloIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('registroCeloIndexFilters')){
            $where = session::getInstance()->getAttribute('registroCeloIndexFilters');
            }
    

      $fields = array(
          registroCeloTableClass::ID,
          registroCeloTableClass::FECHA,
          registroCeloTableClass::ID_FECUNDADOR,
          registroCeloTableClass::ID_ANIMAL,
      );
      $orderBy = array(
          registroCeloTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 10;
      }
      $this->cntPages = registroCeloTableClass::getTotalPages(3, $where);
      $this->objRegistroCelo = registroCeloTableClass::getAll($fields, FALSE, $orderBy, 'ASC', 10, $page, $where);
      //llamado de la foranea
      $fieldsAnimal = array(/* foranea animal */
                animalTableClass::ID,
                animalTableClass::NOMBRE,
            );
            $orderByAnimal = array(
                animalTableClass::NOMBRE
            );
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, false, $orderByAnimal, 'ASC');

      
      $this->defineView('index', 'registro_celo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage() . "<BR>" . print_r($exc->getTraceAsString());
    }
  }

}
