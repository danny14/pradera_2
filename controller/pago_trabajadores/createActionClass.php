<?php

/* * 
  @category:modulo pago trabajadores
 *  */

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class createActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $fecha_inicio=> fecha_inicio (date)
   * @return $fecha_fin=> fecha_fin (date)
   * @return $subtotal=> subtotal (integer)
   * @return $valor_hora=> valor_hora(integer)
   * @return $id_trabajador=> id_trabajador(integer)
   * @return $horas_extras=> horas_extras(integer)
   * @return $cantidad_dias=> cantidad_dias(integer)
   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $fecha_inicio = trim(request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, true)));
        $fecha_fin = trim(request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, true)));
        $subtotal = trim(request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, true)));
        $valor_hora = trim(request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, true)));
        $id_trabajador = trim(request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, true)));
        $horas_extras = trim(request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, true)));
        $cantidad_dias = trim(request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, true)));

        $this->Validate($fecha_inicio, $fecha_fin, $subtotal, $valor_hora, $id_trabajador, $horas_extras, $cantidad_dias);


        $data = array(
            pagoTrabajadoresTableClass::FECHA_INICIO => $fecha_inicio,
            pagoTrabajadoresTableClass::FECHA_FIN => $fecha_fin,
            pagoTrabajadoresTableClass::SUBTOTAL => $subtotal,
            pagoTrabajadoresTableClass::VALOR_HORA => $valor_hora,
            pagoTrabajadoresTableClass::ID_TRABAJADOR => $id_trabajador,
            pagoTrabajadoresTableClass::HORAS_EXTRAS => $horas_extras,
            pagoTrabajadoresTableClass::CANTIDAD_DIAS => $cantidad_dias,
        );


        pagoTrabajadoresTableClass::insert($data);
        session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
//        bitacora::register('INSERTAR', pagoTrabajadoresTableClass::getNameTable());
        routing::getInstance()->redirect('pago_trabajadores', 'index');
      } else {
        routing::getInstance()->redirect('pago_trabajadores', 'index');
      }
      /*
       * Limpia Variables en session correspondientes al formulario
       */
//      session::getInstance()->setAttribute('form_' . pagoTrabajadoresTableClass::getNameTable(), NULL);
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError($exc->getMessage());
          break;
        case '22P02':
          session::getInstance()->setAction('error el compo debe ser numerico e ingreso letras');
          break;
        default :
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('pago_trabajadores', 'insert');
    }
  }

  private function Validate($fecha_inicio, $fecha_fin, $subtotal, $valor_hora, $id_trabajador, $horas_extras, $cantidad_dias) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

    // VALIDACION PARA LA FECHA INICIO    
    if (preg_match($pattern, $fecha_inicio) === FALSE) {
      session::getInstance()->geterror(in18::__('errorDate', NULL, 'default', array('%Start_date%' => $fecha_inicio, '%character%' => pagoTrabajadoresTableClass::FECHA_INICIO)), 'errorFechaInicio');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE), TRUE);
    }
    if (strtotime($fecha_inicio) > strtotime($fecha_fin)) {
      session::getInstance()->geterror(i18n::__('errorDate2', NULL, 'default', array('%Start_date%' => $fecha_inicio, '%character%' => pagoTrabajadoresTableClass::FECHA_INICIO)), 'errorFechaInicio');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE), TRUE);
    }
    if ($fecha_inicio === '' or $fecha_inicio === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Start_date%' => $fecha_inicio, '%character%' => pagoTrabajadoresTableClass::FECHA_INICIO)), 'errorFechaInicio');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE), TRUE);
    }
    // FIN VALIDACION PARA LA FECHA INICIO
    // VALIDACION PARA LA FECHA FIN
    if (preg_match($pattern, $fecha_fin) === FALSE) {
      session::getInstance()->geterror(in18::__('errorDate', NULL, array('%End_date%' => $fecha_fin, '%character%' => pagoTrabajadoresTableClass::FECHA_FIN)), 'errorFechaFin');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_PARTO, TRUE), TRUE);
    }
    if ($fecha_fin === '' or $fecha_fin === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%End_date%' => $fecha_fin, '%character%' => pagoTrabajadoresTableClass::FECHA_FIN)), 'errorFechaFin');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, TRUE), TRUE);
    }
    // FIN VALIDACION PARA LA FECHA FIN
    // VALIDACION PARA SUBTOTAL
    if (is_numeric($subtotal) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%Subtotal%' => $subtotal, '%character%' => pagoTrabajadoresTableClass::SUBTOTAL)), 'errorSubtotal');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE), TRUE);
    }
    if ($subtotal === '' or $subtotal === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Subtotal%' => $subtotal, '%character%' => pagoTrabajadoresTableClass::SUBTOTAL)), 'errorSubtotal');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE), TRUE);
    }
    if ($subtotal < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $subtotal)), 'errorSubtotal');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE), TRUE);
    }
    if (strlen($subtotal) > 10) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%subtotal%' => $subtotal)), 'errorSubtotal');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE), TRUE);
    }
    // FIN VALIDACION PARA SUBTOTAL
    // VALIDACION PARA VALOR HORA
    if (is_numeric($valor_hora) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%Time_value%' => $valor_hora, '%character%' => pagoTrabajadoresTableClass::VALOR_HORA)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE), TRUE);
    }
    if ($valor_hora === '' or $valor_hora === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Time_value%' => $valor_hora, '%character%' => pagoTrabajadoresTableClass::VALOR_HORA)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE), TRUE);
    }
    if ($valor_hora < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $valor_hora)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE), TRUE);
    }
    if (strlen($valor_hora) > 10) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%number%' => $valor_hora)), 'errorValorHora');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE), TRUE);
    }
    // FIN VALIDACION PARA VALOR HORA
    // VALIDACION PARA TRABAJADOR
    if (is_numeric($id_trabajador) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%Id_employee%' => $id_trabajador, '%character%' => pagoTrabajadoresTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador === '' or $id_trabajador === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Id_employee%' => $id_trabajador, '%character%' => pagoTrabajadoresTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $id_trabajador)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    // FIN VALIDACION PARA TRABAJADOR
    // VALIDACION PARA HORAS EXTRAS
    if (is_numeric($horas_extras) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%Extra_time%' => $horas_extras, '%character%' => pagoTrabajadoresTableClass::HORAS_EXTRAS)), 'errorHorasExtras');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE), TRUE);
    }
    if ($horas_extras === '' or $horas_extras === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Extra_time%' => $horas_extras, '%character%' => pagoTrabajadoresTableClass::HORAS_EXTRAS)), 'errorHorasExtras');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE), TRUE);
    }
    if ($horas_extras < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $horas_extras)), 'errorHorasExtras');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE), TRUE);
    }
    if (strlen($horas_extras) > 8) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%number%' => $horas_extras)), 'errorHorasExtras');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE), TRUE);
    }
    // FIN VALIDACION PARA HORAS EXTRAS
    // VALIDACION PARA CANTIDAD DIAS
    if (is_numeric($cantidad_dias) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%Number of days%' => $cantidad_dias, '%character%' => pagoTrabajadoresTableClass::CANTIDAD_DIAS)), 'errorCantidadDias');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE), TRUE);
    }
    if ($cantidad_dias === '' or $cantidad_dias === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%Number of days%' => $cantidad_dias, '%character%' => pagoTrabajadoresTableClass::CANTIDAD_DIAS)), 'errorCantidadDias');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE), TRUE);
    }
    if ($cantidad_dias < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $cantidad_dias)), 'errorCantidadDias');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE), TRUE);
    }
    if (strlen($cantidad_dias) > 3) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%number%' => $cantidad_dias)), 'errorCantidadDias');
      $flag = TRUE;
      session::getInstance()->setFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE), TRUE);
    }
    // FIN VALIDACION PARA CANTIDAD DIAS
    if ($flag === TRUE) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('pago_trabajadores', 'insert');
    }
  }

}
