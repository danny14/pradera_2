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
        if (isset($filter['fecha']) and $filter['fecha'] !== NULL and $filter['fecha'] !== '') {
          $where[salidaBodegaTableClass::FECHA] = $filter['fecha'];
        }

        if (isset($filter['Trabajador']) and $filter['Trabajador'] !== null and $filter['Trabajador'] !== '') {//para la foranea no hay cambio
          $where[salidaBodegaTableClass::ID_TRABAJADOR] = $filter['Trabajador'];
        }


        session::getInstance()->setAttribute('salidaBodegaIndexFilters', $where);
      } else if (session::getInstance()->hasAttribute('salidaBodegaIndexFilters')) {
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
      $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL, NULL, $where);

      //llamado de la foranea
      $fieldsTrabajador = array(/* foranea animal */
          trabajadorTableClass::ID,
          trabajadorTableClass::NOMBRE,
      );
      $orderByTrabajador = array(
          trabajadorTableClass::NOMBRE
      );
      $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, false, $orderByTrabajador, 'ASC');

      //fin llamado a foranea*/


      $this->defineView('report', 'salida_bodega', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
