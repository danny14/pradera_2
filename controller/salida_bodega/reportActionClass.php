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
      if(request::getInstance()->hasPost('report')){
       $report = request::getInstance()->getPost('report');
       
      // aqui validar datos de filtros
        if (isset($filter['Fecha']) and $filter['Fecha'] !== NULL and $filter['Fecha'] !== '') {
          $where[salidaBodegaTableClass::FECHA] = $filter['Fecha'];
        }


        if (isset($filter['Trabajador']) and $filter['Trabajador'] !== null and $filter['Trabajador'] !== '') {//para la foranea no hay cambio
          $where[salidaBodegaTableClass::ID_TRABAJADOR] = $filter['Trabajador'];
        }

//       if(isset($report['fechaCreacion1']) and $report['fechaCreacion1'] !== NULL and $report['fechaCreacion1'] !== '' and isset($report['fechaCreacion2']) and $report['fechaCreacion2'] !== NULL and $report['fechaCreacion2'] !== ''){
//       $where[registroCeloTableClass::FECHA] = array(
//         $report['fechaCreacion1'],
//         $report['fechaCreacion2']  
//       );  
//       }
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
      $fieldsTrabajador = array(/* foranea trabajador */
          trabajadorTableClass::ID,
          trabajadorTableClass::NOMBRE,
      );
      $orderByTrabajador = array(
          trabajadorTableClass::NOMBRE
      );
      $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, false, $orderByTrabajador, 'ASC');

      //fin llamado a foranea*/

       
       
       $this->defineView('report', 'salida_bodega', session::getInstance()->getFormatOutput());
      }  
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
