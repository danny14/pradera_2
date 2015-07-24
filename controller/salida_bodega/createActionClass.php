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
        $fecha = trim(request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true)));
         $id_trabajador = trim(request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, true)));
         
        
        $this->Validate($fecha,$id_trabajador);
        
        $data = array(
            salidaBodegaTableClass::FECHA => $fecha,
            salidaBodegaTableClass::ID_TRABAJADOR => $id_trabajador,
            
        );

        /**
         * Guarda los datos del formulario en la sesion iniciada 
         */
//        session::getInstance()->setAttribute('form_' . salidaBodegaTableClass::getNameTable(), $post);
        /**
         * Validaciones para la salida_bodega
         */
//        if (strlen($fecha) > salidaBodegaTableClass::FECHA_LENGTH) {
//                    throw new PDOException('la fecha no puede ser mayor a ' . salidaBodegaTableClass::FECHA_LENGTH . ' caracteres');
//                }
      
        
        /* _______________________________ */
        

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
  private function Validate($fecha,$id_trabajador){
    $flag = FALSE;
    $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
    
      if(preg_match($pattern,$fecha) === FALSE){
        session::getInstance()->getError(in18::__('ErrorCharacterDate',NULL,array('%date%'=>$fecha,'%character%'=> salidaBodegaTableClass::FECHA )));
        $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
      }
      if($fecha === '' or $fecha === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%date%' => $fecha,'%character%'=>  salidaBodegaTableClass::FECHA)));
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, TRUE), TRUE);
        }
      if($flag === TRUE){
        request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('salida_bodega','insert');
        
      }
     
        if (!is_numeric($id_trabajador)) {
        session::getInstance()->setError(i18n::__('ErrorCharacterId_employee', NULL, array('%id_employee%'=>$id_trabajador,'%character%'=>  salidaBodegaTableClass::ID_TRABAJADOR)));
        $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        if($id_trabajador === '' or $id_trabajador === NULL){
          session::getInstance()->setError(i18n::__('ErrorCharacterEmpty', NULL,'default', array('%id_employee%' => $id_trabajador,'%character%'=>  salidaBodegaTableClass::ID_TRABAJADOR)));
          $flag = TRUE;
        session::getInstance()->setFlash(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }

        

  }

}
