<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class insertActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            $reporteId = request::getInstance()->getRequest(reporteTableClass::ID);
            $id = array(
            reporteTableClass::ID => request::getInstance()->getRequest(reporteTableClass::ID)
        );
//        print_r($id); 
         session::getInstance()->setAttribute('idReporte', $id);
//    exit();
            $this->reporteId = $reporteId;
            $this->defineView('insert', 'reportes',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
}

