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
                $id = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID,true)));
                $nombre = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, true)));
                $genero = strtoupper(trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::GENERO, true))));
                $peso = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::PESO, true)));
                $fecha_ingreso = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, true)));
                $numero_partos = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, true)));
                $id_raza = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_RAZA, true)));
                $id_estado = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_ESTADO, true)));
                
                if($genero === "M"){
                   $numero_partos = 0; 
                }
                /**
                 * Validaciones para el Animal o Hoja de vida
                 */
                $this->Validate($nombre, $genero, $peso, $fecha_ingreso, $numero_partos, $id_raza, $id_estado);
                
                /* _______________________________ */
                
                $ids= array(
                animalTableClass::ID => $id
                );
                $data = array(
                animalTableClass::NOMBRE => $nombre,
                animalTableClass::GENERO => $genero,
                animalTableClass::PESO => $peso,
                animalTableClass::FECHA_INGRESO => $fecha_ingreso,
                animalTableClass::NUMERO_PARTOS => $numero_partos,
                animalTableClass::ID_RAZA => $id_raza,
                animalTableClass::ID_ESTADO => $id_estado
                );

                animalTableClass::update($ids, $data);
                bitacora::register('Actualizar', animalTableClass::getNameTable());
                session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
        private function Validate($nombre, $genero, $peso, $fecha_ingreso, $numero_partos, $id_raza, $id_estado) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        // VALIDACION PARA EL NOMBRE
        if($nombre === '' or $nombre === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        } else if (strlen($nombre) > animalTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> animalTableClass::NOMBRE_LENGTH)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);          
        }else if (!preg_match("/^[a-zA-Z ]{3,80}$/", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => animalTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        }
        // FIN VALIDACION NOMBRE
        
        // FIN DE LA VALIDACION DEL GENERO
        if($genero === '' or $genero === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::GENERO)), 'errorGenero');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE); 
            
        }else if($genero !== "F" and $genero !== "M"){// and $genero !== "f"  and $genero !== "m"  ){
                                                                                       /* se le agrega una llave para el error*/
            session::getInstance()->setError(i18n::__('errorGender', NULL, 'default'), 'errorGenero');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE);
        }
        /*
         * VALIDACION PARA EDAD
         */
//        if($edad === '' or $edad === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::PESO)),'errorEdad');
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);                        
//        }else if (!is_numeric($edad)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::EDAD)),'errorEdad');
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::EDAD, TRUE), TRUE);
//        }
        //-------------------------------------------
        
        /*
         * VALIDACION PESO
         */
        if($peso === '' or $peso === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::PESO)),'errorPeso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);                        
        } else if (!is_numeric($peso)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::PESO)),'errorPeso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);
        }
        /*
         * VALIDACION FECHA INGRESO
         */
        if($fecha_ingreso === '' or $fecha_ingreso === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::FECHA_INGRESO)),'errorFechaIngreso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);              
        }else if(preg_match($pattern, $fecha_ingreso) === FALSE){
            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => animalTableClass::FECHA_INGRESO)),'errorFechaIngreso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);             
        }
        
        /*
         * VALIDACION NUMERO DE PARTOS
         */
        if($numero_partos === '' or $numero_partos === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::NUMERO_PARTOS)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);            
        }else if(!is_numeric($numero_partos)){
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::NUMERO_PARTOS)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);            
        }
        /*
         * VALIDACIONES DE ID RAZA
         */
        if($id_raza === '' or $id_raza === NULL ){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::ID_RAZA)),'errorRaza');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE), TRUE);            
        }
        if(!is_numeric($id_raza)){
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::ID_RAZA)),'errorRaza');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE), TRUE);             
        }
        // ---------------------------------------
        /*
         * VALIDACIONES DE ID ESTADO
         */
        if($id_estado === '' or $id_estado === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::ID_ESTADO)),'errorEstado');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE), TRUE);
        }else if(!is_numeric($id_estado)){
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::ID_ESTADO)),'errorEstado');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE), TRUE);        
        }
        //------------------------------------------
        /* _______________________________ */
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(animalTableClass::ID => request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID,true))));
            routing::getInstance()->forward('animal', 'edit');
        }
    }

}
