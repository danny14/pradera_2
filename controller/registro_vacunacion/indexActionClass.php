<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class indexActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            /**
             * filtros para el index con paginacion incluida
             */
            $where = NULL;
            if(request::getInstance()->hasPost('filter')){
                $filter = request::getInstance()->getPost('filter');
                // aqui validar datos de filtros
                if(isset($filter['fecha_registro']) and $filter['fecha_registro'] !== NULL and $filter['fecha_registro'] !== ''){
                    $where[registroVacunacionTableClass::FECHA_REGISTRO] = $filter['fecha_registro'];
                    
                }
                 if(isset($filter['dosis_vacuna']) and $filter['dosis_vacuna'] !== NULL and $filter['dosis_vacuna'] !== ''){
                    $where[registroVacunacionTableClass::DOSIS_VACUNA] = $filter['dosis_vacuna'];
                }
                 if(isset($filter['hora_vacuna']) and $filter['hora_vacuna'] !== NULL and $filter['hora_vacuna'] !== ''){
                    $where[registroVacunacionTableClass::HORA_VACUNA] = $filter['hora_vacuna'];
                 }
                 
                    
                session::getInstance()->setAttribute('registroVacunacionIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('registroVacunacionIndexFilters')){
            $where = session::getInstance()->getAttribute('registroVacunacionIndexFilters');
            }
            
            $fields= array(
            registroVacunacionTableClass::ID,
            registroVacunacionTableClass::FECHA_REGISTRO,
            registroVacunacionTableClass::DOSIS_VACUNA,
            registroVacunacionTableClass::HORA_VACUNA,
            registroVacunacionTableClass::ID_ANIMAL,
            registroVacunacionTableClass::ID_INSUMO,
            registroVacunacionTableClass::ID_TRABAJADOR
            );
            $orderBy = array(
            registroVacunacionTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = registroVacunacionTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objRegistro_vacunacion =  registroVacunacionTableClass::getAll($fields, FALSE,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'registro_vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

