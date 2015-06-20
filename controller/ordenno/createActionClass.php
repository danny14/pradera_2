<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class createActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $fecha_ordenno = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE));
                $cantidad_leche = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE));
                $id_trabajador = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE));
                $id_animal = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE));
              
               //$this->Validate($fecha_ordenno,$cantidad_leche,$id_trabajador,$id_animal);
               
                $data = array(
                ordennoTableClass::FECHA_ORDENNO => $fecha_ordenno,
                ordennoTableClass::CANTIDAD_LECHE => $cantidad_leche,
                ordennoTableClass::ID_TRABAJADOR => $id_trabajador,
                ordennoTableClass::ID_ANIMAL => $id_animal,
                    
               );
                
                ordennoTableClass::insert($data);
                bitacora::register('INSERTAR', ordennoTableClass::getNameTable());
                session::getInstance()->setSuccess('los datos fueron registrados de forma exitosa');
                routing::getInstance()->redirect('ordenno','index');
            }else{
                routing::getInstance()->redirect('ordenno', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
         
        }
    }
    private function Validate($fecha_ordenno, $cantidad_leche, $id_trabajador, $id_animal) {
        $flag = FALSE;
        if (strlen($fecha_ordenno) > ordennoTableClass::FECHA_ORDENNO_LENGTH) {
            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $fecha_ordenno, '%Character%' => ordennoTableClass::FECHA_ORDENNO_LENGTH)));

            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE), TRUE);
        }
        if (!ereg("^[a-zA-Z]{3,20}$", $fecha_ordenno)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default', array('%field%' => fecha_ordennoTableClass::FECHA_ORDENNO)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE), TRUE);
        }
        if ($fecha_ordenno === '' or $fecha_ordenno === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::FECHA_ORDENNO)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::fecha_ordenno, TRUE), TRUE);
        }
        if (!ereg("^[a-zA-Z]{3,20}$", $cantidad_leche)) {
            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%alfanumber%' => $cantidad_leche)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE), TRUE);
        }
        if ($cantidad_leche === '' or $cantidad_leche === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::cantidad_leche)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::cantidad_leche, TRUE), TRUE);
        }
        if (is_numeric($id_trabajador) === FALSE) {
            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%number%' => $id_trabajador)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE), TRUE);
        }
        if ($id_trabajador === '' or $id_trabajador === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::id_trabajador)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::id_trabajador, TRUE), TRUE);
        }
          if (is_numeric($id_animal) === FALSE) {
            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%number%' => $id_animal)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE), TRUE);
        }
        if ($id_animal === '' or $id_animal === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::id_animal)));
            $flag = TRUE;
            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::id_animal, TRUE), TRUE);
       
      

}
}
}