<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')) {
                $descripcion = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, true));
                $inicio_turno = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO, true));
                $fin_turno = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::FIN_TURNO, true));
       
                $data = array(
                turnoTableClass::DESCRIPCION => $descripcion,
                turnoTableClass::INICIO_TURNO => $inicio_turno,
                turnoTableClass::FIN_TURNO => $fin_turno
                );
                
                turnoTableClass::insert($data);
                routing::getInstance()->redirect('turno', 'index');
            } else {
                routing::getInstance()->redirect('turno', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
