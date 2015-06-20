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
                
                if( isset($report['fecha_ordenno']) and $report['fecha_ordenno'] !== NULL and $report['fecha_ordenno'] !== ''){
                    $where[ordennoTableClass::FECHA_ORDENNO] = $report['fecha_ordenno'];
                }
                
                if( isset($report['cantidad_leche']) and $report['cantidad_leche'] !== NULL and $report['cantidad_leche'] !== ''){
                    $where[ordennoTableClass::CANTIDAD_LECHE] = $report['cantidad_leche'];
                }
                
               
                
                $fields = array(
                ordennoTableClass::ID,
                ordennoTableClass::FECHA_ORDENNO,
                ordennoTableClass::CANTIDAD_LECHE,
                ordennoTableClass::ID_TRABAJADOR,
                ordennoTableClass::ID_ANIMAL
                
                );
                $orderBy = array(
                ordennoTableClass::ID
                    
                );
                $this->objOrdenno = ordennoTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL , NULL , $where);
                $this->defineView('report', 'ordenno', session::getInstance()->getFormatOutput());
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            
        }
    }
    }

