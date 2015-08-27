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
                $id = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID, TRUE));
                $fecha_registro = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE));
                $id_trabajador = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_TRABAJADOR,TRUE));
                $dosis_vacuna = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA,TRUE));
                $hora_vacuna = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA,TRUE));
                $id_animal = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL,TRUE));
                $id_insumo = request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO,TRUE));
                $this->Validate($fecha_registro,$id_trabajador,$dosis_vacuna,$hora_vacuna,$id_animal,$id_insumo);
                
                $ids = array(
                registroVacunacionTableClass::ID => $id
                );
                
                $data= array(
                    registroVacunacionTableClass::FECHA_REGISTRO =>$fecha_registro,
                    registroVacunacionTableClass::ID_TRABAJADOR =>$id_trabajador,
                    registroVacunacionTableClass::DOSIS_VACUNA =>$dosis_vacuna,
                    registroVacunacionTableClass::HORA_VACUNA =>$hora_vacuna,
                    registroVacunacionTableClass::ID_ANIMAL =>$id_animal,
                    registroVacunacionTableClass::ID_INSUMO =>$id_insumo
                        
                    
                   
                );
                registroVacunacionTableClass::update($ids,$data);
                 bitacora::register('ACTUALIZAR', registroVacunacionTableClass::getNameTable());
                 routing::getInstance()->redirect('registro_vacunacion','index'); 
                   
            }
                routing::getInstance()->redirect('registro_vacunacion','index');    
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
       private function Validate($fecha_registro, $id_trabajador, $dosis_vacuna, $hora_vacuna, $id_animal, $id_insumo) {
        $flag = FALSE;
//        if (strlen($fecha_registro) > registroVacunacionTableClass::FECHA_REGISTRO_LENGTH) {
//            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $fecha_registro, '%Character%' => registroVacunacionTableClass::FECHA_REGISTRO_LENGTH)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO, TRUE), TRUE);
//        }
//        if (strlen($dosis_vacuna) > registroVacunacionTableClass::DOSIS_VACUNA_LENGTH) {
//            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $dosis_vacuna, '%Character%' => registroVacunacionTableClass::DOSIS_VACUNA_LENGTH)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::DOSIS_VACUNA, TRUE), TRUE);
//        }
//        if (strlen($hora_vacuna) > registroVacunacionTableClass::HORA_VACUNA_LENGTH) {
//            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $hora_vacuna, '%Character%' => registroVacunacionTableClass::HORA_VACUNA_LENGTH)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::HORA_VACUNA, TRUE), TRUE);
//        }
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('registro_vacunacion', 'insert');
        }
    }

}