<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;

class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                $nombre = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, true)));
                $genero = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::GENERO, true)));
                $edad = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::EDAD, true)));
                $peso = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::PESO, true)));
                $fecha_ingreso = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, true)));
                $numero_partos = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, true)));
                $id_raza = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_RAZA, true)));
                $id_estado = trim(request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::ID_ESTADO, true)));
                
                $this->Validate($nombre,$genero,$edad,$peso,$fecha_ingreso,$numero_partos,$id_raza,$id_estado);

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

                animalTableClass::insert($data);
                session::getInstance()->setSuccess('Los datos fueron registrados de forma exitosa');
                bitacora::register('Insertar', animalTableClass::getNameTable());
                routing::getInstance()->redirect('animal', 'index');
            } else {
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError($exc->getMessage());
                break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                break;
            }
            routing::getInstance()->redirect('animal', 'insert');
        }
    }
    /**
     * Validaciones para el Animal o Hoja de vida
     */
    private function Validate($nombre, $genero, $edad, $peso, $fecha_ingreso, $numero_partos, $id_raza, $id_estado) {
        $flag = FALSE;
        
        if (strlen($nombre) > animalTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL,'default', array('%name%'=>$nombre,'%character%'=> animalTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
                    
        }

        if (!ereg("^[a-zA-Z0-9]{3,20}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => animalTableClass::NOMBRE)));
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        }

        if($genero !== "F" and $genero !== "f" and $genero !== "M" and $genero !== "m"  ){//or $genero !== "M" or $genero !== "f" or $genero !== "m"){
                    throw new PDOException('Solo puede escoger entre el genero F y M');
        }

        if (!is_numeric($edad)) {
            throw new PDOException('Solo se puede ingresar caracteres numericos');
        }
        if (!is_numeric($peso)) {
            throw new PDOException('Solo se puede ingresar caracteres numericos');
        }

        /* _______________________________ */
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('animal', 'insert');
        }
    }

}
