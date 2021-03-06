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
            /**
             * filtros para el index con paginacion incluida
             */
            $where = NULL;
            if(request::getInstance()->hasPost('filter')){
                $filter = request::getInstance()->getPost('filter');
                
                if(isset($filter[fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)]) and $filter[fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)] !== NULL and $filter[fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)] !== ''){
                    $nombre = $filter[fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE)];
                    $this->validateName($nombre);
                    $where[] = '(' . fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
                                . 'OR ' . fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
                                . 'OR ' . fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
                }
                if(isset($filter[fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)]) and $filter[fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)] !== NULL and $filter[fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)] !== ''){
                    $edad = $filter[fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE)];
                    $this->validateAge($edad);
                    $where[fecundadorTableClass::EDAD] = $edad ;
                }
                if(isset($filter[fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)]) and $filter[fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)] !== NULL and $filter[fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)] !== ''){
                    $peso = $filter[fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE)];
                    $this->validateWeight($peso);
                    $where[fecundadorTableClass::PESO] = $peso;
                }
                session::getInstance()->setAttribute('fecundadorIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('fecundadorIndexFilters')){
            $where = session::getInstance()->getAttribute('fecundadorIndexFilters');
            }
            
            $fields= array(
            fecundadorTableClass::ID,
            fecundadorTableClass::NOMBRE,
            fecundadorTableClass::EDAD,
            fecundadorTableClass::PESO,
            fecundadorTableClass::OBSERVACION,
            fecundadorTableClass::ID_RAZA
            );
            $orderBy = array(
            fecundadorTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * 3;
            }
            $this->cntPages = fecundadorTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objFecundador =  fecundadorTableClass::getAll($fields, FALSE,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'fecundador', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                //22P02  Invalid text representation: 7 ERROR: la sintaxis de entrada no es válida para integer: «Seleccione la raza» LINE 1: ... "id_raza") VALUES ('dasdas', 23, 32, 'PErfecto', 'Seleccion... ^
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
//                    session::getInstance()->setError($exc->getMessage());
                break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    break;
                case "22P02":
                    session::getInstance()->setError($exc);
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                break;
            }

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception'); 
        }
    }
    private function validateName($nombre) {
        $flag = FALSE;
        if (strlen($nombre) > fecundadorTableClass::NOMBRE_LENGTH) {
            session::getInstance()->seterror(i18n::__('errorCharacter', null, 'default', array('%name%' => $nombre, '%Character%' => fecundadorTableClass::NOMBRE_LENGTH)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE), TRUE);
        } else if (!preg_match("/^[a-zA-Z]{3,20}$/", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default', array('%field%' => fecundadorTableClass::NOMBRE)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::NOMBRE, TRUE), TRUE);
        }
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('animal', 'index');
        }
    }

    private function validateAge($edad) {
        $flag = FALSE;
        if (is_numeric($edad) === FALSE) {
            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%number%' => $edad)), 'errorEdad');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::EDAD, TRUE), TRUE);
        }
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('animal', 'index');
        }
    }

    private function validateWeight($peso) {
        $flag = FALSE;
        if (is_numeric($peso) === FALSE) {
            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%number%' => $peso)), 'errorPeso');
            $flag = TRUE;
            session::getInstance()->setFlash(fecundadorTableClass::getNameField(fecundadorTableClass::PESO, TRUE), TRUE);
        }
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('fecundador', 'index');
        }
    }

}

