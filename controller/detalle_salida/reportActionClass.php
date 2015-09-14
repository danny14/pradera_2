<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = NULL;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        // aqui validar datos de filtros
        if (isset($filter['salida_bodega']) and $filter['salida_bodega'] !== NULL and $filter['salida_bodega'] !== '') {
          $where[detalleSalidaTableClass::ID_SALIDA_BODEGA] = $filter['salida_bodega'];
        }

        if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {//para la foranea no hay cambio
          $where[detalleSalidaTableClass::ID_INSUMO] = $filter['Insumo'];
        }

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
      $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL, NULL, $where);

      //llamado de la foranea
      $fieldsSalidaBodega = array(/* foranea salida_ bodega */
          salidaBodegaTableClass::ID,
      );
      $orderBySalidaBodega = array(
          salidaBodegaTableClass::ID
      );
      $this->objSalidaBodega = salidaBodegaTableClass::getAll($fieldsSalidaBodega, false, $orderBySalidaBodega, 'ASC');

      //fin llamado a foranea*/
//llamado de la foranea
      $fieldsInsumo = array(/* foranea insumo */
          insumoTableClass::ID,
          insumoTableClass::NOMBRE
      );
      $orderByInsumo = array(
          insumoTableClass::NOMBRE
      );
      $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, false, $orderByInsumo, 'ASC');

      //fin llamado a foranea*/


      $this->defineView('report', 'detalle_salida', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
