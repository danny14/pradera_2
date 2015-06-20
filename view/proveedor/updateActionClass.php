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
                $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, TRUE));
                $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE));
                $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO,TRUE));
                $direccion =  request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION,TRUE));
                $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO,TRUE));
                $correo = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO,TRUE));
                $id_ciudad = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD,TRUE));
                $this->Validate($nombre,$apellido,$direccion,$telefono,$correo,$id_ciudad);
                
                $ids = array(
                proveedorTableClass::ID => $id
                );
                
                $data= array(
                    proveedorTableClass::NOMBRE =>$nombre,
                    proveedorTableClass::APELLIDO =>$apellido,
                    proveedorTableClass::DIRECCION =>$direccion,
                    proveedorTableClass::TELEFONO => $telefono,
                    proveedorTableClass::CORREO => $correo,
                    proveedorTableClass::ID_CIUDAD => $id_ciudad,
                );
                proveedorTableClass::update($ids,$data);
                 bitacora::register('ACTUALIZAR', proveedorTableClass::getNameTable());
                 routing::getInstance()->redirect('proveedor','index'); 
                   
            }
                routing::getInstance()->redirect('proveedor','index');    
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
       private function Validate($nombre,$apellido,$direccion,$telefono,$correo,$id_ciudad) {
        $flag = FALSE ;
         if (strlen($nombre) > proveedorTableClass::NOMBRE_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  proveedorTableClass::NOMBRE_LENGTH) ));
     
             $flag = TRUE;
             session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE), TRUE);
             
        }
        if (strlen($apellido)> proveedorTableClass::APELLIDO_LENGTH) {
        session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$apellido)));
        $flag = TRUE;
        session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE), TRUE);
        }
        if (is_numeric($direccion) === FALSE) {
          session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$direccion)));
          $flag = TRUE;
        session::getInstance()->setFlash(proveedorrTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE), TRUE);
        }
        if (is_numeric($telefono)=== FALSE){ 
            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$telefono,'%Character%' => proveedorTableClass::TELEFONO_LENGTH)));
            $flag = TRUE;
        session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
        }
       $flag = FALSE ;
         if (strlen($correo) > proveedorTableClass::CORREO_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  proveedorTableClass::CORREO_LENGTH) ));
     
             $flag = TRUE;
             session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO,TRUE), TRUE);
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('proveedor', 'insert');
        }
        }
    }
}

