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
                
                if( isset($report['fecha_registro']) and $report['fecha_registro'] !== NULL and $report['fecha_registro'] !== ''){
                    $where[registroVacunacionTableClass::FECHA_REGISTRO] = $report['fecha_registro'];
                    
                if( isset($report['dosis_vacuna']) and $report['dosis_vacuna'] !== NULL and $report['dosis_vacuna'] !== ''){
                    $where[registroVacunacionTableClass::DOSIS_VACUNA] = $report['dosis_vacuna'];
                    
                if( isset($report['hora_vacuna']) and $report['hora_vacuna'] !== NULL and $report['hora_vacuna'] !== ''){
                    $where[registroVacunacionTableClass::HORA_VACUNA] = $report['hora_vacuna'];
               
               
                }
                $fields = array(
                registroVacunacionTableClass::ID,
                registroVacunacionTableClass::FECHA_REGISTRO,
                registroVacunacionTableClass::ID_TRABAJADOR,
                registoVacunacionTableClass::DOSIS_VACUNA,
                registroVacunacionTableClass::HORA_VACUNA,
                registroVacunacionTableClass::ID_ANIMAL,
                registroVacunacionTableClass::ID_INSUMO
               
                );
                $orderBy = array(
                registro_vacunacionTableClass::ID
                    
                );
                $this->objRegistro_vacunacion = registroVacunacionTableClass::getAll($fields, FALSE, $orderBy, 'ASC', NULL , NULL , $where);
                $this->defineView('report', 'registro_vacunacion', session::getInstance()->getFormatOutput());
                }
            }
            }            
                } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            
        }
    }
    }
    
