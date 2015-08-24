<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $id = trim(request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID,true)));
                $descripcion = trim(request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESCRIPCION ,true)));
                
                $this->Validate($descripcion);
                
                $ids= array(
                tipoInsumoTableClass::ID => $id
                );
                $data = array(
                tipoInsumoTableClass::DESCRIPCION => $descripcion
                );

                tipoInsumoTableClass::update($ids, $data);
            }
            session::getInstance()->setSuccess('Los datos fueron editados de forma exitosa');
            routing::getInstance()->redirect('tipo_insumo', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }
    private function Validate($descripcion) {
        $flag = FALSE ;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        if ($descripcion === '' or $descripcion === NULL){
           session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => tipoInsumoTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESCRIPCION, TRUE), TRUE);  
        }else if (strlen($descripcion) > tipoInsumoTableClass::DESCRIPCION_LENGTH) {
             session::getInstance()->seterror(i18n::__('errorCharacter',null,'default',array('%name%' =>$descripcion,'%Character%' =>  tipoInsumoTableClass::DESCRIPCION_LENGTH) ),'errorDescripcion');
             $flag = TRUE;
             session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESCRIPCION,TRUE), TRUE);    
        }else if (!ereg("^[a-zA-Z ]{3,140}$", $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => tipoInsumoTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESCRIPCION, TRUE), TRUE);
        }

        if($flag === TRUE){
            request::getInstance()->setMethod('GET');
            request::getInstance()->addParamGet(array(tipoInsumoTableClass::ID => request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID,true))));
            routing::getInstance()->forward('tipo_insumo', 'insert');
            
        }
    }

}
