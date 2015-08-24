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
        $fecha = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, true));
        $id_fecundador = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, true));
        $id_animal = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, true));
        $ids = array(
            registroCeloTableClass::ID => $id
        );
        $data = array(
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

  private function Validate($fecha, $id_fecundador, $id_animal) {
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
    $fechaActual = date('Y-m-d');
    
    if(preg_match($pattern,$fecha) === FALSE){
        session::getInstance()->getError(in18::__('ErrorCharacterDate',NULL,array('%date%'=>$fecha,'%character%'=> registroCeloTableClass::FECHA )),'errorFecha');
        $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
      }
      if($fecha === '' or $fecha === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%date%' => $fecha,'%character%'=>  registroCeloTableClass::FECHA)),'errorFecha');
          $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
        }
        if(strtotime($fecha) >  strtotime($fechaActual)){
          session::getInstance()->setError(i18n::__('ErrorCharacterDate', NULL,'default', array('%date%' => $fecha,'%character%'=>  registroCeloTableClass::FECHA)),'errorFecha');
          $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
        }
        
      if (!is_numeric($id_fecundador)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_fecundador', NULL, array('%id_fecundador%'=>$id_fecundador,'%character%'=>  registroCeloTableClass::ID_FECUNDADOR)),'errorFecundador');
        $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE), TRUE);
        }
        if($id_fecundador === '' or $id_fecundador === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%id_fecundador%' => $id_fecundador,'%character%'=>  registroCeloTableClass::FECUNDADOR)),'errorFecundador');
          $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::D_FECUNDADOR, TRUE), TRUE);
        }
        if($id_fecundador < 0){
          session::getInstance()->setError(i18n::__('ErrorNumberNegative', NULL,'default', array('%number%' => $id_fecundador)),'errorFecundador');
          $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, TRUE), TRUE);
        }
        if (!is_numeric($id_animal)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_animal', NULL, array('%id_animal%'=>$id_animal,'%character%'=>  registroCeloTableClass::ID_ANIMAL)),'errorAnimal');
        $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE), TRUE);
        }
        if($id_animal === '' or $id_animal === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%id_animal%' => $id_animal,'%character%'=>  registroCeloTableClass::ID_ANIMAL)),'errorAnimal');
          $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE), TRUE);
        }
        if($id_animal < 0){
          session::getInstance()->setError(i18n::__('ErrorNumberNegative', NULL,'default', array('%number%' => $id_animal)),'errorAnimal');
          $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, TRUE), TRUE);
        }
        if ($flag === TRUE) {
      request::getInstance()->setMethod('GET');
      request::getInstance()->addParamGet(array(registroCeloTableClass::ID => request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID, TRUE))));
      routing::getInstance()->forward('registro_celo', 'edit');
       }

        

  }

}
