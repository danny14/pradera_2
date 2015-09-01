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
       
       if(isset($filter['Animal']) and $report['Animal'] !== NULL and $report['Animal'] !== ''){
       $where[registroCeloTableClass::ID_ANIMAL] = $report['Animal'];  
       }
        if(isset($report['fechaCreacion1']) and $report['fechaCreacion1'] !== NULL and $report['fechaCreacion1'] !== '' and isset($report['fechaCreacion2']) and $report['fechaCreacion2'] !== NULL and $report['fechaCreacion2'] !== ''){
                    $where[registroCeloTableClass::FECHA] = array(
                        $report['fechaCreacion1'],
                        $report['fechaCreacion2']
//                        date(config::getFormatTimestamp(),  strtotime($report['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($report['fechaCreacion2']. ' 23:59:59'))
                    );
                }
       $fields = array(
      registroCeloTableClass::ID,
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
