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
         if($reporteId == 2){
             $fields = array(
             razaTableClass::ID,
             razaTableClass::DESCRIPCION
             );
             $orderBy = array(
             razaTableClass::DESCRIPCION
             );
             $this->objRaza = razaTableClass::getAll($fields, false, $orderBy, 'ASC');
         }
         session::getInstance()->setAttribute('idReporte', $id);

         $this->reporteId = $reporteId;
            $this->defineView('insert', 'reportes',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
}

