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
                    $where[insumoTableClass::NOMBRE] = $report['nombre'];
                }
                
                if( isset($report['fecha_fabricacion']) and $report['fecha_fabricacion'] !== NULL and $report['fecha_fabricacion'] !== ''){
                    $where[insumoTableClass::FECHA_FABRICACION] = $report['fecha_fabricacion'];
                }
                
                if( isset($report['fecha_vencimiento']) and $report['fecha_vencimiento'] !== NULL and $report['fecha_vencimiento'] !== ''){
                    $where[insumoTableClass::FECHA_VENCIMIENTO] = $report['fecha_vencimiento'];
                }
                 if( isset($report['valor']) and $report['valor'] !== NULL and $report['valor'] !== ''){
                    $where[insumoTableClass::VALOR] = $report['valor'];
                }
                $fields = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE,
                insumoTableClass::FECHA_FABRICACION,
                insumoTableClass::FECHA_VENCIMIENTO,
                insumoTableClass::VALOR,
                insumoTableClass::ID_TIPO_INSUMO
                );
                $orderBy = array(
                insumoTableClass::ID
                    
                );
                $this->objInsumo = insumoTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL , NULL , $where);
                $this->defineView('report', 'insumo', session::getInstance()->getFormatOutput());
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            
        }
    }
    }

