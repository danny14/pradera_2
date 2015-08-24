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
            if(request::getInstance()->hasGet(detalleEntradaTableClass::ID)){
                
                $idEntradaBodega = request::getInstance()->hasGet(detalleEntradaTableClass::ID_ENTRADA_BODEGA);
                
                $fields= array(
                detalleEntradaTableClass::ID,
                detalleEntradaTableClass::VALOR,
                detalleEntradaTableClass::ID_ENTRADA_BODEGA,
                detalleEntradaTableClass::ID_INSUMO,
                detalleEntradaTableClass::ID_TIPO_INSUMO,
                );
                $where = array(
                    detalleEntradaTableClass::ID => request::getInstance()->getRequest(detalleEntradaTableClass::ID)
                );
                $this->objDetalleEntrada = detalleEntradaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                
                $fields = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
                );
                $this->objInsumo = insumoTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                
                $fields = array(
                    entradaBodegaTableClass::ID,
                );
                $this->objEntradaBodega = entradaBodegaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                
                $fields = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
                );
                $this->idEntradaBodega = $idEntradaBodega;
                $this->objTipoInsumo = tipoInsumoTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'detalle_entrada', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('detalle_entrada', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
