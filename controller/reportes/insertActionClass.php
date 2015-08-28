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
            $id = array(
            reporteTableClass::ID => request::getInstance()->getRequest(reporteTableClass::ID)
        );
//        print_r($id); 
         session::getInstance()->setAttribute('idReporte', $id);
//    exit();
            $fields = array(
            animalTableClass::NOMBRE
            );
            $orderBy = array(
            animalTableClass::NOMBRE
            );
            $this->idReporte = $
            $this->objAnimal = animalTableClass::getAll($fields, FALSE, $orderBy, $order, $limit, $offset, $where);
            $this->defineView('insert', 'reportes',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
}

