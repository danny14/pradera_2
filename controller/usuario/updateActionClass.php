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
                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID,true));
                $user_name = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                
                /**
                 * Validaciones para Usuario
                 */
                $this->Validate($user_name,$password);
                
                /* _______________________________ */
                
                $ids= array(
                usuarioTableClass::ID => $id
                );
                $data = array(
                usuarioTableClass::USER => $user_name,
                usuarioTableClass::PASSWORD => $password
                );

                usuarioTableClass::update($ids, $data);
                bitacora::register('Actualizar', usuarioTableClass::getNameTable());
                session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
                routing::getInstance()->redirect('usuario', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
        private function Validate($nombre, $genero, $edad, $peso, $fecha_ingreso, $numero_partos, $id_raza, $id_estado) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        // VALIDACION PARA EL USER NAME
        if($user_name === '' or $user_name === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => usuarioTableClass::USER)),'errorUsuario');
            $flag = TRUE;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);
        } else if (strlen($user_name) > usuarioTableClass::USER_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$user_name,'%character%'=> usuarioTableClass::USER_LENGTH)),'errorUsuario');
            $flag = TRUE;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);          
        }else if (!ereg("^[a-zA-Z0-9]{3,80}$", $user_name)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => usuarioTableClass::NOMBRE)),'errorUsuario');
            $flag = TRUE;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);
        }
        // FIN VALIDACION USER NAME
        
        /*
         * VALIDACION PARA PASSWORD
         */
        if($password === '' or $password === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => usuarioTableClass::PASSWORD)),'errorPassword');
            $flag = TRUE;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);
        } else if (strlen($password) > usuarioTableClass::PASSWORD_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$password,'%character%'=> usuarioTableClass::PASSWORD_LENGTH)),'errorPassword');
            $flag = TRUE;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);          
        }
        /* _______________________________ */
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(usuarioTableClass::ID => request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID,true))));
            routing::getInstance()->forward('usuario', 'edit');
        }
    }

}
