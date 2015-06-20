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
                $id = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID,true));
                $nombre = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, true));
                $apellido = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true));
                $direccion = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true));
                $telefono = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true));
                $id_turno = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TURNO, true));
                $id_credencial = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true));
                $id_ciudad = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true));
                
                /**
                 * Validaciones para el Trabajador 
                 */
                $this->Validate($nombre, $apellido, $direccion, $telefono, $id_turno, $id_credencial, $id_ciudad);
                
                /* _______________________________ */
                
                $ids= array(
                trabajadorTableClass::ID => $id
                );
                
                $data = array(
                trabajadorTableClass::NOMBRE => $nombre,
                trabajadorTableClass::APELLIDO => $apellido,
                trabajadorTableClass::DIRECCION => $direccion,
                trabajadorTableClass::TELEFONO => $telefono,
                trabajadorTableClass::ID_TURNO => $id_turno,
                trabajadorTableClass::ID_CREDENCIAL => $id_credencial,
                trabajadorTableClass::ID_CIUDAD => $id_ciudad
                );

                trabajadorTableClass::update($ids, $data);
                bitacora::register('Actualizar', trabajadorTableClass::getNameTable());
            }
            session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
            routing::getInstance()->redirect('trabajador', 'index');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
        private function Validate($nombre, $apellido, $direccion, $telefono, $id_turno, $id_credencial, $id_ciudad) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        if (strlen($nombre) > trabajadorTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> trabajadorTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE), TRUE);
                    
        }

        if (!ereg("^[a-zA-Z0-9]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => trabajadorTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE), TRUE);
        }
        if($nombre === '' or $nombre === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE), TRUE);
        }
//        if($genero === '' or $genero === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::GENERO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::GENERO, TRUE), TRUE);            
//        }
//        if($genero !== "F" and $genero !== "M"){// and $genero !== "f"  and $genero !== "m"  ){
//            session::getInstance()->setError(i18n::__('errorGender', NULL, 'default'));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::GENERO, TRUE), TRUE);
//        }
//        if (!is_numeric($edad)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::EDAD)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::EDAD, TRUE), TRUE);
//        }
//        if($edad === '' or $edad === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::EDAD)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::EDAD, TRUE), TRUE);            
//        }
//        if (!is_numeric($peso)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::PESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::PESO, TRUE), TRUE);
//        }
//        if($peso === '' or $peso === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::PESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::PESO, TRUE), TRUE);                        
//        }
//        if(preg_match($pattern, $fecha_ingreso) === FALSE){
//            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => trabajadorTableClass::FECHA_INGRESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::FECHA_INGRESO, TRUE), TRUE);             
//        }
//        if($fecha_ingreso === '' or $fecha_ingreso === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::FECHA_INGRESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::FECHA_INGRESO, TRUE), TRUE);              
//        }
//        if(!is_numeric($numero_partos)){
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::NUMERO_PARTOS)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NUMERO_PARTOS, TRUE), TRUE);            
//        }
//        if($numero_partos === '' or $numero_partos === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => trabajadorTableClass::NUMERO_PARTOS)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NUMERO_PARTOS, TRUE), TRUE);            
//        }
//        if(!is_numeric($id_raza)){
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => trabajadorTableClass::ID_RAZA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(trabajadorTableClass::getNameField(trabajadorTableClass::ID_RAZA, TRUE), TRUE);             
//        }
//        if($id_raza === '' or $id_raza === NULL ){
//            
//        }
//        if(!is_numeric($id_estado)){
//            
//        }
//        if($id_estado === '' or $id_raza === NULL){}
        /* _______________________________ */
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(trabajadorTableClass::ID => request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID,true))));
            routing::getInstance()->forward('trabajador', 'edit');
        }
    }

}
