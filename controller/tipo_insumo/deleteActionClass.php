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
                $id = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, TRUE));
                
                $ids = array(
                tipoInsumoTableClass::ID => $id
                );
                
            tipoInsumoTableClass::delete($ids, FALSE);
            $this->arrayAjax = array(
                'code' => 200,
                'msg' => 'La Eliminacion de registro fue exitosa'
            );
            session::getInstance()->setSuccess('El registro fue eliminado de forma exitosa');
            bitacora::register('ELIMINAR', tipoInsumoTableClass::getNameTable());
            $this->defineView('delete', 'tipo_insumo', session::getInstance()->getFormatOutput());
            } else 
                 
                routing::getInstance()->redirect('tipo_insumo', 'index');
            }
         catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}

