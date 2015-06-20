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
                $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE));
                $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE));
                $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE));
                $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE));
                $correo = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE));
                $id_ciudad = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, TRUE));
                //$this->Validate($nombre,$apellido,$direccion,$telefono,$correo,$id_ciudad);
               
                $data = array(
                proveedorTableClass::NOMBRE => $nombre,
                proveedorTableClass::APELLIDO => $apellido,
                proveedorTableClass::DIRECCION => $direccion,
                proveedorTableClass::TELEFONO => $telefono,
                proveedorTableClass::CORREO => $correo,
                proveedorTableClass::ID_CIUDAD => $id_ciudad
                );
                proveedorTableClass::insert($data);
                bitacora::register('INSERTAR', proveedorTableClass::getNameTable());
                session::getInstance()->setSuccess('los datos fueron registrados de forma exitosa');
                routing::getInstance()->redirect('proveedor','index');
            }else{
                routing::getInstance()->redirect('proveedor', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
         
        }
    }
//    private function Validate($nombre,$apellido,$direccion,$telefono,$correo,$id_ciudad) {
//        $flag = FALSE ;
//         if (strlen($nombre) > proveedorTableClass::NOMBRE_LENGTH) {
//             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  proveedorTableClass::NOMBRE_LENGTH) ));
//     
//             $flag = TRUE;
//             session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE), TRUE);
//             
//        }
//        if (!ereg("^[a-zA-Z]{3,20}$", $nombre)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => proveedorTableClass::NOMBRE)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);
//        }
//        if ($nombre === '' or $nombre === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => proveedorTableClass::NOMBRE)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);  
//        }
//        if (!ereg("^[a-zA-Z]{3,20}$", $apellido)) {
//        session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%alfanumber%'=>$apellido)));
//        $flag = TRUE;
//        session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE), TRUE);
//        }
//         if ($apellido === '' or $apellido === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => proveedorTableClass::apellido)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::apellido, TRUE), TRUE);
//         }
//        if (is_numeric($direccion) === FALSE) {
//          session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$direccion)));
//          $flag = TRUE;
//        session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION , TRUE), TRUE);
//        }
//         if ($direccion === '' or $direccion === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => proveedorTableClass::direccion)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::direccion, TRUE), TRUE);
//         }
//        if (strlen($telefono) > proveedorTableClass::TELEFONO_LENGTH){ 
//            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$telefono,'%Character%' => proveedorTableClass::TELEFONO_LENGTH)));
//            $flag = TRUE;
//        session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
//        }
//         if (!ereg("^[a-zA-Z]{3,20}$", $telefono)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => proveedorTableClass::TELEFONO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
//        }
//        if ($telefono === '' or $telefono === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => proveedorTableClass::TELEFONO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
//        }
//         if (strlen($correo) > proveedorTableClass::CORREO_LENGTH){ 
//            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$telefono,'%Character%' => proveedorTableClass::CORREO_LENGTH)));
//            $flag = TRUE;
//        session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE), TRUE);
//        }
//         if (!ereg("^[a-zA-Z]{3,20}$", $correo)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => proveedorTableClass::CORREO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE), TRUE);
//        }
//        if ($correo === '' or $correo === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => proveedorTableClass::CORREO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE), TRUE);
//       
//            if($flag === TRUE){
//            request::getInstance()->setMethod('GET');
//            routing::getInstance()->forward('proveedor', 'insert');
//            }
//            
//        }
//    }
    
}
