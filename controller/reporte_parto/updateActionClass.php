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
        $id = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::ID, true));
        $fecha_parto = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, true));
        $n_animales_vi = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, true));
        $n_animales_m = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, true));
        $n_machos = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, true));
        $n_hembras = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, true));
        $observaciones = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, true));
        $id_animal = request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, true));

        $this->Validate($fecha_parto, $n_animales_vi, $n_animales_m, $n_machos, $n_hembras, $observaciones, $id_animal);


        $ids = array(
            reportePartoTableClass::ID => $id
        );
        $data = array(
            reportePartoTableClass::FECHA_PARTO => $fecha_parto,
            reportePartoTableClass::N_ANIMALES_VI => $n_animales_vi,
            reportePartoTableClass::N_ANIMALES_M => $n_animales_m,
            reportePartoTableClass::N_MACHOS => $n_machos,
            reportePartoTableClass::N_HEMBRAS => $n_hembras,
            reportePartoTableClass::OBSERVACIONES => $observaciones,
            reportePartoTableClass::ID_ANIMAL => $id_animal,
        );

        reportePartoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Los elementos seleccionados fueron modificados de forma exitosa');
//           bitacora::register('MODIFICAR', reportePartoTableClass::getNameTable());
      }
      routing::getInstance()->redirect('reporte_parto', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

  private function Validate($fecha_parto, $n_animales_vi, $n_animales_m, $n_machos, $n_hembras, $observaciones, $id_animal) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
    $fechaActual = date('Y-m-d');

    // VALIDACION PARA LA FECHA PARTO
    if (preg_match($pattern, $fecha_parto) === FALSE) {
      session::getInstance()->geterror(in18::__('errorDate', NULL, 'default', array('%date_delivery%' => $fecha_parto, '%character%' => reportePartoTableClass::FECHA_PARTO)), 'errorFechaParto');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE), TRUE);
    }
    if ($fecha_parto === '' or $fecha_parto === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%date_delivery%' => $fecha_parto, '%character%' => reportePartoTableClass::FECHA_PARTO)), 'errorFechaParto');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE), TRUE);
    }
    if (strtotime($fecha_parto) > strtotime($fechaActual)) {
      session::getInstance()->setError(i18n::__('errorDate', NULL, 'default', array('%date_delivery%' => $fecha_parto, '%character%' => reportePartoTableClass::FECHA_PARTO)), 'errorFechaParto');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::FECHA_PARTO, TRUE), TRUE);
    }
    // FIN VALIDACION PARA LA FECHA PARTO
    // VALIDACION PARA EL NUMERO DE ANIMALES VIVOS
    if (is_numeric($n_animales_vi) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_animales_living%' => $n_animales_vi, '%character%' => reportePartoTableClass::N_ANIMALES_VI)), 'errorNumeroAnimalesVivos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE), TRUE);
    }
    if ($n_animales_vi === '' or $n_animales_vi === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%N_animales_living%' => $n_animales_vi, '%character%' => reportePartoTableClass::N_ANIMALES_VI)), 'errorNumeroAnimalesVivos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE), TRUE);
    }
    if ($n_animales_vi < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $n_animales_vi)), 'errorNumeroAnimalesVivos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE), TRUE);
    }
    if (strlen($n_animales_vi) > 2) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_animales_living%' => $n_animales_vi, '%character%' => reportePartoTableClass::N_ANIMALES_VI)), 'errorNumeroAnimalesVivos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_VI, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL NUMERO DE ANIMALES VIVOS
    // VALIDACION PARA EL NUMERO DE ANIMALES MUERTOS
    if (is_numeric($n_animales_m) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_animales_dead%' => $n_animales_m, '%character%' => reportePartoTableClass::N_ANIMALES_M)), 'errorNumeroAnimalesMuertos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE), TRUE);
    }
    if ($n_animales_m === '' or $n_animales_m === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%N_animales_dead%' => $n_animales_m, '%character%' => reportePartoTableClass::N_ANIMALES_M)), 'errorNumeroAnimalesMuertos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE), TRUE);
    }
    if ($n_animales_m < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $n_animales_m)), 'errorNumeroAnimalesMuertos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE), TRUE);
    }
    if (strlen($n_animales_m) > 2) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_animales_dead%' => $n_animales_m, '%character%' => reportePartoTableClass::N_ANIMALES_M)), 'errorNumeroAnimalesMuertos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_ANIMALES_M, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL NUMERO DE ANIMALES MUERTOS
    // VALIDACION PARA EL NUMERO DE MACHOS
    if (is_numeric($n_machos) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_males%' => $n_machos, '%character%' => reportePartoTableClass::N_MACHOS)), 'errorNumeroMachos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE), TRUE);
    }
    if ($n_machos === '' or $n_machos === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%N_males%' => $n_machos, '%character%' => reportePartoTableClass::N_MACHOS)), 'errorNumeroMachos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE), TRUE);
    }
    if ($n_machos < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $n_machos)), 'errorNumeroMachos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE), TRUE);
    }
    if (strlen($n_machos) > 2) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_males%' => $n_machos, '%character%' => reportePartoTableClass::N_MACHOS)), 'errorNumeroMachos');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_MACHOS, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL NUMERO MACHOS
    // VALIDACION PARA EL NUMERO DE EMBRAS
    if (is_numeric($n_hembras) === FALSE) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_females%' => $n_hembras, '%character%' => reportePartoTableClass::N_HEMBRAS)), 'errorNumeroHembras');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE), TRUE);
    }
    if ($n_hembras === '' or $n_hembras === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%N_females%' => $n_hembras, '%character%' => reportePartoTableClass::N_HEMBRAS)), 'errorNumeroHembras');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE), TRUE);
    }
    if ($n_hembras < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $n_hembras)), 'errorNumeroHembras');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE), TRUE);
    }
    if (strlen($n_hembras) > 2) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%N_females%' => $n_hembras, '%character%' => reportePartoTableClass::N_HEMBRAS)), 'errorNumeroHembras');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::N_HEMBRAS, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL NUMERO DE HEMBRAS
    // VALIDACION PARA LAS OBSERVACIONES
    if (!preg_match("/^[a-zA-Z0-9 ]{3,80}$/", $observaciones)) {
      session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default', array('%field%' => reportePartoTableClass::OBSERVACIONES)), 'errorObservaciones');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, TRUE), TRUE);
    }
    if ($observaciones === '' or $observaciones === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => reportePartoTableClass::OBSERVACIONES)), 'errorObservaciones');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::OBSERVACIONES, TRUE), TRUE);
    }
    // FIN VALIDACION PARA LAS OBSERVACIONES
    // VALIDACION PARA EL ANIMAL
    if (!is_numeric($id_animal)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, 'default', array('%id_animal%' => $id_animal, '%character%' => reportePartoTableClass::ID_ANIMAL)), 'errorIdAnimal');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE), TRUE);
    }
    if ($id_animal === '' or $id_animal === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_animal%' => $id_animal, '%character%' => reportePartoTableClass::ID_ANIMAL)), 'errorIdAnimal');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE), TRUE);
    }
    if ($id_animal < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%number%' => $id_animal)), 'errorIdAnimal');
      $flag = TRUE;
      session::getInstance()->setFlash(reportePartoTableClass::getNameField(reportePartoTableClass::ID_ANIMAL, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL ANIMAL

    if ($flag === TRUE) {
      request::getInstance()->setMethod('GET');
      request::getInstance()->addParamGet(array(reportePartoTableClass::ID => request::getInstance()->getPost(reportePartoTableClass::getNameField(reportePartoTableClass::ID, TRUE))));
      routing::getInstance()->forward('reporte_parto', 'edit');
    }
  }

}
