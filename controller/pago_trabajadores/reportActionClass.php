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
        if (isset($filter['Fecha_inicio']) and $filter['Fecha_inicio'] !== NULL and $filter['Fecha_inicio'] !== '') {
          $where[pagoTrabajadoresTableClass::FECHA_INICIO] = $filter['Fecha_inicio'];
        }

        if (isset($filter['Cantidad_dias']) and $filter['Cantidad_dias'] !== NULL and $filter['Cantidad_dias'] !== '') {
          $where[pagoTrabajadoresTableClass::CANTIDAD_DIAS] = $filter['Cantidad_dias'];
        }


        if (isset($filter['Trabajador']) and $filter['Trabajador'] !== null and $filter['Trabajador'] !== '') {//para la foranea no hay cambio
          $where[pagoTrabajadoresTableClass::ID_TRABAJADOR] = $filter['Trabajador'];
        }

//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[registroCeloTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
        session::getInstance()->setAttribute('pagoTrabajadoresIndexFilters', $where);
      } else if (session::getInstance()->hasAttribute('pagoTrabajadoresIndexFilters')) {
        $where = session::getInstance()->getAttribute('pagoTrabajadoresIndexFilters');
      }

      $fields = array(
          pagoTrabajadoresTableClass::ID,
          pagoTrabajadoresTableClass::FECHA_INICIO,
          pagoTrabajadoresTableClass::FECHA_FIN,
          pagoTrabajadoresTableClass::SUBTOTAL,
          pagoTrabajadoresTableClass::VALOR_HORA,
          pagoTrabajadoresTableClass::ID_TRABAJADOR,
          pagoTrabajadoresTableClass::HORAS_EXTRAS,
          pagoTrabajadoresTableClass::CANTIDAD_DIAS,
      );
      $orderBy = array(
          pagoTrabajadoresTableClass::ID
      );
      $this->objReporteParto = pagoTrabajadoresTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL, NULL, $where);

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


      $this->defineView('report', 'pago_trabajadores', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
