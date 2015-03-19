<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->isMethod('POST')){
                $id = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID,true));
                $nombre = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, true));
                $genero = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::GENERO, true));
                $edad = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::EDAD, true));
                $peso = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::PESO, true));
                $fecha_ingreso = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, true));
                $numero_partos = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, true));
                $id_raza = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_RAZA, true));
                $id_estado = request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_ESTADO, true));
                
                $ids= array(
                animalTableClass::ID => $id
                );
                $data = array(
                animalTableClass::NOMBRE => $nombre,
                animalTableClass::GENERO => $genero,
                animalTableClass::EDAD => $edad,
                animalTableClass::PESO => $peso,
                animalTableClass::FECHA_INGRESO => $fecha_ingreso,
                animalTableClass::NUMERO_PARTOS => $numero_partos,
                animalTableClass::ID_RAZA => $id_raza,
                animalTableClass::ID_ESTADO => $id_estado
                );

                animalTableClass::update($ids, $data);
            }
            routing::getInstance()->redirect('animal', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
