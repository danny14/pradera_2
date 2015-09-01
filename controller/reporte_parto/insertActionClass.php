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
             * con el objeto llamado REPORTE_PARTO 
             */
            if(session::getInstance()->hasAttribute('Form_' . reportePartoTableClass::getNameTable())){
                $this->reporte_parto = session::getInstance()->getAttribute('Form_' . reportePartoTableClass::getNameTable());
                
            }
             $fields = array(
            animalTableClass::ID,
            animalTableClass::NOMBRE,
            animalTableClass::GENERO,
            animalTableClass::PESO,
            animalTableClass::FECHA_INGRESO,
            animalTableClass::NUMERO_PARTOS,
            animalTableClass::ID_RAZA,
            animalTableClass::ID_ESTADO,
            );
            $orderBy = array(
            animalTableClass::NOMBRE
            );
            $this->objAnimal = animalTableClass::getAll($fields, FALSE , $orderBy,'ASC');
            $this->defineView('insert', 'reporte_parto',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

