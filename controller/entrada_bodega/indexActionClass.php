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
            $fields = array(
            entradaBodegaTableClass::ID,
            entradaBodegaTableClass::FECHA,
            entradaBodegaTableClass::HORA,
            entradaBodegaTableClass::ID_TIPO_DOC,
            entradaBodegaTableClass::ID_TRABAJADOR,
            entradaBodegaTableClass::ID_PROVEEDOR
            );
            $this->objEntradaBodega = entradaBodegaTableClass::getAll($fields, false);
            $this->defineView('index', 'entrada_bodega',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

