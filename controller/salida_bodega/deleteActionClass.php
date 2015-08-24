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
        $id = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, TRUE));
        $ids = array(
            salidaBodegaTableClass::ID => $id
        );


        salidaBodegaTableClass::delete($ids, FALSE);
        $this->arrayAjax = array(
            'code' => 200,
            'msg' => 'la eliminacion del registro fue exitosa'
        );
        $this->defineView('delete', 'salida_bodega', session::getInstance()->getFormatOutput());
       bitacora::register('ELIMINAR', reportePartoBaseTableClass::getNameTable());
        session::getInstance()->setSuccess('el registro fue eliminado exitosamente');
      } else {
        routing::getInstance()->redirect('salida_bodega', 'delete');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

}
