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
      if (request::getInstance()->hasPost('filter')) {

        if (isset($filter['Salida_bodega']) and $filter['Salida_bodega'] !== NULL and $filter['Salida_bodega'] !== '') {
          $where[detalleSalidaTableClass::ID_SALIDA_BODEGA] = $filter['Salida_bodega'];
        }


        if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {//para la foranea no hay cambio
          $where[detalleSalidaTableClass::ID_INSUMO] = $filter['Insumo'];
        }

//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[registroCeloTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
        session::getInstance()->setAttribute('detalleSalidaIndexFilters', $where);
      } else if (session::getInstance()->hasAttribute('detalleSalidaIndexFilters')) {
        $where = session::getInstance()->getAttribute('detalleSalidaIndexFilters');
      }




      $fields = array(
          detalleSalidaTableClass::ID,
          detalleSalidaTableClass::CANTIDAD,
          detalleSalidaTableClass::ID_SALIDA_BODEGA,
          detalleSalidaTableClass::ID_INSUMO,
          detalleSalidaTableClass::ID_TIPO_INSUMO,
      );
      $orderBy = array(
          detalleSalidaTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 10;
      }
      $this->cntPages = detalleSalidaTableClass::getTotalPages(3, $where);
      $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, FALSE, $orderBy, 'ASC', 10, $page, $where);

      //llamado de la foranea
      $fieldsSalidaBodega = array(/* foranea salida_bodega */
          salidaBodegaTableClass::ID,
      );
      $orderBySalidaBodega = array(
          salidaBodegaTableClass::ID
      );
      $this->objSalidaBodega = salidaBodegaTableClass::getAll($fieldsSalidaBodega, false, $orderBySalidaBodega, 'ASC');
//llamado de la foranea
      $fieldsInsumo = array(/* foranea insumo */
          insumoTableClass::ID,
          insumoTableClass::NOMBRE,
          
      );
      $orderByInsumo = array(
          insumoTableClass::NOMBRE
      );
      $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, false, $orderByInsumo, 'ASC');


      $this->defineView('index', 'detalle_salida', session::getInstance()->getFormatOutput()); //direccionamiento
    } catch (PDOException $exc) {
      echo $exc->getMessage() . "<BR>" . print_r($exc->getTraceAsString());
    }
  }

}
