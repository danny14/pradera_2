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
            if(request::getInstance()->hasRequest(ciudadTableClass::ID)){
                $fields= array(
                ciudadTableClass::ID,
                ciudadTableClass::DESCRIPCION
                );
                $where = array(
                    ciudadTableClass::ID => request::getInstance()->getRequest(ciudadTableClass::ID)
                );
                $this->objCiudad = ciudadTableClass::getAll($fields, false , NULL, NULL, NULL , NULL, $where);
                $this->defineView('edit', 'ciudad', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('ciudad', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
