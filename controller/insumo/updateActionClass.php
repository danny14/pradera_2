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
                $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, TRUE));
                $nombre = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE,TRUE));
                $fecha_fabricacion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION,TRUE));
                $fecha_vencimiento =  request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO,TRUE));
                $valor = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::VALOR,TRUE));
                $id_tipo_insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID_TIPO_INSUMO,TRUE));
                $this->Validate($nombre,$fecha_fabricacion,$fecha_vencimiento,$valor,$id_tipo_insumo);
                
                $ids = array(
                insumoTableClass::ID => $id
                );
                
                $data= array(
                    insumoTableClass::NOMBRE =>$nombre,
                    insumoTableClass::FECHA_FABRICACION =>$fecha_fabricacion,
                    insumoTableClass::FECHA_VENCIMIENTO =>$fecha_vencimiento,
                    insumoTableClass::VALOR => $valor,
                    insumoTableClass::ID_TIPO_INSUMO => $id_tipo_insumo,
                );
                 insumoTableClass::update($ids,$data);
                 bitacora::register('ACTUALIZAR', insumoTableClass::getNameTable());
                 session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
                 routing::getInstance()->redirect('insumo','index'); 
                   
            }
                routing::getInstance()->redirect('insumo','index');    
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
       private function Validate($nombre,$fecha_fabricacion,$fecha_vencimiento,$valor,$id_tipo_insumo) {
        $flag = FALSE ;
         if (strlen($nombre) > insumoTableClass::NOMBRE_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$nombre,'%Character%' =>  insumoTableClass::NOMBRE_LENGTH) ));
     
             $flag = TRUE;
             session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::NOMBRE,TRUE), TRUE);
             
        }
       
//        if (strlen($fecha_fabricacion) > insumoTableClass::FECHA_FABRICACION_LENGTH){ 
//            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$fecha_fabricacion,'%Character%' => insumoTableClass::FECHA_FABRICACION_LENGTH)));
//            $flag = TRUE;
//        session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, TRUE), TRUE);
//        }
//         if (strlen($fecha_vencimiento) > insumoTableClass::FECHA_VENCIMIENTO_LENGTH){ 
//            session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%'=>$fecha_vencimiento,'%Character%' => insumoTableClass::FECHA_VENCIMIENTO_LENGTH)));
//            $flag = TRUE;
//        session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, TRUE), TRUE);
//        }
        if(!is_numeric($valor)){
            session::getInstance()->seterror(i18n::__('errorNumber',null,'default',array('%number%'=>  insumoTableClass::VALOR)));
            $flag = TRUE;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::VALOR, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('insumo', 'insert');
            
        }
    }
}

