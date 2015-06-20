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
                $id = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID, TRUE));
                
                $ids = array(
                credencialTableClass::ID => $id
                );
                
            credencialTableClass::delete($ids, FALSE);
            
            $this->arrayAjax = array(
                ' code ' => 200,
                ' msg ' => 'La Eliminacion de registro fue exitosa'
            );
            $this->defineView('delete', 'credencial', session::getInstance()->getFormatOutput());
            session::getInstance()->setSuccess('El registro fue eliminado de forma exitosa');
            } else {
                routing::getInstance()->redirect('credencial', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
