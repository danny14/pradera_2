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
                if(isset($filter['fecha']) and $filter['fecha'] !== NULL and $filter['fecha'] !== ''){
                    $where[salidaBodegaTableClass::FECHA] = $filter['fecha'];
                }
                
                if (isset($filter['Trabajador']) and $filter['Trabajador'] !== null and $filter['Trabajador'] !== '') {//para la foranea no hay cambio
                    $where[salidaBodegaTableClass::ID_TRABAJADOR] = $filter['Trabajador'];
                }
                
                 
//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[registroCeloTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
                session::getInstance()->setAttribute('salidaBodegaIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('salidaBodegaIndexFilters')){
            $where = session::getInstance()->getAttribute('salidaBodegaIndexFilters');
            }
    

      $fields = array(
          salidaBodegaTableClass::ID,
          salidaBodegaTableClass::FECHA,
          salidaBodegaTableClass::ID_TRABAJADOR,
      );
      $orderBy = array(
          salidaBodegaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 3;
      }
      $this->cntPages = salidaBodegaTableClass::getTotalPages(3, $where);
      $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, FALSE, $orderBy, 'ASC', 3, $page, $where);
////       llamado de la foranea
      $fieldsTrabajador = array(/* foranea trabajador */
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
                
              
              );
            $orderByTrabajador = array(
                trabajadorTableClass::NOMBRE
            );
            $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, false, $orderByTrabajador, 'ASC');

     
      $this->defineView('index', 'salida_bodega', session::getInstance()->getFormatOutput());
      
      
    } catch (PDOException $exc) {
      echo $exc->getMessage() . "<BR>" . print_r($exc->getTraceAsString());
    }
  }

}