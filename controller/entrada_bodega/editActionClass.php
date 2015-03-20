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
            if(request::getInstance()->hasRequest(entradaBodegaTableClass::ID)){
                $fields= array(
                entradaBodegaTableClass::ID,
                entradaBodegaTableClass::FECHA,
                entradaBodegaTableClass::HORA,
                entradaBodegaTableClass::ID_TIPO_DOC,
                entradaBodegaTableClass::ID_TRABAJADOR,
                entradaBodegaTableClass::ID_PROVEEDOR
                );
                $where = array(
                    entradaBodegaTableClass::ID => request::getInstance()->getRequest(entradaBodegaTableClass::ID)
                );
                $this->objentradaBodega = entradaBodegaTableClass::getAll($fields, false , NULL, NULL, NULL , NULL, $where);
                $this->defineView('edit', 'entrada_bodega', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('entrada_bodega', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
