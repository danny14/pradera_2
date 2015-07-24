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
             * con el objeto llamado SALIDA BODEGA 
             */
            if(session::getInstance()->hasAttribute('Form_' . salidaBodegaTableClass::getNameTable())){
                $this->salida_bodega = session::getInstance()->getAttribute('Form_' . salidaBodegaTableClass::getNameTable());
                
            }
             
            $fieldsTrabajador = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRE,
            
            );
            $orderByTrabajador = array(
            trabajadorTableClass::NOMBRE
            );
            $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, FALSE, $orderByTrabajador,'ASC');
            $this->defineView('insert', 'salida_bodega',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

