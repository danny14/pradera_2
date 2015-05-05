<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class deleteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
                $id = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID, TRUE));
                
                if (validacion()) {
                    $this->arrayAjax = array(
                'code' => 500,
                'msg' => 'FALLO'
            );
             session::getInstance()->setError('FALLO');       
                } else {
                
                $ids = array(
                animalTableClass::ID => $id
                );
                
            animalTableClass::delete($ids, FALSE);
            $this->arrayAjax = array(
                'code' => 200,
                'msg' => 'La Eliminacion de registro fue exitosa'
            );
            session::getInstance()->setSuccess('El registro fue eliminado de forma exitosa');
            bitacora::register('Eliminar Individual', animalTableClass::getNameTable());
                }
            $this->defineView('delete', 'animal', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
