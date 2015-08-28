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
            if(request::getInstance()->hasGet(usuarioTableClass::ID)){
                $fields= array(
                usuarioTableClass::ID,
                usuarioTableClass::USER,
                usuarioTableClass::PASSWORD,
  
                );
                $where = array(
                    usuarioTableClass::ID => request::getInstance()->getGet(usuarioTableClass::ID)
                );
                $this->objUsuario = usuarioTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                
                $this->defineView('edit', 'usuario', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('usuario', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
