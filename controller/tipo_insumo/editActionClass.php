<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasRequest(tipoInsumoTableClass::ID)){
                $fields= array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
                );
                $where = array(
                    tipoInsumoTableClass::ID => request::getInstance()->getRequest(tipoInsumoTableClass::ID)
                );
                $this->objTipoInsumo = tipoInsumoTableClass::getAll($fields, false , NULL, NULL, NULL , NULL, $where);
                $this->defineView('edit', 'tipo_insumo', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('tipo_insumo', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
