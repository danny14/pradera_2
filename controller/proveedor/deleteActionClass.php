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
                $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, TRUE));
                
                $ids = array(
                proveedorTableClass::ID => $id
                );
                
            proveedorTableClass::delete($ids, FALSE);
            $this->arrayAjax = array(
                'code' => 200,
                'msg' => 'La Eliminacion de registro fue exitosa'
            );
            bitacora::register('ELIMINAR', proveedorTableClass::getNameTable());
            session::getInstance()->setSuccess('El registro fue eliminado de forma exitosa');
            $this->defineView('delete', 'proveedor', session::getInstance()->getFormatOutput());
            } else       
                routing::getInstance()->redirect('proveedor', 'index');
            }
         catch (PDOException $exc) {
           $this->arrayAjax = array(
                'code' => 500,
                'msg' => 'El dato esta siendo utilizado por otra tabla',
                'modal' => 'myModalDelete' . $id
            );
            $this->defineView('delete', 'proveedor', session::getInstance()->getFormatOutput());
        }
    }

}

