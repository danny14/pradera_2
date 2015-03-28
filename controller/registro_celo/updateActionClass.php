<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

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
      }
      routing::getInstance()->redirect('registro_celo', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

}
