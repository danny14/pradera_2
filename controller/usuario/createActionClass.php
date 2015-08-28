<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

/*
 * @author: Danny Steven Ruiz Hernandez
 * @date: 10/03/2015
 * @static:
 * @abstract
 * @category:
 */
class createActionClass extends controllerClass implements controllerActionInterface {
      /* public function execute inicializa las variables 
     * @return $nombre=> nombre (string)
     * @return $genero=> genero (char)
     * @return $peso=> peso (integer)
     * @return $fecha_ingreso=> fecha_ingreso(date)
     * @return $numero_partos=> numero_partos(integer)
     * @return $id_raza=> id_raza(integer)
     * @return $id_estado=> id_estado(integer)
     * todas estos datos se pasa en la varible @var $data
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $user_name = trim(request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true)));
                $password = trim(request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true)));
                
                
                $this->Validate($user_name,$password);

                $data = array(
                    usuarioTableClass::USER => $user_name,
                    usuarioTableClass::PASSWORD => md5($password),
                );

                usuarioTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
                bitacora::register('Insertar', usuarioTableClass::getNameTable());
                routing::getInstance()->redirect('usuario', 'index');
            } else {
                routing::getInstance()->redirect('usuario', 'index');
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
                case 08006:
                    session::getInstance()->setError(i18n::__('08006'));
                    break;
                case 22007:
                    session::getInstance()->setError(i18n::__('22007'));
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
    private function Validate($user_name,$password) {
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
        //------------------------------------------
        /* _______________________________ */
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('usuario', 'insert');
        }
    }

}
