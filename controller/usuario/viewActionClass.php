<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class viewActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasRequest(usuarioTableClass::ID)){
                $fields= array(
                usuarioTableClass::ID,
                usuarioTableClass::NOMBRE,
                usuarioTableClass::GENERO,
                usuarioTableClass::PESO,
                usuarioTableClass::FECHA_INGRESO,
                usuarioTableClass::NUMERO_PARTOS,
                usuarioTableClass::ID_RAZA,
                usuarioTableClass::ID_ESTADO
                );
                $where = array(
                    usuarioTableClass::ID => request::getInstance()->getRequest(usuarioTableClass::ID)
                );
                $this->objUsuario = usuarioTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'usuario', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('usuario', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
