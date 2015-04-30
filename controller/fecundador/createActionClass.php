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
                $nombre = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE));
                $edad = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE));
                $peso = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE));
                $observacion = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE));
                $id_raza = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA, TRUE));
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
         if (strlen($nombre) > fecundadorTableClass::NOMBRE_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  fecundadorTableClass::NOMBRE_LENGTH) ));
     
             $flag = TRUE;
             session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE,TRUE), TRUE);
             
        }
        if (!ereg("^[a-zA-Z]{3,20}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => fecundadorTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE), TRUE);
        }
        if ($nombre === '' or $nombre === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE), TRUE);  
        }
        if (is_numeric($edad) === FALSE) {
        session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$edad)));
        $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
        }
         if ($edad === '' or $edad === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::EDAD)));
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
         }
        if (is_numeric($peso) === FALSE) {
          session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$peso)));
          $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
        }
         if ($peso === '' or $peso === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::PESO)));
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
         }
        if (strlen($observacion) > fecundadorTableClass::OBSERVACION_LENGTH){ 
            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$observacion,'%Character%' => fecundadorTableClass::OBSERVACION_LENGTH)));
            $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
        }
         if (!ereg("^[a-zA-Z]{3,20}$", $observacion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => fecundadorTableClass::OBSERVACION)));
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
        }
        if ($observacion === '' or $observacion === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::OBSERVACION)));
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('fecundador', 'insert');
            
        }
    }
    }

