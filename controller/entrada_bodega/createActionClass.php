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
     * @return $fecha=> fecha (date)
     * @return $hora=> hora (integer)
     * @return $id_trabajador=> id_trabajador (integer)
     * @return $id_proveedor=> id_proveedor(integer)
     * todas estos datos se pasa en la varible @var $data
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $fecha = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true)));
                $hora = strtoupper(trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, true))));
                $id_trabajador = trim(request::getInstance()->getPost(entradaBodegaBaseTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, true)));
                $id_proveedor = trim(request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, true)));

                
                $this->Validate($fecha, $hora, $id_trabajador, $id_proveedor);

                $data = array(
                    entradaBodegaTableClass::FECHA => $fecha,
                    entradaBodegaTableClass::HORA => $hora,
                    entradaBodegaTableClass::ID_TRABAJADOR => $id_trabajador,
                    entradaBodegaTableClass::ID_PROVEEDOR => $id_proveedor,
                );

                entradaBodegaTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
                bitacora::register('Insertar', animalTableClass::getNameTable());
                routing::getInstance()->redirect('entrada_bodega', 'index');
            } else {
                routing::getInstance()->redirect('entrada_bodega', 'index');
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
    private function Validate($fecha, $hora, $id_trabajador, $id_proveedor) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
//        if (strlen($nombre) > animalTableClass::NOMBRE_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> animalTableClass::NOMBRE_LENGTH)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
//                    
//        }
//
//        if (!ereg("^[a-zA-Z0-9]{3,80}$", $nombre)) {
//            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => animalTableClass::NOMBRE)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
//        }
//        if($nombre === '' or $nombre === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::NOMBRE)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
//        }
//        if($genero === '' or $genero === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::GENERO)), 'errorGenero');
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE);            
//        }
//        if($genero !== "F" and $genero !== "M"){// and $genero !== "f"  and $genero !== "m"  ){
//                                                                                       /* se le agrega una llave para el error*/
//            session::getInstance()->setError(i18n::__('errorGender', NULL, 'default'), 'errorGenero');
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE);
//        }
//        if (!is_numeric($edad)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::EDAD)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::EDAD, TRUE), TRUE);
//        }
//        if($edad === '' or $edad === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::EDAD)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::EDAD, TRUE), TRUE);            
//        }
//        if (!is_numeric($peso)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::PESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);
//        }
//        if($peso === '' or $peso === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::PESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);                        
//        }
//        if(preg_match($pattern, $fecha_ingreso) === FALSE){
//            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => animalTableClass::FECHA_INGRESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);             
//        }
//        if($fecha_ingreso === '' or $fecha_ingreso === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::FECHA_INGRESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);              
//        }
//        if(!is_numeric($numero_partos)){
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::NUMERO_PARTOS)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);            
//        }
//        if($numero_partos === '' or $numero_partos === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::NUMERO_PARTOS)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);            
//        }
//        if(!is_numeric($id_raza)){
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::ID_RAZA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE), TRUE);             
//        }
//        if($id_raza === '' or $id_raza === NULL ){
//            
//        }
//        if(!is_numeric($id_estado)){
//            
//        }
//        if($id_estado === '' or $id_raza === NULL){}
        /* _______________________________ */
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('entrada_bodega', 'insert');
        }
    }

}
