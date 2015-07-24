<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true));
        $fecha = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true));
        $id_trabajador = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, true));
        $ids = array(
            salidaBodegaTableClass::ID => $id
        );
        $data = array(
            salidaBodegaTableClass::FECHA => $fecha,
            salidaBodegaTableClass::ID_TRABAJADOR => $id_trabajador,
            
        );

        salidaBodegaTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Los elementos seleccionados fueron modificados de forma exitosa');
//           bitacora::register('MODIFICAR', salidaBodegaTableClass::getNameTable());
      }
      routing::getInstance()->redirect('salida_bodega', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

  private function Validate($fecha, $id_tipo_doc, $id_trabajador) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

     if(preg_match($pattern,$date) === FALSE){
        session::getInstance()->getError(in18::__('ErrorCharacterDate',NULL,array('%date%'=>$fecha,'%character%'=> salidaBodegaTableClass::FECHA )));
        $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
      }
        if($fecha === '' or $fecha === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%date%' => $fecha,'%character%'=>  salidaBodegaTableClass::FECHA)));
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
        }
  
      
      if($flag === TRUE){
        request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('salida_bodega','insert');
        
      }
      
        if (!is_numeric($id_trabajador)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_employee', NULL, array('%id_employee%'=>$id_trabajador,'%character%'=>  salidaBodegaTableClass::ID_TRABAJADOR)));
        $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        if($id_trabajador === '' or $id_trabajador === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%id_employee%' => $id_trabajador,'%character%'=>  salidaBodegaTableClass::ID_TRABAJADOR)));
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }

        

  }

}
