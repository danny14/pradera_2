<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class viewActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasRequest(animalTableClass::ID)){
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
                    animalTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID)
                );
                $this->objAnimal = animalTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'animal', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
