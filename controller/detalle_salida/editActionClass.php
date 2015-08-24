<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(detalleSalidaTableClass::ID)) {
        $idSalidaBodega= request::getInstance()->hasGet(detalleSalidaTableClass::ID_SALIDA_BODEGA);
        $fields = array(
            detalleSalidaTableClass::ID,
            detalleSalidaTableClass::CANTIDAD,
            detalleSalidaTableClass::ID_SALIDA_BODEGA,
            detalleSalidaTableClass::ID_INSUMO,
            detalleSalidaTableClass::ID_TIPO_INSUMO,
        );
        $where = array(
            detalleSalidaTableClass::ID => request::getInstance()->getRequest(detalleSalidaTableClass::ID)
        );
        $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);

        $fieldsSalidaBodega = array(
            salidaBodegaTableClass::ID,
        );
        $orderBySalidaBodega = array(
            salidaBodegaTableClass::ID,
        );
        $this->objSalidaBodega = salidaBodegaTableClass::getAll($fieldsSalidaBodega, FALSE, $orderBySalidaBodega, 'ASC');

        $fieldsInsumo = array(
            insumoTableClass::ID,
            insumoTableClass::NOMBRE,
        );
        $orderByInsumo = array(
            insumoTableClass::NOMBRE,
        );
        $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, FALSE, $orderByInsumo, 'ASC');

        $fieldsTipoInsumo = array(
            tipoInsumoTableClass::ID,
            tipoInsumoTableClass::DESCRIPCION,
        );
        $orderByTipoInsumo = array(
            tipoInsumoTableClass::DESCRIPCION,
        );
        $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo, FALSE, $orderByTipoInsumo, 'ASC');
        $this->idSalidaBodega=$idSalidaBodega;
        $this->defineView('edit', 'detalle_salida', session::getInstance()->getFormatOutput());
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
