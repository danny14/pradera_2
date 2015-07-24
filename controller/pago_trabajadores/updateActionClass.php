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
        $id = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID, true));
        $fecha_inicio = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, true));
        $fecha_fin = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, true));
        $subtotal = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, true));
        $valor_hora = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, true));
        $id_trabajador = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, true));
        $horas_extras = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, true));
        $cantidad_dias = request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, true));
        $ids = array(
            pagoTrabajadoresTableClass::ID => $id
        );
        $data = array(
            pagoTrabajadoresTableClass::FECHA_INICIO => $fecha_inicio,
            pagoTrabajadoresTableClass::FECHA_FIN => $fecha_fin,
            pagoTrabajadoresTableClass::SUBTOTAL => $subtotal,
            pagoTrabajadoresTableClass::VALOR_HORA => $valor_hora,
            pagoTrabajadoresTableClass::ID_TRABAJADOR => $id_trabajador,
            pagoTrabajadoresTableClass::HORAS_EXTRAS => $horas_extras,
            pagoTrabajadoresTableClass::CANTIDAD_DIAS => $cantidad_dias,
        );

        pagoTrabajadoresTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Los elementos seleccionados fueron modificados de forma exitosa');
//           bitacora::register('MODIFICAR', pagoTrabajadoresTableClass::getNameTable());
      }
      routing::getInstance()->redirect('pago_trabajadores', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

  private function Validate($fecha_inicio, $fecha_fin, $subtotal, $valor_hora, $id_trabajador,$horas_extras, $cantidad_dias ) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

    if(preg_match($pattern,$date_XXXX) === FALSE){
        session::getInstance()->getError(in18::__('ErrorCharacterDate_XXXXX',NULL,array('%date_XXXXX%'=>$fecha_inicio,'%character%'=> pagoTrabajadoresTableClass::FECHA_INICIO )));
        $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE), TRUE);
      }
      if($fecha_inicio === '' or $fecha_inicio === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%date_XXXXX%' => $fecha_inicio,'%character%'=>  pagoTrabajadoresTableClass::FECHA_INICIO)));
          $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE), TRUE);
        }
      if($flag === TRUE){
        request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('pago_trabajadores','insert');
        
      }
    
    if (is_numeric($fecha_fin) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterDate_XXXXX', NULL,'default', array('%Date_XXXXX%' => $fecha_fin,'%character%'=>  pagoTrabajadoresTableClass::FECHA_FIN)));
        $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, TRUE), TRUE);
        }
        if($fecha_fin === '' or $fecha_fin === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%Date_XXXXX%' => $fecha_fin,'%character%'=>  pagoTrabajadoresTableClass::FECHA_FIN)));
          $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, TRUE), TRUE);
        }
  
      if (is_numeric($subtotal) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterXXXXXX', NULL,'default', array('%XXXXX%' => $subtotal,'%character%'=>  pagoTrabajadoresTableClass::SUBTOTAL)));
        $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE), TRUE);
        }
        if($subtotal === '' or $subtotal === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%XXXXXX%' => $subtotal,'%character%'=>  pagoTrabajadoresTableClass::SUBTOTAL)));
          $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE), TRUE);
        }
        
        if (is_numeric($valor_hora) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterXXXX', NULL,'default', array('%XXXXX%' => $valor_hora,'%character%'=>  pagoTrabajadoresTableClass::VALOR_HORA)));
        $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE), TRUE);
        }
        if($valor_hora === '' or $valor_hora === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%XXXX%' => $valor_hora,'%character%'=>  pagoTrabajadoresTableClass::VALOR_HORA)));
          $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE), TRUE);
        }
        
        if (is_numeric($id_trabajador) === FALSE) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_employee', NULL,'default', array('%Id_employee%' => $id_trabajador,'%character%'=>  pagoTrabajadoresTableClass::ID_TRABAJADOR)));
        $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        if($id_trabajador === '' or $id_trabajador === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%Id_employee%' => $id_trabajador,'%character%'=>  pagoTrabajadoresTableClass::ID_TRABAJADOR)));
          $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        if (!is_numeric($horas_extras)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterXXXXXX', NULL, array('%horas_extras%'=>$horas_extras,'%character%'=>  pagoTrabajadoresTableClass::HORAS_EXTRAS)));
        $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE), TRUE);
        }
        if($horas_extras === '' or $horas_extras === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%horas_extras%' => $horas_extras,'%character%'=>  pagoTrabajadoresTableClass::HORAS_EXTRAS)));
          $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE), TRUE);
    }
        
        if (!is_numeric($cantidad_dias)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_animal', NULL, array('%cantidad_dias%'=>$cantidad_dias,'%character%'=>  pagoTrabajadoresTableClass::CANTIDAD_DIAS)));
        $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE), TRUE);
        }
        if($cantidad_dias === '' or $cantidad_dias === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%cantidad_dias%' => $cantidad_dias,'%character%'=>  pagoTrabajadoresTableClass::CANTIDAD_DIAS)));
          $flag = TRUE;
        session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE), TRUE);
    }
  }

}
