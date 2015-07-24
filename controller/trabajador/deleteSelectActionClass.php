<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {
                $idsToDelete = request::getInstance()->getPost('chk');
                foreach ($idsToDelete as $id){
                    $ids = array(
                    trabajadorTableClass::ID => $id
                    );
                    trabajadorTableClass::delete($ids, FALSE);
                }
                session::getInstance()->setSuccess('Los elementos seleccionados fueron borrados de forma exitosa');
                bitacora::register('Insertar', trabajadorTableClass::getNameTable());
                routing::getInstance()->redirect('trabajador','index');
            } else {
                session::getInstance()->setError('No selecciono ningun registro');
                routing::getInstance()->redirect('trabajador', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                // 42601
                case 23503:
                    session::getInstance()->setError(i18n::__('23503'));
                    routing::getInstance()->redirect('trabajador', 'index');
                    break;
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
                    routing::getInstance()->redirect('trabajador', 'index');
//                    session::getInstance()->setError($exc->getMessage());
                break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    routing::getInstance()->redirect('trabajador', 'index');
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                    routing::getInstance()->redirect('trabajador', 'index');
                break;
            }
//            session::getInstance()->setFlash('exc', $exc);
//            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
