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
                $id = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::ID, TRUE));
                $fecha_ordenno = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO,TRUE));
                $cantidad_leche = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE,TRUE));
                $id_trabajador =  request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJDOR,TRUE));
                $id_animal = request::getInstance()->getPost(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL,TRUE));
                $this->Validate($fecha_ordenno,$cantidad_leche,$id_trabajador,$id_animal);
                
                $ids = array(
                ordennoTableClass::ID => $id
                );
                
                $data= array(
                    ordennoTableClass::FECHA_ORDENNO =>$fecha_ordenno,
                    ordennoTableClass::CANTIDAD_LECHE =>$cantidad_leche,
                    ordennoTableClass::ID_TRABAJADOR =>$id_trabajador,
                    ordennoTableClass::ID_ANIMAL => $id_animal
                   
                );
                ordennoTableClass::update($ids,$data);
                 bitacora::register('ACTUALIZAR', ordennoTableClass::getNameTable());
                 routing::getInstance()->redirect('ordenno','index'); 
                   
            }
                routing::getInstance()->redirect('ordenno','index');    
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
       private function Validate($fecha_ordenno,$cantidad_leche,$id_trabajador,$id_animal) {
        $flag = FALSE ;
         if (strlen($fecha_ordenno) > ordennoTableClass::FECHA_ORDENNO_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$fecha_ordenno,'%Character%' =>  ordennoTableClass::FECHA_ORDENNO_LENGTH) ));
     
             $flag = TRUE;
             session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO,TRUE), TRUE);
             
        }
        if (strlen($cantidad_leche)> ordennoTableClass::CANTIDAD_LECHE_LENGTH) {
        session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$cantidad_leche)));
        $flag = TRUE;
        session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE), TRUE);
        }
       
     
            
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('ordenno', 'insert');
        }
        }
    }


