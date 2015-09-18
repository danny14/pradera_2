<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


class viewActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
          $salida_bodega_id = request::getInstance()->getGet(salidaBodegaTableClass::ID);
          if(request::getInstance()->hasGet(salidaBodegaTableClass::ID)){
            $fields = array(
            salidaBodegaTableClass::ID,
            salidaBodegaTableClass::FECHA,
            salidaBodegaTableClass::ID_TRABAJADOR,
            );
            $whereSalida= array(
            salidaBodegaTableClass::ID=>$salida_bodega_id
            );
            $this->objSalidaBodega= salidaBodegaTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $whereSalida);
            
            $fields = array(
            detalleSalidaTableClass::ID,
            detalleSalidaTableClass::CANTIDAD,
            detalleSalidaTableClass::ID_SALIDA_BODEGA,
            detalleSalidaTableClass::ID_INSUMO,
            detalleSalidaTableClass::ID_TIPO_INSUMO,
            
            );
            $where = array(
            detalleSalidaTableClass::ID_SALIDA_BODEGA => $salida_bodega_id
            );
            $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 3;
      }
            
                $this->cntPages = detalleSalidaTableClass::getTotalPages(3, $where);
                $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'detalle_salida', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('detalle_salida', 'view');
            }
//             //fin llamado a foranea*/
//llamado de la foranea
      $fieldsInsumo = array(/* foranea insumo */
          insumoTableClass::ID,
          insumoTableClass::NOMBRE
      );
      $orderByInsumo = array(
          insumoTableClass::NOMBRE
      );
      $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, false, $orderByInsumo, 'ASC');

//      //fin llamado a foranea*/

        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
