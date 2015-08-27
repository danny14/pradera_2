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
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
                
              if(isset($filter[credencialTableClass::getNameField(credencialTableClass::NOMBRE,TRUE)]) and $filter[credencialTableClass::getNameField(credencialTableClass::NOMBRE,TRUE)] !== NULL and $filter[credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE)] !== ''){
                    if(request::getInstance()->isMethod('POST')){
                        $nombre = $filter[credencialTableClass::getNameField(credencialTableClass::NOMBRE,TRUE)];
                        $this->ValidateName($nombre);
                        $where[] = '(' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
                                . 'OR ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
                                . 'OR ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
                        //$where[credencialTableClass::NOMBRE] = $nombre;
                    }
                }
                if(isset($filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_1']) and $filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_1'] !== NULL and $filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_1'] !== '' and isset($filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_2']) and $filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_2'] !== NULL and $filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_2'] !== ''){
                    $fecha_ini = $filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT,TRUE).'_1'];
                    $fecha_fin = $filter[credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_2'];
                    $this->ValidateFecha( $fecha_ini, $fecha_fin);
                    $where[credencialTableClass::FECHA_INGRESO] = array(
                        $fecha_ini,
                        $fecha_fin
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion1']. ' 00:00:00')) se puede de dos maneras
//                        date(config::getFormatTimestamp(),  strtotime($filter['fechaCreacion2']. ' 23:59:59'))
                    );
                }
                session::getInstance()->setAttribute('credencialIndexFilters', $where);
            } else if (session::getInstance()->hasAttribute('credencialIndexFilters')) {
                $where = session::getInstance()->getAttribute('credencialIndexFilters');
            }
            $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE,
            credencialTableClass::CREATED_AT,
            credencialTableClass::UPDATED_AT,
            credencialTableClass::DELETED_AT
            );
            $orderBy = array(
            credencialTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = credencialTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objCredencial = credencialTableClass::getAll($fields, false,$orderBy,'ASC',config::getRowGrid(),$page);
            $this->defineView('index', 'credencial',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function validateName($nombre) {
        $flag = FALSE;
        if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $nombre, '%character%' => credencialTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }else if (!ereg("^[a-zA-Z ]{3,80}$", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => credencialTableClass::NOMBRE)),'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('credencial', 'insert');
        }
    }
    
    private function validateDate($fecha_ini,$fecha_fin) {
        $flag = FALSE;
        $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        
        if(!preg_match($pattern, $fecha_ingreso)){
            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default',array('%date%' => animalTableClass::FECHA_INGRESO)),'errorFechaIngreso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);             
        }if(strtotime($fecha_ingreso) >  strtotime($fechaActual)){
          session::getInstance()->setError(i18n::__('ErrorDate', NULL,'default', array('%date%' => $fecha_ingreso)),'errorFechaIngreso');
          $flag = TRUE;
          session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('credencial', 'insert');
        }
    }
}

