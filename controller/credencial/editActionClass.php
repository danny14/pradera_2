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
            if(request::getInstance()->hasRequest(credencialTableClass::ID)){
                $fields= array(
                credencialTableClass::NOMBRE,
                credencialTableClass::CREATED_AT
                );
                $where = array(
                    credencialTableClass::ID => request::getInstance()->getRequest(credencialTableClass::ID)
                );
                $this->objCredencial = credencialTableClass::getAll($fields, false , NULL, NULL, NULL , NULL, $where);
                $this->defineView('edit', 'credencial', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('credencial', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
