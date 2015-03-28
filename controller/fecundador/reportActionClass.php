<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class reportActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            $where = NULL ;
            if(request::getInstance()->hasPost('report')){
                $report =  request::getInstance()->getPost('report');
                
                if( isset($report['nombre']) and $report['nombre'] !== NULL and $report['nombre'] !== ''){
                    $where[fecundadorTableClass::NOMBRE] = $report['nombre'];
                }
                
                if( isset($report['edad']) and $report['edad'] !== NULL and $report['edad'] !== ''){
                    $where[fecundadorTableClass::EDAD] = $report['edad'];
                }
                
                if( isset($report['peso']) and $report['peso'] !== NULL and $report['peso'] !== ''){
                    $where[fecundadorTableClass::PESO] = $report['peso'];
                }
                $fields = array(
                fecundadorTableClass::ID,
                fecundadorTableClass::NOMBRE,
                fecundadorTableClass::EDAD,
                fecundadorTableClass::PESO,
                fecundadorTableClass::OBSERVACION,
                fecundadorTableClass::ID_RAZA
                );
                $orderBy = array(
                fecundadorTableClass::ID
                    
                );
                $this->objFecundador = fecundadorTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL , NULL , $where);
                $this->defineView('report', 'fecundador', session::getInstance()->getFormatOutput());
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            
        }
    }
    }

