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
            if(request::getInstance()->hasRequest(entradaBodegaTableClass::ID)){
                $fields= array(
                entradaBodegaTableClass::ID,
                entradaBodegaTableClass::FECHA,
                entradaBodegaTableClass::HORA,
                entradaBodegaTableClass::ID_TRABAJADOR,
                entradaBodegaTableClass::ID_PROVEEDOR,
                );
                $where = array(
                    entradaBOdegaTableClass::ID => request::getInstance()->getRequest(entradaBodegaTableClass::ID)
                );
                $this->objEntradaBodega = entradaBodegaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'entrada_bodega', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('entrada_bodega', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
