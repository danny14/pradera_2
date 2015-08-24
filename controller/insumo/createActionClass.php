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
                $nombre = trim(request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE)));
                $fecha_fabricacion = trim(request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, TRUE)));
                $fecha_vencimiento = trim(request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE)));
                $valor = trim(request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE)));
                $id_tipo_insumo = trim(request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID_TIPO_INSUMO, TRUE)));
                
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
         $flag = FALSE ;
         $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
         /*
          * Validacion para Nombre
          */
        if ($nombre === '' or $nombre === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => insumoTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE), TRUE);  
        }else if (strlen($nombre) > insumoTableClass::NOMBRE_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  insumoTableClass::NOMBRE_LENGTH) ),'errorNombre');
             $flag = TRUE;
             session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE,TRUE), TRUE);      
        }else if (!ereg("^[a-zA-Z ]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => insumoTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE, TRUE), TRUE);
        }
        /*
         * Validacion para Fecha Fabricacion
         */
        if($fecha_fabricacion === '' or $fecha_fabricacion === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => insumoTableClass::FECHA_FABRICACION)),'errorFechaFabricacion');
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, TRUE), TRUE);              
        }else if(!preg_match($pattern, $fecha_fabricacion)){
            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => insumoTableClass::FECHA_FABRICACION)),'errorFechaFabricacion');
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_INGRESO, TRUE), TRUE);             
        }
        /*
         * Validacion para Fecha Vencimiento
         */
        if($fecha_vencimiento === '' or $fecha_vencimiento === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => insumoTableClass::FECHA_VENCIMIENTO)),'errorFechaVencimiento');
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE), TRUE);              
        }else if(!preg_match($pattern, $fecha_vencimiento)){
            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => insumoTableClass::FECHA_VENCIMIENTO)),'errorFechaVencimiento');
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE), TRUE);             
        } 
        /*
         * Validacion para Valor
         */
        if($valor === '' or $valor === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => insumoTableClass::VALOR)));
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE), TRUE);            
        }else if(!is_numeric($valor)){
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => insumoTableClass::VALOR)));
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE), TRUE);            
        }
        /*
         * Validacion para ID Insumo
         */
        if($id_tipo_insumo === '' or $id_tipo_insumo === NULL){
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => insumoTableClass::ID_TIPO_INSUMO)));
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::ID_TIPO_INSUMO, TRUE), TRUE);            
        }else if(!is_numeric($id_tipo_insumo)){
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => insumoTableClass::ID_TIPO_INSUMO)));
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::ID_TIPO_INSUMO, TRUE), TRUE);            
        }
        
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('insumo', 'insert');
            
        }
    }
    }

