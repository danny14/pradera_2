<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing; 
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


class indexActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
            $where = NULL;
            if(request::getInstance()->hasPost('filter') and request::getInstance()->isMethod('POST')){
                $filter = request::getInstance()->getPost('filter');
                /**
                 * Validacion de los filtros
                 */
                
                $fecha_ini = $filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO,TRUE).'_1'];
                $fecha_fin = $filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE).'_2'];
                
                
                if(isset($filter[animalTableClass::getNameField(animalTableClass::NOMBRE,TRUE)]) and $filter[animalTableClass::getNameField(animalTableClass::NOMBRE,TRUE)] !== NULL and $filter[animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)] !== ''){
                    if(request::getInstance()->isMethod('POST')){
                        $nombre = $filter[animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)];
                        $this->ValidateName($nombre);
                        $where[animalTableClass::NOMBRE] = $nombre;
                    }
                }
                if(isset($filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE).'_1']) and $filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE).'_1'] !== NULL and $filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE).'_1'] !== '' and isset($filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE).'_2']) and $filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE).'_2'] !== NULL and $filter[animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE).'_2'] !== ''){
                    $this->ValidateFecha( $fecha_ini, $fecha_fin);
                    $where[animalTableClass::FECHA_INGRESO] = array(
                        $fecha_ini,
                        $fecha_fin
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
                    );
                }
                session::getInstance()->setAttribute('animalIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('animalIndexFilters')){
            $where = session::getInstance()->getAttribute('animalIndexFilters');
            }
            $fields = array(
            animalTableClass::ID,
            animalTableClass::NOMBRE,
            animalTableClass::GENERO,
            animalTableClass::PESO,
            animalTableClass::FECHA_INGRESO,
            animalTableClass::NUMERO_PARTOS,
            animalTableClass::ID_RAZA,
            animalTableClass::ID_ESTADO
            );
            $orderBy = array(
            animalTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = animalTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objAnimal = animalTableClass::getAll($fields, FALSE ,$orderBy,'ASC', config::getRowGrid(),$page,$where);
            $this->defineView('index', 'animal',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
            
        }
    }
        private function ValidateName($nombre) {
        $flag = FALSE;
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";

        if (strlen($nombre) > animalTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $nombre, '%character%' => animalTableClass::NOMBRE_LENGTH)), 'errorName');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        } else if (!ereg("^[a-zA-Z ]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default', array('%field%' => animalTableClass::NOMBRE)), 'errorName');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        }
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('animal', 'index');
        }
    }

    private function ValidateFecha($fecha_ini, $fecha_fin) {
        $flag = FALSE;
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('animal', 'index');
        }
    }

}


