<?php

/**
  @category:modulo salida bodega
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
   * @return $fecha=> fecha (date)
   * @return $id_trabajador=> id_trabajador (integer)
   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $fecha = trim(request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true)));
        $id_trabajador = trim(request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, true)));


        $this->Validate($fecha, $id_trabajador);


        $data = array(
            salidaBodegaTableClass::FECHA => $fecha,
            salidaBodegaTableClass::ID_TRABAJADOR => $id_trabajador,
        );


        salidaBodegaTableClass::insert($data);
        session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
//        bitacora::register('INSERTAR', salidaBodegaTableClass::getNameTable());
        routing::getInstance()->redirect('salida_bodega', 'index');
      } else {
        routing::getInstance()->redirect('salida_bodega', 'index');
      }
      /*
       * Limpia Variables en session correspondientes al formulario
       */
//      session::getInstance()->setAttribute('form_' . salidaBodegaTableClass::getNameTable(), NULL);
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
      routing::getInstance()->redirect('salida_bodega', 'insert');
    }
  }

  private function Validate($fecha, $id_trabajador) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
    $fechaActual = date('Y-m-d');

    // VALIDACION PARA LA FECHA
    if (preg_match($pattern, $fecha) === FALSE) {
      session::getInstance()->geterror(in18::__('errorDate', NULL, array('%date%' => $fecha, '%character%' => salidaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    if ($fecha === '' or $fecha === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%date%' => $fecha, '%character%' => salidaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    if (strtotime($fecha) > strtotime($fechaActual)) {
      session::getInstance()->setError(i18n::__('errorDate', NULL, 'default', array('%date%' => $fecha, '%character%' => salidaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    // FIN VALIDACION PARA LA FECHA
    // VALIDACION PARA EL TRABAJADOR
    if (!is_numeric($id_trabajador)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, array('%id_employee%' => $id_trabajador, '%character%' => salidaBodegaTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador === '' or $id_trabajador === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_employye%' => $id_trabajador, '%character%' => salidaBodegaTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%id_employee%' => $id_trabajador)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL TRABAJADOR

    if ($flag === TRUE) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('salida_bodega', 'insert');
    }
  }

}
