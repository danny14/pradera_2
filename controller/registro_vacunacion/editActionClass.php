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
            if(request::getInstance()->hasGet(registroVacunacionTableClass::ID)){
                $fields = array(
                registroVacunacionTableClass::ID,
                registroVacunacionTableClass::FECHA_REGISTRO,
                registroVacunacionTableClass::ID_TRABAJADOR,
                registroVacunacionTableClass::DOSIS_VACUNA,
                registroVacunacionTableClass::HORA_VACUNA,
                registroVacunacionTableClass::ID_ANIMAL,
                registroVacunacionTableClass::ID_INSUMO
                );
                $where = array(
                registroVacunacionTableClass::ID => request::getInstance()->getGet(registroVacunacionTableClass::ID)
                );
                $this->objRegistroVacunacion = registroVacunacionTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                
                $fields = array(
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE
                );
                $orderBy = array(
                trabajadorTableClass::NOMBRE
                );
                $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                
                 $fields = array(
                animalTableClass::ID,
                animalTableClass::NOMBRE
                );
                $orderBy = array(
                animalTableClass::NOMBRE
                );
                $this->objAnimal = animalTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                
                $fields = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
                );
                                                 
                $orderBy = array(
                insumoTableClass::NOMBRE
                );
                $this->objInsumo = insumoTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                $this->defineView('edit', 'registro_vacunacion', session::getInstance()->getFormatOutput());
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}
