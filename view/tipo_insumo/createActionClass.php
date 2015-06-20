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
                $descripcion = request::getInstance()->getPost(tipo_insumoTableClass::getNameField(tipo_insumoTableClass::DESCRIPCION, TRUE));
                $this->Validate($descripcion);
               
                $data = array(
                tipo_insumoTableClass::DESCRIPCION => $descripcion
               
                );
                tipo_insumoTableClass::insert($data);
                bitacora::register('INSERTAR', tipo_insumoTableClass::getNameTable());
                session::getInstance()->setSuccess('los datos fueron registrados de forma exitosa');
                routing::getInstance()->redirect('tipo_insumo','index');
            }else{
                routing::getInstance()->redirect('tipo_insumo', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
         
        }
    }
    private function Validate($descripcion) {
        $flag = FALSE ;
         if (strlen($descripcion) > tipo_insumoTableClass::DESCRIPCION_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$descripcion,'%Character%' =>  tipo_insumoTableClass::DESCRIPCION_LENGTH) ));
     
             $flag = TRUE;
             session::getInstance()->setFlash(tipo_insumoTableClass::getNameField(tipo_insumoTableClass::DESCRIPCION,TRUE), TRUE);
             
        }
        if (!ereg("^[a-zA-Z]{3,20}$", $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => tipo_insumoTableClass::DESCRIPCION)));
            $flag = TRUE;
            session::getInstance()->setFlash(tipo_insumoTableClass::getNameField(tipo_insumoTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if ($descripcion === '' or $descripcion === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => tipo_insumoTableClass::DESCRIPCION)));
            $flag = TRUE;
            session::getInstance()->setFlash(tipo_insumoTableClass::getNameField(tipo_insumoTableClass::DESCRIPCION, TRUE), TRUE);  
     
    
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('tipo_insumo', 'insert');
            
        }
    }
    }

