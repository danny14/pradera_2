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
             * con el objeto llamado REGISTRO_CELO 
             */
            if(session::getInstance()->hasAttribute('Form_' . registroCeloTableClass::getNameTable())){
                $this->registro_celo = session::getInstance()->getAttribute('Form_' . registroCeloTableClass::getNameTable());
                
            }
             $fieldsAnimal = array(
            animalTableClass::ID,
            animalTableClass::NOMBRE,
            animalTableClass::GENERO,
            animalTableClass::PESO,
            animalTableClass::FECHA_INGRESO,
            animalTableClass::NUMERO_PARTOS,
            animalTableClass::ID_RAZA,
            animalTableClass::ID_ESTADO,
            );
            $orderByAnimal = array(
            animalTableClass::NOMBRE
            );
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, FALSE , $orderByAnimal,'ASC');
            
            $fieldsFecundador = array(
            fecundadorTableClass::ID,
            fecundadorTableClass::NOMBRE,
            fecundadorTableClass::EDAD,
            fecundadorTableClass::PESO,
            fecundadorTableClass::OBSERVACION,
            fecundadorTableClass::ID_RAZA,
            
            );
            $orderByFecundador = array(
            fecundadorTableClass::NOMBRE
            );
            $this->objFecundador = fecundadorTableClass::getAll($fieldsFecundador, FALSE, $orderByFecundador,'ASC');
            $this->defineView('insert', 'registro_celo',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

