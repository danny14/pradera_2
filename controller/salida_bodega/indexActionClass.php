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
        $page = $page * 10;
      }
      $this->cntPages = salidaBodegaTableClass::getTotalPages(3, $where);
      $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, FALSE, $orderBy, 'ASC', 10, $page, $where);
      
      //llamado de la foranea
      $fieldsTrabajador = array(/* foranea animal */
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
            );
            $orderByTrabajador = array(
                trabajadorTableClass::NOMBRE
            );
            $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, false, $orderByTrabajador, 'ASC');

      
      $this->defineView('index', 'salida_bodega', session::getInstance()->getFormatOutput());//direccionamiento
    } catch (PDOException $exc) {
      echo $exc->getMessage() . "<BR>" . print_r($exc->getTraceAsString());
    }
  }
private function Validate($fecha, $id_trabajador){
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
    $fechaActual = date('Y-m-d');
      
    if(preg_match($pattern,$fecha) === FALSE){
        session::getInstance()->getError(in18::__('ErrorCharacterDate',NULL,array('%date%'=>$fecha,'%character%'=> salidaBodegaTableClass::FECHA )));
        $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
      }
      if($fecha === '' or $fecha === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%date%' => $fecha,'%character%'=>  salidaBodegaTableClass::FECHA)));
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
        }
        if(strtotime($fecha) >  strtotime($fechaActual)){
          session::getInstance()->setError(i18n::__('ErrorCharacterDate', NULL,'default', array('%date%' => $fecha,'%character%'=>  salidaBodegaTableClass::FECHA)));
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
        }
        if (!is_numeric($id_trabajador)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_trabajador', NULL, array('%id_trabajador%'=>$id_trabajador,'%character%'=>  salidaBodegaTableClass::ID_TRABAJADOR)));
        $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        if($id_trabajador === '' or $id_trabajador === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%id_trabajador%' => $id_trabajador,'%character%'=>  salidaBodegaTableClass::ID_TRABAJADOR)));
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        if($id_trabajador < 0){
          session::getInstance()->setError(i18n::__('ErrorNumberNegative', NULL,'default', array('%number%' => $id_trabajador)),'errorIdAnimal');
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        
       if($flag === TRUE){
         request::getInstance()->setMethod('GET');
         routing::getInstance()->forward('salida_bodega', 'index');
       } 

  }

}


