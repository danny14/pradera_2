<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $nombre = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, true)));
                $genero = strtoupper(trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::GENERO, true))));
                $edad = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::EDAD, true)));
                $peso = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::PESO, true)));
                $fecha_ingreso = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, true)));
                $numero_partos = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, true)));
                $id_raza = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_RAZA, true)));
                $id_estado = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_ESTADO, true)));
                
                $this->Validate($nombre,$genero,$edad,$peso,$fecha_ingreso,$numero_partos,$id_raza,$id_estado);

                $data = array(
                    animalTableClass::NOMBRE => $nombre,
                    animalTableClass::GENERO => $genero,
                    animalTableClass::EDAD => $edad,
                    animalTableClass::PESO => $peso,
                    animalTableClass::FECHA_INGRESO => $fecha_ingreso,
                    animalTableClass::NUMERO_PARTOS => $numero_partos,
                    animalTableClass::ID_RAZA => $id_raza,
                    animalTableClass::ID_ESTADO => $id_estado
                );

                animalTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
                bitacora::register('Insertar', animalTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'index');
            } else {
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                // 42601
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
//                    session::getInstance()->setError($exc->getMessage());
                break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                break;
            }
//            routing::getInstance()->redirect('animal', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');            
        }
    }
    /**
     * Validaciones para el Animal o Hoja de vida
     */
    private function Validate($nombre, $genero, $edad, $peso, $fecha_ingreso, $numero_partos, $id_raza, $id_estado) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        if (strlen($nombre) > animalTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> animalTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
                    
        }

        if (!ereg("^[a-zA-Z0-9]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => animalTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        }
        if($nombre === '' or $nombre === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        }
        if($genero === '' or $genero === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::GENERO)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE);            
        }
        if($genero !== "F" and $genero !== "M"){// and $genero !== "f"  and $genero !== "m"  ){
            session::getInstance()->setError(i18n::__('errorGender', NULL, 'default'));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE);
        }
        if (!is_numeric($edad)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::EDAD)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::EDAD, TRUE), TRUE);
        }
        if($edad === '' or $edad === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::EDAD)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::EDAD, TRUE), TRUE);            
        }
        if (!is_numeric($peso)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::PESO)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);
        }
        if($peso === '' or $peso === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::PESO)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);                        
        }
        if(preg_match($pattern, $fecha_ingreso) === FALSE){
            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => animalTableClass::FECHA_INGRESO)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);             
        }
        if($fecha_ingreso === '' or $fecha_ingreso === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::FECHA_INGRESO)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);              
        }
        if(!is_numeric($numero_partos)){
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::NUMERO_PARTOS)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);            
        }
        if($numero_partos === '' or $numero_partos === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::NUMERO_PARTOS)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);            
        }
//        if(!is_numeric($id_raza)){
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::ID_RAZA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE), TRUE);             
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
            routing::getInstance()->forward('animal', 'insert');
        }
    }

}
