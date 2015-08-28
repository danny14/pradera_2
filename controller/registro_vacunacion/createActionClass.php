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
      /* public function execute inicializa las variables 
     * @return $fecha_registro=> fecha_registro (date)
     * @return $id_trabajdor=> id_trabajador (integer)
     * @return $dosis_vacuna=> dosis_vacuna (integer)
     * @return $hora_vacuna=> hora_vacuna(time)
     * @return $id_animal=> id_animal(integer)
     * @return $id_insumo=> id_insumo(integer)
     * todas estos datos se pasa en la varible @var $data
     * ** */
    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $fecha_registro = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE));
                $id_trabajador = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR, TRUE));
                $dosis_vacuna = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA, TRUE));
                $hora_vacuna = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA, TRUE));
                $id_animal = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE));
                $id_insumo = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE));
                
                $this->Validate($fecha_registro,$id_trabajador,$dosis_vacuna,$hora_vacuna,$id_animal,$id_insumo);
               
                $data = array(
                registroVacunacionTableClass::FECHA_REGISTRO => $fecha_registro,
                registroVacunacionTableClass::ID_TRABAJADOR => $id_trabajador,
                registroVacunacionTableClass::DOSIS_VACUNA => $dosis_vacuna,
                registroVacunacionTableClass::HORA_VACUNA => $hora_vacuna,
                registroVacunacionTableClass::ID_ANIMAL => $id_animal,
                registroVacunacionTableClass::ID_INSUMO => $id_insumo
               
                );
                registroVacunacionTableClass::insert($data);
                bitacora::register('INSERTAR', registroVacunacionTableClass::getNameTable());
                session::getInstance()->setSuccess('los datos fueron registrados de forma exitosa');
                routing::getInstance()->redirect('registro_vacunacion','index');
            }else{
                routing::getInstance()->redirect('registro_vacunacion', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
         
        }
    }
    private function Validate($fecha_registro,$id_trabajador,$dosis_vacuna,$hora_vacuna,$id_animal,$id_insumo) {
        $flag = FALSE ;
//         if (strlen($fecha_registro) > registroVacunacionTableClass::FECHA_REGISTRO_LENGTH) {
//             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$fecha_registro,'%Character%' =>  registroVacunacionTableClass::FECHA_REGISTRO_LENGTH) ));
//     
//             $flag = TRUE;
//             session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE), TRUE);
//             
//        }
//        if (!ereg("^[a-zA-Z]{3,20}$", $fecha_registro)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => registroVacunacionTableClass::FECHA_REGISTRO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE), TRUE);
//        }
//        if ($fecha_registro === '' or $fecha_registro === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => registro_vacunacionTableClass::FECHA_REGISTRO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE), TRUE);  
//        
//
//        }
//        
//        
//         if (strlen($dosis_vacuna) > registroVacunacionTableClass::DOSIS_VACUNA_LENGTH) {
//             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$dosis_vacuna,'%Character%' =>  registroVacunacionTableClass::DOSIS_VACUNA_LENGTH) ));
//     
//             $flag = TRUE;
//             session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA,TRUE), TRUE);
//             
//        }
//        if (!ereg("^[a-zA-Z]{3,20}$", $dosis_vacuna)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => registroVacunacionTableClass::DOSIS_VACUNA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA, TRUE), TRUE);
//        }
//        if ($dosis_vacuna === '' or $dosis_vacuna === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => registroVacunacionTableClass::DOSIS_VACUNA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA, TRUE), TRUE);
//            
//            
//        }
//         if (strlen($hora_vacuna) > registroVacunacionTableClass::HORA_VACUNA_LENGTH) {
//             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$hora_vacuna,'%Character%' =>  registroVacunacionTableClass::HORA_VACUNA_LENGTH) ));
//     
//             $flag = TRUE;
//             session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA,TRUE), TRUE);
//             
//        }
//        if (!ereg("^[a-zA-Z]{3,20}$", $hora_vacuna)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => registroVacunacionTableClass::HORA_VACUNA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA, TRUE), TRUE);
//        }
//        if ($hora_vacuna === '' or $hora_vacuna === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => registroVacunacionTableClass::HORA_VACUNA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA, TRUE), TRUE);
    //}
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('registro_vacunacion', 'insert');
            
        }
    }
}

