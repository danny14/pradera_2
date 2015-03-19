<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasRequest(turnoTableClass::ID)){
                $fields= array(
                turnoTableClass::ID,
                turnoTableClass::DESCRIPCION,
                turnoTableClass::INICIO_TURNO,
                turnoTableClass::FIN_TURNO
                );
                $where = array(
                    turnoTableClass::ID => request::getInstance()->getRequest(turnoTableClass::ID)
                );
                $this->objTurno = turnoTableClass::getAll($fields, false , NULL, NULL, NULL , NULL, $where);
                $this->defineView('edit', 'turno', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('turno', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
