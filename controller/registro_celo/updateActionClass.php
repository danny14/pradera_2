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
        $id = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID, true));
        $edad_animal = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::EDAD_ANIMAL, true));
        $fecha = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, true));
        $id_fecundador = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, true));
        $id_animal = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, true));
        $ids = array(
            registroCeloTableClass::ID => $id
        );
        $data = array(
            registroCeloTableClass::EDAD_ANIMAL => $edad_animal,
            registroCeloTableClass::FECHA => $fecha,
            registroCeloTableClass::ID_FECUNDADOR => $id_fecundador,
            registroCeloTableClass::ID_ANIMAL => $id_animal,
        );

        registroCeloTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Los elementos seleccionados fueron modificados de forma exitosa');
//           bitacora::register('MODIFICAR', registroCeloTableClass::getNameTable());
      }
      routing::getInstance()->redirect('registro_celo', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

  private function Validate($edad_animal, $fecha, $id_fecundador, $id_animal) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

    if (is_numeric($edad_animal) === FALSE) {
      session::getInstance()->setError(i18n::__('ErrorCharacterAge_animal', NULL, 'default', array('%Age_animal%' => $edad_animal, '%character%' => registroCeloTableClass::EDAD_ANIMAL_LENGTH)));
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::EDAD_ANIMAL, TRUE), TRUE);
    }
    if (preg_match($pattern, $date) === FALSE) {
      session::getInstance()->getError(in18::__('ErrorCharacterDate', NULL, array('%date%' => $fecha, '%character%' => registroCeloTableClass::FECHA)));
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
    }
    if ($flag === TRUE) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('registro_celo', 'insert');
    }
    if (!is_numeric($id_fecundador)) {
      session::getInstance()->setError(i18n::__('ErrorCharacterId_fecundador', NULL, array('%id_fecundador%' => $id_fecundador, '%character%' => registroCeloTableClass::ID_FECUNDADOR)));
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE), TRUE);
    }
    if (!is_numeric($id_animal)) {
      session::getInstance()->setError(i18n::__('ErrorCharacterId_animal', NULL, array('%id_animal%' => $id_animal, '%character%' => registroCeloTableClass::ID_ANIMAL)));
      $flag = TRUE;
      session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE), TRUE);
    }
  }

}
