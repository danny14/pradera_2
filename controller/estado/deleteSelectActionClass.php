<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {
                $idsToDelete = request::getInstance()->getPost('chk');
                foreach ($idsToDelete as $id){
                    $ids = array(
                    estadoTableClass::ID => $id
                    );
                    estadoTableClass::delete($ids, FALSE);
                }
                session::getInstance()->setSuccess('Los elementos seleccionados fueron borrados de forma exitosa');
                routing::getInstance()->redirect('estado','index');
            } else {
                session::getInstance()->setError('No selecciono ningun registro');
                routing::getInstance()->redirect('estado', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                // 42601
                case 23503:
                    session::getInstance()->setError(i18n::__('23503'));
                    routing::getInstance()->redirect('estado', 'index');
                    break;
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
                    routing::getInstance()->redirect('estado', 'index');
//                    session::getInstance()->setError($exc->getMessage());
                break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    routing::getInstance()->redirect('estado', 'index');
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                    routing::getInstance()->redirect('estado', 'index');
                break;
            }
//            session::getInstance()->setFlash('exc', $exc);
//            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
