<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $id = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID,true)));
                $fecha = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true)));
                $hora = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, true)));
                $id_trabajador = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, true)));
                $id_proveedor = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, true)));
                
                /**
                 * Validaciones para Entrada Bodega
                 */
                $this->Validate($fecha, $hora, $id_trabajador, $id_proveedor);
                
                /* _______________________________ */
                
                $ids= array(
                    entradaBodegaTableClass::ID => $id
                );
                $data = array(
                    entradaBodegaTableClass::FECHA => $fecha,
                    entradaBodegaTableClass::HORA => $hora,
                    entradaBodegaTableClass::ID_TRABAJADOR => $id_trabajador,
                    entradaBodegaTableClass::ID_PROVEEDOR => $id_proveedor,
                );

                entradaBodegaTableClass::update($ids, $data);
                bitacora::register('Actualizar', entradaBodegaTableClass::getNameTable());
            }
            session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
            routing::getInstance()->redirect('entrada_bodega', 'index');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
        private function Validate($fecha, $hora, $id_trabajador, $id_proveedor) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $fechaActual = date('Y-m-d');
   // VALIDACION PARA LA FECHA
    if (preg_match($pattern, $fecha) === FALSE) {
      session::getInstance()->geterror(in18::__('errorDate', NULL, array('%date%' => $fecha, '%character%' => entradaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    if ($fecha === '' or $fecha === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%date%' => $fecha, '%character%' => entradaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    if (strtotime($fecha) > strtotime($fechaActual)) {
      session::getInstance()->setError(i18n::__('errorDate', NULL, 'default', array('%date%' => $fecha, '%character%' => entradaBodegaTableClass::FECHA)), 'errorFecha');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE), TRUE);
    }
    // FIN VALIDACION PARA LA FECHA
    // VALIDACION PARA EL TRABAJADOR
    if (!is_numeric($id_trabajador)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, array('%id_employee%' => $id_trabajador, '%character%' => entradaBodegaTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador === '' or $id_trabajador === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_employye%' => $id_trabajador, '%character%' => entradaBodegaTableClass::ID_TRABAJADOR)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    if ($id_trabajador < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%id_employee%' => $id_trabajador)), 'errorTrabajador');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL TRABAJADOR
   // VALIDACION PARA EL PROVEEDOR
    if (!is_numeric($id_proveedor)) {
      session::getInstance()->setError(i18n::__('errorCharacter', NULL, array('%id_provide%' => $id_proveedor, '%character%' => entradaBodegaTableClass::ID_PROVEEDOR)), 'errorProveedor');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE), TRUE);
    }
    if ($id_proveedor === '' or $id_proveedor === NULL) {
      session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%id_provide%' => $id_proveedor, '%character%' => entradaBodegaTableClass::ID_PROVEEDOR)), 'errorProveedor');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE), TRUE);
    }
    if ($id_proveedor < 0) {
      session::getInstance()->setError(i18n::__('errorNumberNegative', NULL, 'default', array('%id_provide%' => $id_proveedor)), 'errorProveedor');
      $flag = TRUE;
      session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE), TRUE);
    }
    // FIN VALIDACION PARA EL POVEEDOR

        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(entradaBodegaTableClass::ID => request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID,true))));
            routing::getInstance()->forward('entrada_bodega', 'edit');
        }
    }

}
