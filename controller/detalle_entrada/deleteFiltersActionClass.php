<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class deleteFiltersActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(session::getInstance()->hasAttribute('detalleEntradaIndexFilters')) {
                session::getInstance()->deleteAttribute('detalleEntradaIndexFilters');
                routing::getInstance()->redirect('detalle_entrada', 'index');
            } else {
                routing::getInstance()->redirect('detalle_entrada', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
