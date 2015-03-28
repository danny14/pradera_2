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

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $edad_animal = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::EDAD_ANIMAL, true));
        $fecha = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, true));
        $id_fecundador = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_FECUNDADOR, true));
        $id_animal = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID_ANIMAL, true));

        $data = array(
            registroCeloTableClass::EDAD_ANIMAL => $edad_animal,
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
//        if (strlen($fecha) > registroCelolTableClass::FECHA_LENGTH) {
//                    throw new PDOException('la fecha no puede ser mayor a ' . registroCeloTableClass::FECHA_LENGTH . ' caracteres');
//                }
        if (!is_numeric($edad_animal)) {
          throw new PDOException('Solo se puede ingresar caracteres numericos');
        }
        /* _______________________________ */
        $data = array(
            registroCeloTableClass::EDAD_ANIMAL => $edad_animal,
            registroCeloTableClass::FECHA => $fecha,
            registroCeloTableClass::ID_FECUNDADOR => $id_fecundador,
            registroCeloTableClass::ID_ANIMAL => $id_animal,
        );


        registroCeloTableClass::insert($data);
        session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
        bitacora::register('INSERTAR', registroCeloBaseTableClass::getNameTable());
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
        default :
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('registro_celo', 'insert');
    }
  }

}
