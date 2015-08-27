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
            $fields = array(
            trabajadorTableClass::ID,
            trabajadorTableClass::NOMBRE
            );
              $fields = array(
            animalTableClass::ID,
            animalTableClass::NOMBRE
            );
                $fields = array(
            insumoTableClass::ID,
            insumoTableClass::NOMBRE
            );
            $orderBy= array(
            trabajadorTableClass::NOMBRE
            );
             $orderBy= array(
             animalTableClass::NOMBRE
            );
             $orderBy= array(
             insumoTableClass::NOMBRE
            );
             
           
            $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            $this->defineView('insert', 'registro_vacunacion', session::getInstance()->getFormatOutput());
            $this->objAnimal = animalTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            $this->defineView('insert', 'registro_vacunacion', session::getInstance()->getFormatOutput());
            $this->objInsumo = insumoTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            $this->defineView('insert', 'registro_vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

