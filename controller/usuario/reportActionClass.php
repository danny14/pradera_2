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
                if(isset($report['nombre']) and $report['nombre'] !== NULL and $report['nombre'] !== ''){
                    $where[animalTableClass::NOMBRE] = $report['nombre'];
                }
                if(isset($report['fechaCreacion1']) and $report['fechaCreacion1'] !== NULL and $report['fechaCreacion1'] !== '' and isset($report['fechaCreacion2']) and $report['fechaCreacion2'] !== NULL and $report['fechaCreacion2'] !== ''){
                    $where[animalTableClass::FECHA_INGRESO] = array(
                        $report['fechaCreacion1'],
                        $report['fechaCreacion2']
//                        date(config::getFormatTimestamp(),  strtotime($report['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($report['fechaCreacion2']. ' 23:59:59'))
                    );
                }
                $fields = array(
                animalTableClass::ID,
                animalTableClass::NOMBRE,
                animalTableClass::GENERO,
                animalTableClass::PESO,
                animalTableClass::FECHA_INGRESO,
                animalTableClass::NUMERO_PARTOS,
                animalTableClass::ID_RAZA,
                animalTableClass::ID_ESTADO
                );
                
                $orderBy = array(
                animalTableClass::ID
                );
                $this->objAnimal = animalTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL,NULL, $where);
                $this->defineView('report', 'animal', session::getInstance()->getFormatOutput());
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
}

