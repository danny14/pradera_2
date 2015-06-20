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
            if(request::getInstance()->hasRequest(trabajadorTableClass::ID)){
                $fields= array(
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
                trabajadorTableClass::APELLIDO,
                trabajadorTableClass::DIRECCION,
                trabajadorTableClass::TELEFONO,
                trabajadorTableClass::ID_TURNO,
                trabajadorTableClass::ID_CREDENCIAL,
                trabajadorTableClass::ID_CIUDAD
                );
                $where = array(
                    trabajadorTableClass::ID => request::getInstance()->getRequest(trabajadorTableClass::ID)
                );
                $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'trabajador', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('trabajador', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
