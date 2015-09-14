<?php

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
   * @return $id_fecundador=> id_fecundador (integer)
   * @return $id_animal=> id_animal (integer)
   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $fecha = trim(request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, true)));
        $id_fecundador = trim(request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, true)));
        $id_animal = trim(request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, true)));

        $this->Validate($fecha, $id_fecundador, $id_animal);

        $data = array(
            registroCeloTableClass::FECHA => $fecha,
            registroCeloTableClass::ID_FECUNDADOR => $id_fecundador,
            registroCeloTableClass::ID_ANIMAL => $id_animal,
        );

        /**
         * Guarda los datos del formulario en la sesion iniciada 
         */
//        session::getInstance()->setAttribute('form_' . registroCeloTableClass::getNameTable(), $post);
        /**
         * Validaciones para el registro_celo
         */
        /* _______________________________ */

        registroCeloTableClass::insert($data);
        session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
//        bitacora::register('INSERTAR', registroCeloTableClass::getNameTable());
        routing::getInstance()->redirect('registro_celo', 'index');
      } else {
        routing::getInstance()->redirect('registro_celo', 'index');
      }
      /*
       * Limpia Variables en session correspondientes al formulario
       */
//      session::getInstance()->setAttribute('form_' . registroCeloTableClass::getNameTable(), NULL);
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
      routing::getInstance()->redirect('registro_celo', 'insert');
    }
  }

  private function Validate($fecha, $id_fecundador, $id_animal) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
    $fechaActual = date('Y-m-d');

    // VALIDACION PARA FECHA
    if (preg_match($pattern, $fecha) === FALSE) {
      session::getInstance()->getError(in18::__('errorDate', NULL, array('%date%' => $fecha, '%character%' => registroCeloTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
    }
    if ($fecha === '' or $fecha === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%date%' => $fecha, '%character%' => registroCeloTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
    }
    if (strtotime($fecha) > strtotime($fechaActual)) {
      session::getInstance()->setError(i18n::__('errorDate', NULL, 'default', array('%date%' => $fecha, '%character%' => registroCeloTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
    }
    // FIN VALIDACION PARA FECHA
    // VALIDACION PARA FECUNDADOR
    if (!is_numeric($id_fecundador)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, array('%id_fecundador%' => $id_fecundador, '%character%' => registroCeloTableClass::ID_FECUNDADOR)), 'errorFecundador');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE), TRUE);
    }
    if ($id_fecundador === '' or $id_fecundador === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_fecundador%' => $id_fecundador, '%character%' => registroCeloTableClass::FECUNDADOR)), 'errorFecundador');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::D_FECUNDADOR, TRUE), TRUE);
    }
    if ($id_fecundador < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $id_fecundador)), 'errorFecundador');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE), TRUE);
    }
    // FIN VALIDACION FECUNDADOR
    // VALIDACION PARA ANIMAL
    if (!is_numeric($id_animal)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, array('%id_animal%' => $id_animal, '%character%' => registroCeloTableClass::ID_ANIMAL)), 'errorAnimal');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE), TRUE);
    }
    if ($id_animal === '' or $id_animal === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_animal%' => $id_animal, '%character%' => registroCeloTableClass::ID_ANIMAL)), 'errorAnimal');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE), TRUE);
    }
    if ($id_animal < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $id_animal)), 'errorAnimal');
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE), TRUE);
    }
    // FIN VALIDACION PARA ANIMAL
    if ($flag === TRUE) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('registro_celo', 'insert');
    }
  }

}
