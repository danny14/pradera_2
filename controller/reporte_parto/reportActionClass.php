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
        if (isset($filter['fecha_parto']) and $filter['fecha_parto'] !== NULL and $filter['fecha_parto'] !== '') {
          $where[reportePartoTableClass::FECHA_PARTO] = $filter['fecha_parto'];
        }

        if (isset($filter['N_animales_vi']) and $filter['N_animales_vi'] !== NULL and $filter['N_animales_vi'] !== '') {
          $where[reportePartoTableClass::N_ANIMALES_VI] = $filter['N_animales_vi'];
        }


        if (isset($filter['Animal']) and $filter['Animal'] !== null and $filter['Animal'] !== '') {//para la foranea no hay cambio
          $where[reportePartoTableClass::ID_ANIMAL] = $filter['Animal'];
        }

//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[registroCeloTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
        session::getInstance()->setAttribute('reportePartoIndexFilters', $where);
      } else if (session::getInstance()->hasAttribute('reportePartoIndexFilters')) {
        $where = session::getInstance()->getAttribute('reportePartoIndexFilters');
      }

      $fields = array(
          reportePartoTableClass::ID,
          reportePartoTableClass::FECHA_PARTO,
          reportePartoTableClass::N_ANIMALES_VI,
          reportePartoTableClass::N_ANIMALES_M,
          reportePartoTableClass::N_MACHOS,
          reportePartoTableClass::N_HEMBRAS,
          reportePartoTableClass::OBSERVACIONES,
          reportePartoTableClass::ID_ANIMAL,
      );
      $orderBy = array(
          reportePartoTableClass::ID
      );
      $this->objReporteParto = reportePartoTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL, NULL, $where);

      //llamado de la foranea
      $fieldsAnimal = array(/* foranea animal */
          animalTableClass::ID,
          animalTableClass::NOMBRE,
      );
      $orderByAnimal = array(
          animalTableClass::NOMBRE
      );
      $this->objAnimal = animalTableClass::getAll($fieldsAnimal, false, $orderByAnimal, 'ASC');

      //fin llamado a foranea*/


      $this->defineView('report', 'reporte_parto', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
