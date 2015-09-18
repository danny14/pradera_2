<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

/*
 * @author: Danny Steven Ruiz Hernandez
 * @date: 10/03/2015
 * @static:
 * @abstract
 * @category:
 */

class createActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $fecha=> fecha (date)
   * @return $hora=> hora (integer)
   * @return $id_trabajador=> id_trabajador (integer)
   * @return $id_proveedor=> id_proveedor(integer)
   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $fecha = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true)));
        $hora = strtoupper(trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, true))));
        $id_trabajador = trim(request::getInstance()->getPost(entradaBodegaBaseTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, true)));
        $id_proveedor = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, true)));


        $this->Validate($fecha, $hora, $id_trabajador, $id_proveedor);

        $data = array(
            entradaBodegaTableClass::FECHA => $fecha,
            entradaBodegaTableClass::HORA => $hora,
            entradaBodegaTableClass::ID_TRABAJADOR => $id_trabajador,
            entradaBodegaTableClass::ID_PROVEEDOR => $id_proveedor,
        );

        entradaBodegaTableClass::insert($data);
        session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
        bitacora::register('Insertar', entradaBodegaTableClass::getNameTable());
        routing::getInstance()->redirect('entrada_bodega', 'index');
      } else {
        routing::getInstance()->redirect('entrada_bodega', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        // 42601
        case 23505:
          session::getInstance()->setError(i18n::__('23505'));
//                    session::getInstance()->setError($exc->getMessage());
          break;
        case 42601:
          session::getInstance()->setError(i18n::__('42601'));
          break;
        default :
          session::getInstance()->setError($exc->getMessage());
          break;
      }
//            routing::getInstance()->redirect('animal', 'insert');
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

  /**
   * Validaciones para el Animal o Hoja de vida
   */
  private function Validate($fecha, $hora, $id_trabajador, $id_proveedor) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
    $fechaActual = date('Y-m-d');
    // VALIDACION PARA LA FECHA
    if (preg_match($pattern, $fecha) === FALSE) {
      session::getInstance()->geterror(in18::__('errorDate', NULL, array('%date%' => $fecha, '%character%' => entradaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    if ($fecha === '' or $fecha === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%date%' => $fecha, '%character%' => entradaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    if (strtotime($fecha) > strtotime($fechaActual)) {
      session::getInstance()->setError(i18n::__('errorDate', NULL, 'default', array('%date%' => $fecha, '%character%' => entradaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    // FIN VALIDACION PARA LA FECHA
    // VALIDACION PARA EL TRABAJADOR
    if (!is_numeric($id_trabajador)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, array('%id_employee%' => $id_trabajador, '%character%' => entradaBodegaTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador === '' or $id_trabajador === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_employye%' => $id_trabajador, '%character%' => entradaBodegaTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%id_employee%' => $id_trabajador)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL TRABAJADOR
   // VALIDACION PARA EL PROVEEDOR
    if (!is_numeric($id_proveedor)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, array('%id_provide%' => $id_proveedor, '%character%' => entradaBodegaTableClass::ID_PROVEEDOR)), 'errorProveedor');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE), TRUE);
    }
    if ($id_proveedor === '' or $id_proveedor === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_provide%' => $id_proveedor, '%character%' => entradaBodegaTableClass::ID_PROVEEDOR)), 'errorProveedor');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE), TRUE);
    }
    if ($id_proveedor < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%id_provide%' => $id_proveedor)), 'errorProveedor');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL POVEEDOR

    if ($flag === TRUE) {
      request::getInstance()->setMethod('GET'); //POST
      routing::getInstance()->forward('entrada_bodega', 'insert');
    }
  }

}
