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
                $nombre = trim(request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)));
                $edad = trim(request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)));
                $peso = trim(request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)));
                $observacion = trim(request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE)));
                $id_raza = trim(request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE)));
                
                $this->Validate($nombre,$edad,$peso,$observacion,$id_raza);
               
                $data = array(
                fecundadorTableClass::NOMBRE => $nombre,
                fecundadorTableClass::EDAD => $edad,
                fecundadorTableClass::PESO => $peso,
                fecundadorTableClass::OBSERVACION => $observacion,
                fecundadorTableClass::ID_RAZA => $id_raza
                );
                fecundadorTableClass::insert($data);
                bitacora::register('INSERTAR', fecundadorTableClass::getNameTable());
                session::getInstance()->setSuccess('los datos fueron registrados de forma exitosa');
                routing::getInstance()->redirect('fecundador','index');
            }else{
                routing::getInstance()->redirect('fecundador', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
//                    session::getInstance()->setError($exc->getMessage());
                    break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    break;
                case "22P02":
                    session::getInstance()->setError('hola este es un error xD ');
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                break;
            }
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception'); 
            //routing::getInstance()->forward('fecundador', 'insert');
        }
    }
    private function Validate($nombre,$edad,$peso,$observacion,$id_raza) {
        $flag = FALSE ;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

        if ($nombre === '' or $nombre === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE), TRUE);  
        }else if (strlen($nombre) > fecundadorTableClass::NOMBRE_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  fecundadorTableClass::NOMBRE_LENGTH) ),'errorNombre');
             $flag = TRUE;
             session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE,TRUE), TRUE);      
        }else if (!ereg("^[a-zA-Z]{3,20}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => fecundadorTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE), TRUE);
        }
        
        if ($edad === '' or $edad === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::EDAD)),'errorEdad');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
        }else if (is_numeric($edad) === FALSE) {
        session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$edad)),'errorEdad');
        $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
        }
         if ($peso === '' or $peso === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::PESO)),'errorPeso');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
         }else if (is_numeric($peso) === FALSE) {
          session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=> $peso )),'errorPeso');
          $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
        }
        
        if ($observacion === '' or $observacion === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::OBSERVACION)),'errorObservacion');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
        }else if (strlen($observacion) > fecundadorTableClass::OBSERVACION_LENGTH){ 
            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$observacion,'%Character%' => fecundadorTableClass::OBSERVACION_LENGTH)),'errorObservacion');
            $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
        }else if (!ereg("^[a-zA-Z]{3,20}$", $observacion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => fecundadorTableClass::OBSERVACION)),'errorObservacion');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
        }
         /*
         * Validacion para ID Raza
         */
         if ($id_raza === '' or $id_raza === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::ID_RAZA)),'errorRaza');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
         }else if (is_numeric($id_raza) === FALSE) {
          session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=> $id_raza )),'errorRaza');
          $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
        }
        
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('fecundador', 'insert');
            
        }
    }
    }

