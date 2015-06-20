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
            trabajadorTableClass::NOMBRE,
            trabajadorTableClass::APELLIDO
            );
            $orderBy= array(
            trabajadorTableClass::NOMBRE
            );
            $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            
              $fields = array(
            animalTableClass::ID,
            animalTableClass::NOMBRE
           
            );
            $orderBy= array(
            animalTableClass::NOMBRE
            );
            $this->objAnimal = animalTableClass::getAll($fields, FALSE, $orderBy, 'ASC');
            
            $this->defineView('insert', 'ordenno', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}

