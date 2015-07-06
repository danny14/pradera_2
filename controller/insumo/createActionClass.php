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
                $nombre = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE));
                $fecha_fabricacion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, TRUE));
                $fecha_vencimiento = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE));
                $valor = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE));
                $id_tipo_insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID_TIPO_INSUMO, TRUE));
                $this->Validate($nombre,$fecha_fabricacion,$fecha_vencimiento,$valor,$id_tipo_insumo);
               
                $data = array(
                insumoTableClass::NOMBRE => $nombre,
                insumoTableClass::FECHA_FABRICACION => $fecha_fabricacion,
                insumoTableClass::FECHA_VENCIMIENTO => $fecha_vencimiento,
                insumoTableClass::VALOR => $valor,
                insumoTableClass::ID_TIPO_INSUMO => $id_tipo_insumo
                );
                insumoTableClass::insert($data);
                bitacora::register('INSERTAR', insumoTableClass::getNameTable());
                session::getInstance()->setSuccess('los datos fueron registrados de forma exitosa');
                routing::getInstance()->redirect('insumo','index');
            }else{
                routing::getInstance()->redirect('insumo', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
         
        }
    }
    private function Validate($nombre,$fecha_fabricacion,$fecha_vencimiento,$valor,$id_tipo_insumo) {
        //ACOMODAR LAS VALIDACIONES POR ESTAN MALAS MENCIONA A EDAD Y EDAD AQUI NO EXISTE
//        $flag = FALSE ;
//         if (strlen($nombre) > insumoTableClass::NOMBRE_LENGTH) {
//             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  insumoTableClass::NOMBRE_LENGTH) ));
//     
//             $flag = TRUE;
//             session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE,TRUE), TRUE);
//             
//        }
//        if (!ereg("^[a-zA-Z]{3,20}$", $nombre)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => insumoTableClass::NOMBRE)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE), TRUE);
//        }
//        if ($nombre === '' or $nombre === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => insumoTableClass::NOMBRE)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE), TRUE); 
//            //njgnugkqepofkoirhijdigofpk.................................
//        }
//        if (is_numeric($edad) === FALSE) {
//        session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$edad)));
//        $flag = TRUE;
//        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
//        }
//         if ($edad === '' or $edad === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::EDAD)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
//         }
//        if (is_numeric($peso) === FALSE) {
//          session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>$peso)));
//          $flag = TRUE;
//        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
//        }
//         if ($peso === '' or $peso === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::PESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
//         }
//        if (strlen($observacion) > fecundadorTableClass::OBSERVACION_LENGTH){ 
//            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$observacion,'%Character%' => fecundadorTableClass::OBSERVACION_LENGTH)));
//            $flag = TRUE;
//        session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
//        }
//         if (!ereg("^[a-zA-Z]{3,20}$", $observacion)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => fecundadorTableClass::OBSERVACION)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
//        }
//        if ($observacion === '' or $observacion === NULL){
//           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => fecundadorTableClass::OBSERVACION)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::OBSERVACION, TRUE), TRUE);
//        }
//        if($flag === TRUE){
//            request::getInstance()->setMethod('GET');
//            routing::getInstance()->forward('fecundador', 'insert');
//            
//        }
    }
    }

