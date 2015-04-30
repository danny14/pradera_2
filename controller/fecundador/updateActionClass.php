<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class updateActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {        
            if (request::getInstance()->isMethod('POST')){
                $id = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::ID, TRUE));
                $nombre = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE,TRUE));
                $edad = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD,TRUE));
                $peso =  request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::PESO,TRUE));
                $observacion = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION,TRUE));
                $id_raza = request::getInstance()->getPost(fecundadorTableClass::getNameField(fecundadorTableClass::ID_RAZA,TRUE));
                $this->Validate($nombre,$edad,$peso,$observacion,$id_raza);
                
                $ids = array(
                fecundadorTableClass::ID => $id
                );
                
                $data= array(
                    fecundadorTableClass::NOMBRE =>$nombre,
                    fecundadorTableClass::EDAD =>$edad,
                    fecundadorTableClass::PESO =>$peso,
                    fecundadorTableClass::OBSERVACION => $observacion,
                    fecundadorTableClass::ID_RAZA => $id_raza,
                );
                fecundadorTableClass::update($ids,$data);
                 bitacora::register('ACTUALIZAR', fecundadorTableClass::getNameTable());
                 routing::getInstance()->redirect('fecundador','index'); 
                   
            }
                routing::getInstance()->redirect('fecundador','index');    
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
       private function Validate($nombre,$edad,$peso,$observacion,$id_raza) {
        $flag = FALSE ;
         if (strlen($nombre) > fecundadorTableClass::NOMBRE_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  fecundadorTableClass::NOMBRE_LENGTH) ));
     
             $flag = TRUE;
             session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE,TRUE), TRUE);
             
        }
        if (is_numeric($edad) === FALSE) {
        session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$edad)));
        $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
        }
        if (is_numeric($peso) === FALSE) {
          session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$peso)));
          $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
        }
        if (strlen($observacion) > fecundadorTableClass::OBSERVACION_LENGTH){ 
            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$observacion,'%Character%' => fecundadorTableClass::OBSERVACION_LENGTH)));
            $flag = TRUE;
        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('fecundador', 'insert');
            
        }
    }
}

