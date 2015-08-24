<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class deleteFiltersActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('detalleSalidaIndexFilters')) {
        session::getInstance()->deleteAttribute('detalleSalidaIndexFilters');
        routing::getInstance()->redirect('detalle_salida', 'index');
      } else {
        routing::getInstance()->redirect('detalle_salida', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo "<br>";
      echo $exc->getTraceAsString();
    }
  }

}
