<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class updateActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $id = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::ID,true));
                $descripcion = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION ,true));
                $inicio_turno = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO ,true));
                $fin_turno = request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::FIN_TURNO ,true));
                
                $ids= array(
                turnoTableClass::ID => $id
                );
                $data = array(
                turnoTableClass::DESCRIPCION => $descripcion,
                turnoTableClass::INICIO_TURNO => $inicio_turno,
                turnoTableClass::FIN_TURNO => $fin_turno
                        
                );

                turnoTableClass::update($ids, $data);
            }
                routing::getInstance()->redirect('turno', 'index');
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function Validate($descripcion,$inicio_turno,$fin_turno) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $patternHora="/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])[\:]([0-5][0-9])$/";
        /*
         * VALIDACION DE DESCRIPCION
         */
        if ($descripcion === '' or $descripcion === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => turnoTableClass::DESCRIPCION)));
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, TRUE), TRUE);
        }else if (strlen($descripcion) > turnoTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => turnoTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::DESCRIPCION, TRUE), TRUE);
        }if (!ereg("^[a-zA-Z0-9]{3,80}$", $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => trabajadorTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::NOMBRE, TRUE), TRUE);
        }
        /*
         * VALIDACION DE INICIO TURNO
         */
        if ($inicio_turno === '' or $inicio_turno === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => turnoTableClass::INICIO_TURNO)),'errorInicioTurno');
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO, TRUE), TRUE);
        }elseif (strtotime($inicio_turno) >  strtotime($fin_turno)) {
            session::getInstance()->setError(i18n::__('errorDate2', NULL, 'default', array('%field%' => turnoTableClass::INICIO_TURNO)),'errorInicioTurno');
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO, TRUE), TRUE);
        }
//        if(!preg_match($patternHora, $inicio_turno)){
//            session::getInstance()->setError(i18n::__('errorTime', NULL, 'default',array('%time%' => turnoTableClass::INICIO_TURNO)),'errorInicioTurno');
//            $flag = TRUE;
//            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::INICIO_TURNO, TRUE), TRUE);             
//        }
        /*
         * VALIDACION DE FIN TURNO
         */
        if ($fin_turno === '' or $fin_turno === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => turnoTableClass::FIN_TURNO)),'errorFinTurno');
            $flag = TRUE;
            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::FIN_TURNO, TRUE), TRUE);
        }
//        if(!preg_match($patternHora, $fin_turno)){
//            session::getInstance()->setError(i18n::__('errorTime', NULL, 'default',array('%time%' => turnoTableClass::FIN_TURNO)),'errorFinTurno');
//            $flag = TRUE;
//            session::getInstance()->setFlash(turnoTableClass::getNameField(turnoTableClass::FIN_TURNO, TRUE), TRUE);             
//        }
        
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            request::getInstance()->addParamGet(array(turnoTableClass::ID => request::getInstance()->getPost(turnoTableClass::getNameField(turnoTableClass::ID,true))));
            routing::getInstance()->forward('turno', 'insert');
        }
    }
}

