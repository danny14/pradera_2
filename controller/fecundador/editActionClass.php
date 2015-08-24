<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
class editActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->hasGet(fecundadorTableClass::ID)){
                $fields = array(
                fecundadorTableClass::ID,
                fecundadorTableClass::NOMBRE,
                fecundadorTableClass::EDAD,
                fecundadorTableClass::PESO,
                fecundadorTableClass::OBSERVACION,
                fecundadorTableClass::ID_RAZA
                );
                $where = array(
                fecundadorTableClass::ID => request::getInstance()->getGet(fecundadorTableClass::ID)
                );
                $this->objFecundador = fecundadorTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                
                $fields = array(
                razaTableClass::ID,
                razaTableClass::DESCRIPCION
                );
                $orderBy = array(
                razaTableClass::DESCRIPCION
                );
                
                $this->objRaza = razaTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                $this->defineView('edit', 'fecundador', session::getInstance()->getFormatOutput());
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}
