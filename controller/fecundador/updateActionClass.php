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
                
                if(!ereg("^[a-zA-Z0-9]{3,20}$", $nombre)){
                    throw new PDOException('el nombre no puede contener caracteres especiales');
                }
                if(strlen($nombre)>fecundadorTableClass::NOMBRE_LENGTH){
                    throw new PDOException('el nombre no puede ser mayor a '.fecundadorTableClass::NOMBRE_LENGTH.' Caracteres');
                }
                if(is_numeric($edad) === FALSE){
                    throw  new PDOException('caracteres no validos tienen que ser numericos');
                }
                if(is_numeric($peso) === FALSE){
                    throw new PDOException('caracteres no validos tienen que ser numericos');
                }
                if(strlen($observacion)>fecundadorTableClass::OBSERVACION_LENGTH){
                    throw new PDOException('la observacion no puede ser mayor a'.fecundadorTableClass::OBSERVACION_LENGTH.' caracteres ');
                }
                
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
}

