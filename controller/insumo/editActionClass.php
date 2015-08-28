<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
class editActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            if(request::getInstance()->hasGet(insumoTableClass::ID)){
                $fields = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE,
                insumoTableClass::FECHA_FABRICACION,
                insumoTableClass::FECHA_VENCIMIENTO,
                insumoTableClass::VALOR,
                insumoTableClass::ID_TIPO_INSUMO
                );
                $where = array(
                insumoTableClass::ID => request::getInstance()->getGet(insumoTableClass::ID)
                );
                $this->objInsumo = insumoTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                 /*
                 * Este campo es para traer los datos de la foranea TIPO_INSUMO
                 */
                
                $fields = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
                );
                $orderBy = array(
                tipoInsumoTableClass::DESCRIPCION
                );
                
                $this->objTipoInsumo = tipoInsumoTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                $this->defineView('edit', 'insumo', session::getInstance()->getFormatOutput());
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}
