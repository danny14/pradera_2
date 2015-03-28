<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class indexActionClass extends controllerClass implements controllerActionInterface {
  public function execute() {
        try {
            /**
             * filtros para el index con paginacion incluida
             */
            $where = NULL;
            if(request::getInstance()->hasPost('filter')){
                $filter = request::getInstance()->getPost('filter');
                // aqui validar datos de filtros
                if(isset($filter['fecha']) and $filter['fecha'] !== NULL and $filter['fecha'] !== ''){
                    $where[registroCeloTableClass::FECHA] = $filter['fecha'];
                }
//                if(isset($filter['edad_animal']) and $filter['edad_animal'] !== NULL and $filter['edad_animal'] !== ''){
//                    $where[registroCeloTableClass::EDAD_ANIMAL] = $filter['edad_animal'];
//                }
                
                session::getInstance()->setAttribute('registroCeloIndexFilters', $where);
            } else if(session::getInstance()->hasAttribute('registroCeloIndexFilters')){
            $where = session::getInstance()->getAttribute('registroCeloIndexFilters');
            }
            
    

      $fields = array(
          registroCeloTableClass::ID,
          registroCeloTableClass::EDAD_ANIMAL,
          registroCeloTableClass::FECHA,
          registroCeloTableClass::ID_FECUNDADOR,
          registroCeloTableClass::ID_ANIMAL,
      );
      $orderBy = array(
          registroCeloTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * 3;
      }
      $this->cntPages = registroCeloTableClass::getTotalPages(3, $where);
      $this->objRegistroCelo = registroCeloTableClass::getAll($fields, FALSE, $orderBy, 'ASC', 3, $page, $where);
      $this->defineView('index', 'registro_celo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
    session::getInstance()->setFlash('exc', $exc);
    routing::getInstance()->forward('shfsecurity', 'exception');
    }
  }

}
