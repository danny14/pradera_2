<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class deleteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
                $id = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID, TRUE));
                
                $ids = array(
                ciudadTableClass::ID => $id
                );
                
            ciudadTableClass::delete($ids, FALSE);
            
            $this->arrayAjax = array(
                ' code ' => 200,
                ' msg ' => 'La Eliminacion de registro fue exitosa'
            );
            $this->defineView('delete', 'ciudad', session::getInstance()->getFormatOutput());
            session::getInstance()->setSuccess('El registro fue eliminado de forma exitosa');
            } else {
                routing::getInstance()->redirect('ciudad', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
