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
            if(request::getInstance()->hasGet(registroCeloTableClass::ID)){
                $fields= array(
                registroCeloTableClass::ID,
                registroCeloTableClass::FECHA,
                registroCeloTableClass::ID_FECUNDADOR,
                registroCeloTableClass::ID_ANIMAL,
                
                );
                $where = array(
                    registroCeloTableClass::ID => request::getInstance()->getGet(registroCeloTableClass::ID)
                );
                $this->objRegistroCelo = registroCeloTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NOMBRE,
                animalTableClass::GENERO,
                animalTableClass::EDAD,
                animalTableClass::PESO,
                animalTableClass::FECHA_INGRESO,
                animalTableClass::NUMERO_PARTOS,
                animalTableClass::ID_RAZA,
                animalTableClass::ID_ESTADO
                );
//                $where = array(
//                animalTableClass::ID => request::getInstance()->getRequest(registroCeloTableClass::ID_ANIMAL)
//                );
                $this->objAnimal = animalTableClass::getAll($fieldsAnimal, FALSE , NULL, NULL, NULL , NULL, NULL);
                
                $fieldsFecundador = array(
                 
                fecundadorTableClass::ID,
                fecundadorTableClass::NOMBRE,
                fecundadorTableClass::EDAD,
                fecundadorTableClass::PESO,
                fecundadorTableClass::ID_RAZA,
                fecundadorTableClass::OBSERVACION,
               
  
                );
//                $where = array(
//                fecundadorTableClass::ID => request::getInstance()->getRequest(registroCeloTableClass::ID_FECUNDADOR)
//                );
                
                $this->objFecundador = fecundadorTableClass::getAll($fieldsFecundador, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'registro_celo', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('registro_celo', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
