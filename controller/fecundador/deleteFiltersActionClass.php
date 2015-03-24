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
            if(session::getInstance()->hasAttribute('fecundadorIndexFilters')) {
                session::getInstance()->deleteAttribute('fecundadorIndexFilters');
                routing::getInstance()->redirect('fecundador', 'index');
            } else {
                routing::getInstance()->redirect('fecundador', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
