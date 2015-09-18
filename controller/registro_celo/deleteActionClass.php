<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
        $id = request::getInstance()->getPost(registroCeloTableClass::getNameField(registroCeloTableClass::ID, TRUE));
        $ids = array(
            registroCeloTableClass::ID => $id
        );


        registroCeloTableClass::delete($ids, FALSE);
        $this->arrayAjax = array(
            'code' => 200,
            'msg' => 'la eliminacion del registro fue exitosa'
        );
       bitacora::register('ELIMINAR', registroCeloBaseTableClass::getNameTable());
       session::getInstance()->setSuccess('el registro fue eliminado exitosamente');
       $this->defineView('delete', 'registro_celo', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('registro_celo', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

}
