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
            if(request::getInstance()->hasGet(animalTableClass::ID)){
                $fields= array(
                animalTableClass::ID,
                animalTableClass::NOMBRE,
                animalTableClass::GENERO,
                animalTableClass::PESO,
                animalTableClass::FECHA_INGRESO,
                animalTableClass::NUMERO_PARTOS,
                animalTableClass::ID_RAZA,
                animalTableClass::ID_ESTADO
                );
                $where = array(
                    animalTableClass::ID => request::getInstance()->getGet(animalTableClass::ID)
                );
                $this->objAnimal = animalTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                
                /*
                 * Este campo es para traer los datos de la foranea RAZA
                 */
                $fields = array(
                razaTableClass::ID,
                razaTableClass::DESCRIPCION
                );
//                $where = array(
//                razaTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_RAZA)
//                );
                $this->objRaza = razaTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                
                /*
                 * Este campo es para traer los datos de la foranea ESTADO
                 */
                $fields = array(
                estadoTableClass::ID,
                estadoTableClass::DESCRIPCION
                );
//                $where = array(
//                estadoTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID_ESTADO)
//                );
                
                $this->objEstado = estadoTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'animal', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
