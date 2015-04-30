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
          $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
            /**
             * filtros para el index con paginacion incluida
             */
            $where = NULL;
            if(request::getInstance()->hasPost('filter')){
                $filter = request::getInstance()->getPost('filter');
                // aqui validar datos de filtros
                
        if (is_numeric($filter['edad_animal']) === FALSE AND $filter['edad_animal'] === '' ) {
        session::getInstance()->setError(i18n::__('ErrorCharacterAge_animal', NULL,'default', array('%Age_animal%' => $filter['edad_animal'],'%character%'=>  registroCeloTableClass::EDAD_ANIMAL_LENGTH)));
        $flag = TRUE; 
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::EDAD_ANIMAL, TRUE), TRUE);
        }
        $where[registroCeloTableClass::EDAD_ANIMAL] = $filter['edad_animal'];
      if(preg_match($pattern,$filter['fecha'])=== FALSE){
        session::getInstance()->getError(in18::__('ErrorCharacterDate',NULL,array('%date%'=>$fecha,'%character%'=> registroCeloTableClass::FECHA )));
        $flag = TRUE;
        session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
      }
      $where[registroCeloTableClass::FECHA] = $filter['fecha'];
       
                if(isset($filter['fechaCreacion1']) and $filter['fechaCreacion1'] !== NULL and $filter['fechaCreacion1'] !== '' and isset($filter['fechaCreacion2']) and $filter['fechaCreacion2'] !== NULL and $filter['fechaCreacion2'] !== ''){
       $where[registroCeloTableClass::FECHA] = array(
         $filter['fechaCreacion1'],$filter['fechaCreacion2']  
       );  
       }
                
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
      echo $exc->getMessage() . "<BR>" . print_r($exc->getTraceAsString());
    }
  }

}
