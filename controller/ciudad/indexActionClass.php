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
                
                if (isset($filter[ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE)]) and $filter[ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE)] !== NULL and $filter[ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE)] !== '') {
                    $descripcion = $filter[ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION,TRUE)];
                    //$this->validateDescription($descripcion);
                    $where[] = '(' . ciudadTableClass::getNameField(ciudadBaseTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
                                . 'OR ' . ciudadBaseTableClass::getNameField(ciudadBaseTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
                                . 'OR ' . ciudadBaseTableClass::getNameField(ciudadBaseTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '\') ';
                    
                }
                session::getInstance()->setAttribute('ciudadIndexFilters', $where);
            } else if (session::getInstance()->hasAttribute('ciudadIndexFilters')) {
                $where = session::getInstance()->getAttribute('ciudadIndexFilters');
            }
            $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::DESCRIPCION
            );
            $orderBy = array(
            ciudadTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = ciudadTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objCiudad = ciudadTableClass::getAll($fields, false,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'ciudad',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function validateDescription($descripcion){
        
        $flag = FALSE;
        
        if (strlen($descripcion) > ciudadTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => ciudadTableClass::NOMBRE_LENGTH)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE), TRUE);
        }else if (!ereg("^[a-zA-Z ]{3,80}$", $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => ciudadTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('ciudad', 'index');
        }
    }
}

