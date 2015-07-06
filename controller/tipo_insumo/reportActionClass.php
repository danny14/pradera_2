tipo<?php
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
                
                if( isset($report['descripcion']) and $report['descripcion'] !== NULL and $report['descripcion'] !== ''){
                    $where[tipoInsumoTableClass::DESCRIPCION] = $report['descripcion'];
             
                }
                $fields = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION,
       
                );
                $orderBy = array(
                tipoInsumoTableClass::ID
                    
                );
                $this->objTipo_insumo = tipoInsumoTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL , NULL , $where);
                $this->defineView('report', 'tipo_insumo', session::getInstance()->getFormatOutput());
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            
        }
    }
    }

