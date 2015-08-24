<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


class viewActionClass extends controllerClass implements controllerActionInterface{
    public function execute() {
        try {
          if(request::getInstance()->hasRequest(registroCeloTableClass::ID)){
            $fields = array(
            registroCeloTableClass::ID,
            registroCeloTableClass::FECHA,
            registroCeloTableClass::ID_FECUNDADOR,
            registroCeloTableClass::ID_ANIMAL,
            );
            $where = array(
            registroCeloTableClass::ID => request::getInstance()->getRequest(registroCeloTableClass::ID)
            );
            
                $this->objRegistroCelo = registroCeloTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'registro_celo', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('registro_celo', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
