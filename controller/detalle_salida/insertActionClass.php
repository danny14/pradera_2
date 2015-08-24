<?php //
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
          /**
             * Si nos llego los datos desde el create 
             * entonces pasamos los datos al insertTemplate
             * con el objeto llamado DETALLE SALIDA
             */
          $idSalidaBodega= request::getInstance()->hasGet(salidaBodegaTableClass::ID);
          
             $fields = array(
            salidaBodegaTableClass::ID,
           
            );
            $orderBy = array(
            salidaBodegaTableClass::ID
            );
            $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            
            $fieldsInsumo = array(
            insumoTableClass::ID,
            insumoTableClass::NOMBRE,
            
            );
            $orderByInsumo = array(
            insumoTableClass::NOMBRE,
            );
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, FALSE , $orderByInsumo,'ASC');
            
             $fieldsTipoInsumo = array(
            tipoInsumoTableClass::ID,
            tipoInsumoTableClass::DESCRIPCION,
            
            );
            $orderByTipoInsumo = array(
            tipoInsumoTableClass::DESCRIPCION,
            );
            $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo, FALSE , $orderByTipoInsumo,'ASC');
            $this->defineView('insert', 'detalle_salida',  session::getInstance()->getFormatOutput());
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

