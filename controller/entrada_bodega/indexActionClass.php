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
            if(request::getInstance()->hasPost('filter') and request::getInstance()->isMethod('POST')){
                $filter = request::getInstance()->getPost('filter');
                /**
                 * Validacion de los filtros
                 */
                $nombre = $filter['nombre'];
                $fecha_ini = $filter['fechaCreacion1'];
                $fecha_fin = $filter['fechaCreacion2'];
                $hora_ini = $filter['horaCreacion1'];
                $hora_fin  = $filter['horaCreacion2'];
                
//                $this->Validate($nombre,$fecha_ini,$fecha_fin,$hora_ini,$hora_fin);
//                
//                if(isset($filter['nombre']) and $filter['nombre'] !== NULL and $filter['nombre'] !== ''){
//                    $where[animalTableClass::NOMBRE] = $filter['nombre'];
//                }
//                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
//                    $where[animalTableClass::FECHA_INGRESO] = array(
//                        $filter['fechaCreacion1'],
//                        $filter['fechaCreacion2']
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
////                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
//                    );
//                }
                session::getInstance()->setAttribute('entradaBodegaIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('entradaBodegaIndexFilters')){
            $where = session::getInstance()->getAttribute('entradaBodegaIndexFilters');
            }
            $fields = array(
            entradaBodegaTableClass::ID,
            entradaBodegaTableClass::FECHA,
            entradaBodegaTableClass::HORA,
            entradaBodegaTableClass::ID_TRABAJADOR,
            entradaBodegaTableClass::ID_PROVEEDOR,
            );
            $orderBy = array(
            entradaBodegaTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = entradaBodegaTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objEntradaBodega = entradaBodegaTableClass::getAll($fields, FALSE ,$orderBy,'ASC', config::getRowGrid(),$page,$where);
            $this->defineView('index', 'entrada_bodega',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
        private function Validate($nombre,$fecha_ini,$fecha_fin) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        if (strlen($nombre) > entradaBodegaTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> entradaBodegaTableClass::NOMBRE_LENGTH),'errorName'));
            $flag = TRUE;
            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::NOMBRE, TRUE), TRUE);
            session::getInstance()->setFlash('modalFilter', true);
                    
        }

        if (!ereg("^[a-zA-Z0-9]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => entradaBodegaTableClass::NOMBRE)),'errorName');
            $flag = TRUE;
            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::NOMBRE, TRUE), TRUE);
        }
//        if($nombre === '' or $nombre === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => entradaBodegaTableClass::NOMBRE)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::NOMBRE, TRUE), TRUE);
//        }
//        if($genero === '' or $genero === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => entradaBodegaTableClass::GENERO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::GENERO, TRUE), TRUE);            
//        }
//        if($genero !== "F" and $genero !== "M"){// and $genero !== "f"  and $genero !== "m"  ){
//            session::getInstance()->setError(i18n::__('errorGender', NULL, 'default'));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::GENERO, TRUE), TRUE);
//        }
//        if (!is_numeric($edad)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => entradaBodegaTableClass::EDAD)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EDAD, TRUE), TRUE);
//        }
//        if($edad === '' or $edad === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => entradaBodegaTableClass::EDAD)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EDAD, TRUE), TRUE);            
//        }
//        if (!is_numeric($peso)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => entradaBodegaTableClass::PESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::PESO, TRUE), TRUE);
//        }
//        if($peso === '' or $peso === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => entradaBodegaTableClass::PESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::PESO, TRUE), TRUE);                        
//        }
//        if(preg_match($pattern, $fecha_ingreso) === FALSE){
//            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => entradaBodegaTableClass::FECHA_INGRESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA_INGRESO, TRUE), TRUE);             
//        }
//        if($fecha_ingreso === '' or $fecha_ingreso === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => entradaBodegaTableClass::FECHA_INGRESO)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA_INGRESO, TRUE), TRUE);              
//        }
//        if(!is_numeric($numero_partos)){
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => entradaBodegaTableClass::NUMERO_PARTOS)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::NUMERO_PARTOS, TRUE), TRUE);            
//        }
//        if($numero_partos === '' or $numero_partos === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => entradaBodegaTableClass::NUMERO_PARTOS)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::NUMERO_PARTOS, TRUE), TRUE);            
//        }
//        if(!is_numeric($id_raza)){
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => entradaBodegaTableClass::ID_RAZA)));
//            $flag = TRUE;
//            session::getInstance()->setFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_RAZA, TRUE), TRUE);             
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
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('entrada_bodega', 'index');
        }
    }
}

