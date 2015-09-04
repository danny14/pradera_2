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
                if(isset($filter['fecha_parto']) and $filter['fecha_parto'] !== NULL and $filter['fecha_parto'] !== ''){
                    $where[reportePartoTableClass::FECHA_PARTO] = $filter['fecha_parto'];
                }
                
                if(isset($filter['N_animales_vi']) and $filter['N_animales_vi'] !== NULL and $filter['N_animales_vi'] !== ''){
                    $where[reportePartoTableClass::N_ANIMALES_VI] = $filter['N_animales_vi'];
                }
                 
                
                if (isset($filter['Animal']) and $filter['Animal'] !== null and $filter['Animal'] !== '') {//para la foranea no hay cambio
                    $where[reportePartoTableClass::ID_ANIMAL] = $filter['Animal'];
                }


                session::getInstance()->setAttribute('reportePartoIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('reportePartoIndexFilters')){
            $where = session::getInstance()->getAttribute('reportePartoIndexFilters');
            }
    

    

      $fields = array(
          reportePartoTableClass::ID,
          reportePartoTableClass::N_ANIMALES_VI,
          reportePartoTableClass::N_ANIMALES_M,
          reportePartoTableClass::N_MACHOS,
          reportePartoTableClass::N_HEMBRAS,
          reportePartoTableClass::OBSERVACIONES,
          reportePartoTableClass::ID_ANIMAL,
          reportePartoTableClass::FECHA_PARTO
          
      );
      $orderBy = array(
          reportePartoTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 10;
      }
      $this->cntPages = reportePartoTableClass::getTotalPages(3, $where);
      $this->objReporteParto = reportePartoTableClass::getAll($fields, FALSE, $orderBy, 'ASC', 10, $page, $where);
      
      //llamado de la foranea
      $fieldsAnimal = array(/* foranea animal */
                animalTableClass::ID,
                animalTableClass::NOMBRE,
            );
            $orderByAnimal = array(
                animalTableClass::NOMBRE
            );
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, false, $orderByAnimal, 'ASC');

      
      $this->defineView('index', 'reporte_parto', session::getInstance()->getFormatOutput());//direccionamiento
    } catch (PDOException $exc) {
      echo $exc->getMessage() . "<BR>" . print_r($exc->getTraceAsString());
    }
  }

}
