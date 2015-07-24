<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class viewActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasRequest(turnoTableClass::ID)){
                $fields= array(
                turnoTableClass::ID,
                turnoTableClass::DESCRIPCION,
                );
                $where = array(
                    turnoTableClass::ID => request::getInstance()->getRequest(turnoTableClass::ID)
                );
                $this->objTurno = turnoTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'turno', session::getInstance()->getFormatOutput());
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
