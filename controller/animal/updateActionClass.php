<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

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
                
                /**
                 * Validaciones para el Animal o Hoja de vida
                 */
                if(!ereg("^[a-zA-Z0-9]{3,20}$", $nombre)){
                    throw new PDOException('el nombre no puede contener caracteres especiales');
                }
                if (strlen($nombre) > animalTableClass::NOMBRE_LENGTH) {
                    throw new PDOException('el nombre no puede ser mayor a ' . animalTableClass::NOMBRE_LENGTH . ' caracteres');
                }
                if($genero !== "F" and $genero !== "f" and $genero !== "M" and $genero !== "m"  ){//or $genero !== "M" or $genero !== "f" or $genero !== "m"){
                    throw new PDOException('Solo puede escoger entre el genero F y M');
                }
                if(!is_numeric($edad)){
                    throw new PDOException('Solo se puede ingresar caracteres numericos');
                }
                if(!is_numeric($peso)){
                    throw new PDOException('Solo se puede ingresar caracteres numericos');
                }
                
                /* _______________________________ */
                
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
                bitacora::register('Actualizar', animalTableClass::getNameTable());
            }
            
            routing::getInstance()->redirect('animal', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
