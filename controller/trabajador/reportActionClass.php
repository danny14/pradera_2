<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing; 
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


class reportActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            $where = NULL;
            if(request::getInstance()->hasPost('report')){
                $report = request::getInstance()->getPost('report');
                // aqui validar datos de filtros
//                if(isset($report['nombre']) and $report['nombre'] !== NULL and $report['nombre'] !== ''){
//                    $where[trabajadorTableClass::NOMBRE] = $report['nombre'];
//                }
//                if(isset($report['fechaCreacion1']) and $report['fechaCreacion1'] !== NULL and $report['fechaCreacion1'] !== '' and isset($report['fechaCreacion2']) and $report['fechaCreacion2'] !== NULL and $report['fechaCreacion2'] !== ''){
//                    $where[trabajadorTableClass::FECHA_INGRESO] = array(
//                        $report['fechaCreacion1'],
//                        $report['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($report['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($report['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
                $fields = array(
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
                trabajadorTableClass::APELLIDO,
                trabajadorTableClass::DIRECCION,
                trabajadorTableClass::TELEFONO,
                trabajadorTableClass::ID_TURNO,
                trabajadorTableClass::ID_CREDENCIAL,
                trabajadorTableClass::ID_CIUDAD
                );
                
                $orderBy = array(
                trabajadorTableClass::ID
                );
                $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL,NULL, $where);
                $this->defineView('report', 'trabajador', session::getInstance()->getFormatOutput());
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
}

