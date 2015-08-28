<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing; 
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


class indexActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            $where = NULL;
//            if(request::getInstance()->hasPost('filter') and request::getInstance()->isMethod('POST')){
//                $filter = request::getInstance()->getPost('filter');
//                /**
//                 * Validacion de los filtros
//                 */
//                $nombre = $filter['nombre'];
//                $fecha_ini = $filter['fechaCreacion1'];
//                $fecha_fin = $filter['fechaCreacion2'];
//                
//                $this->ValidateFilters($nombre,$fecha_ini,$fecha_fin);
//                
//                if(isset($filter['nombre']) and $filter['nombre'] !== NULL and $filter['nombre'] !== ''){
//                    $where[usuarioTableClass::NOMBRE] = $filter['nombre'];
//                }
//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[usuarioTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
//                session::getInstance()->setAttribute('usuarioIndexFilters', $where);
//            } else if(session::getInstance()->hasAttribute('usuarioIndexFilters')){
//            $where = session::getInstance()->getAttribute('usuarioIndexFilters');
//            }
            $fields = array(
            usuarioTableClass::ID,
            usuarioTableClass::USER,
            usuarioTableClass::CREATED_AT,
            );
            $orderBy = array(
            usuarioTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = usuarioTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objUsuario = usuarioTableClass::getAll($fields, FALSE ,$orderBy,'ASC', config::getRowGrid(),$page,$where);
            $this->defineView('index', 'usuario',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
        private function ValidateFilters($user_name,$password) {
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
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('usuario', 'index');
        }
    }
}

