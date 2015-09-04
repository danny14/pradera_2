<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class indexActionClass extends controllerClass implements controllerActionInterface {
  public function execute() {
        try {
          //$pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
            /**
             * filtros para el index con paginacion incluida
             */
             $where = NULL;
            if(request::getInstance()->hasPost('filter')){
                $filter = request::getInstance()->getPost('filter');
                // aqui validar datos de filtros
                 if(isset($filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE).'_1']) and $filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE).'_1'] !== NULL and $filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE).'_1'] !== '' and isset($filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE).'_2']) and $filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE).'_2'] !== NULL and $filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE).'_2'] !== ''){
                    $fecha_ini = $filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_ININICIO,TRUE).'_1'];
                    $fecha_fin = $filter[pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE).'_2'];
                    $this->ValidateFecha( $fecha_ini, $fecha_fin);
                    $where[pagoTrabajadoresTableClass::FECHA_INICIO] = array(
                        $fecha_ini,
                        $fecha_fin
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
                    );
                }
                
                if(isset($filter['Cantidad_dias']) and $filter['Cantidad_dias'] !== NULL and $filter['Cantidad_dias'] !== ''){
                    $where[pagoTrabajadoresTableClass::CANTIDAD_DIAS] = $filter['Cantidad_dias'];
                }
                 
                
                if (isset($filter['Trabajador']) and $filter['Trabajador'] !== null and $filter['Trabajador'] !== '') {//para la foranea no hay cambio
                    $where[pagoTrabajadoresTableClass::ID_TRABAJADOR] = $filter['Trabajador'];
                }


                session::getInstance()->setAttribute('pagoTrabajadoresIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('pagoTrabajadoresIndexFilters')){
            $where = session::getInstance()->getAttribute('pagoTrabajadoresIndexFilters');
            }
    

    

      $fields = array(
          pagoTrabajadoresTableClass::ID,
          pagoTrabajadoresTableClass::FECHA_INICIO,
          pagoTrabajadoresTableClass::FECHA_FIN,
          pagoTrabajadoresTableClass::SUBTOTAL,
          pagoTrabajadoresTableClass::VALOR_HORA,
          pagoTrabajadoresTableClass::ID_TRABAJADOR,
          pagoTrabajadoresTableClass::HORAS_EXTRAS,
          pagoTrabajadoresTableClass::CANTIDAD_DIAS
          
      );
      $orderBy = array(
          pagoTrabajadoresTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 10;
      }
      $this->cntPages = pagoTrabajadoresTableClass::getTotalPages(3, $where);
      $this->objPagoTrabajadores = pagoTrabajadoresTableClass::getAll($fields, FALSE, $orderBy, 'ASC', 10, $page, $where);
      
      //llamado de la foranea
      $fieldsTrabajador = array(/* foranea trabajador */
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
            );
            $orderByTrabajador = array(
                trabajadorTableClass::NOMBRE
            );
            $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, false, $orderByTrabajador, 'ASC');

      
      $this->defineView('index', 'pago_trabajadores', session::getInstance()->getFormatOutput());//direccionamiento
    } catch (PDOException $exc) {
      echo $exc->getMessage() . "<BR>" . print_r($exc->getTraceAsString());
    }
  }

}
