<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class insertActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            
            $idEntradaBodega = request::getInstance()->hasGet(entradaBodegaTableClass::ID);
            $fields = array(
            insumoTableClass::ID,
            insumoTableClass::NOMBRE,
            
            );
            $orderBy = array(
            insumoTableClass::NOMBRE
            );
            $this->objInsumo = insumoTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            
            $fields = array(
            entradaBodegaTableClass::ID,
            );
            $orderBy = array(
            entradaBodegaTableClass::ID
            );
            $this->objEntradaBodega = insumoTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            
            $fields = array(
            tipoInsumoBaseTableClass::ID,
            tipoInsumoTableClass::DESCRIPCION,
            
            );
            $orderBy = array(
            tipoInsumoTableClass::DESCRIPCION
            );
            $this->idEntradaBodega = $idEntradaBodega;
            $this->objTipoInsumo = tipoInsumoTableClass::getAll($fields, FALSE, $orderBy,'ASC');
            $this->defineView('insert', 'detalle_entrada',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
}

