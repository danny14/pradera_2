<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
//use hook\log\logHookClass as bitacora;

class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {
                $idsToDelete = request::getInstance()->getPost('chk');
                foreach ($idsToDelete as $id){
                    $ids = array(
                    pagoTrabajadoresTableClass::ID => $id
                    );
                    pagoTrabajadoresTableClass::delete($ids, FALSE);
                }
                session::getInstance()->setSuccess('Los elementos seleccionados fueron borrados de forma exitosa');
//                bitacora::register('Eliminar Seleccionados', pagoTrabajadoresTableClass::getNameTable());
                routing::getInstance()->redirect('pago_trabajadores','index');
            } else {
                session::getInstance()->setError('No selecciono ningun registro');
                routing::getInstance()->redirect('pago_trabajadores', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
