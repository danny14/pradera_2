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
       
       if(isset($report['edad_animal']) and $report['edad_animal'] !== NULL and $report['edad_animal'] !== ''){
       $where[registroCeloTableClass::EDAD_ANIMAL] = $report['edad_animal'];  
       }
//       if(isset($report['fechaCreacion1']) and $report['fechaCreacion1'] !== NULL and $report['fechaCreacion1'] !== '' and isset($report['fechaCreacion2']) and $report['fechaCreacion2'] !== NULL and $report['fechaCreacion2'] !== ''){
//       $where[registroCeloTableClass::FECHA] = array(
//         $report['fechaCreacion1'],
//         $report['fechaCreacion2']  
//       );  
//       }
      }
       $fields = array(
      registroCeloTableClass::ID,
      registroCeloTableClass::EDAD_ANIMAL,
      registroCeloTableClass::FECHA,
      registroCeloTableClass::ID_FECUNDADOR,
      registroCeloTableClass::ID_ANIMAL
      );
       $orderBy = array(
       registroCeloTableClass::ID
       );
       $this->objRegistroCelo = registroCeloTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL, NULL, $where);
       $this->defineView('report', 'registro_celo', session::getInstance()->getFormatOutput());
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
