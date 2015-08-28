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
  
                if (isset($filter[razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE)]) and $filter[razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE)] !== NULL and $filter[razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE)] !== '') {
                    $descripcion = $filter[razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE)];
                    $this->validateDescripcion($descripcion);
                    $where[] = '(' . razaTableClass::getNameField(razaTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
                                . 'OR ' . razaTableClass::getNameField(razaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
                                . 'OR ' . razaTableClass::getNameField(razaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '\') ';
                }
                session::getInstance()->setAttribute('razaIndexFilters', $where);
            } else if (session::getInstance()->hasAttribute('razaIndexFilters')) {
                $where = session::getInstance()->getAttribute('razaIndexFilters');
            }
            $fields = array(
            razaTableClass::ID,
            razaTableClass::DESCRIPCION
            );
            $orderBy = array(
            razaTableClass::ID
            );
            $page = 0;
            if(request::getInstance()->hasGet('page')){
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $this->cntPages = razaTableClass::getTotalPages(config::getRowGrid(),$where);
            $this->objRaza = razaTableClass::getAll($fields, false,$orderBy,'ASC',config::getRowGrid(),$page,$where);
            $this->defineView('index', 'raza',  session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
            
        }
    }
    private function validateDescripcion($descripcion){
        $flag = false;
        
        if (strlen($descripcion) > razaTableClass::DESCRIPCION_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $descripcion, '%character%' => razaTableClass::NOMBRE_LENGTH)));
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }elseif (!preg_match('/^[a-zA-Z ]*$/', $descripcion)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default',array('%field%' => razaTableClass::DESCRIPCION)),'errorDescripcion');
            $flag = TRUE;
            session::getInstance()->setFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE), TRUE);
        }
        if($flag === TRUE){
            request::getInstance()->setMethod('GET'); //POST
            session::getInstance()->setFlash('modalFilter', true);
            routing::getInstance()->forward('raza', 'index');
        }
    }
}

