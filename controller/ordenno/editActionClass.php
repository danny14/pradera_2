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
            if(request::getInstance()->hasGet(ordennoTableClass::ID)){
                $fields = array(
                ordennoTableClass::ID,
                ordennoTableClass::FECHA_ORDENNO,
                ordennoTableClass::CANTIDAD_LECHE,
                ordennoTableClass::ID_TRABAJADOR,
                ordennoTableClass::ID_ANIMAL               
               
                );
                $where = array(
                ordennoTableClass::ID => request::getInstance()->getGet(ordennoTableClass::ID)
                );
                $this->objOrdenno = ordennoTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                 /*
                 * Este campo es para traer los datos de la foranea TRABAJADOR
                 */
                
                $fields = array(
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
                trabajadorTableClass::APELLIDO
                );
                $orderBy = array(
                trabajadorTableClass::NOMBRE
                );
//                $where = array(
//                trabajadorTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_trabajador)
//                );

                 
               
                $this->objTrabajador = trabajadorTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                 /*
                 * Este campo es para traer los datos de la foranea ANIMAL
                 */
                
                 $fields = array(
                animalTableClass::ID,
                animalTableClass::NOMBRE
               
                );
                $orderBy = array(
                animalTableClass::NOMBRE
                );
 //                $where = array(
//                animalTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_ANIMAL)
//                );
                
                $this->objAnimal = animalTableClass::getAll($fields, FALSE,$orderBy,'ASC',NULL,NULL, NULL);
                
                $this->defineView('edit', 'ordenno', session::getInstance()->getFormatOutput());
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
}
