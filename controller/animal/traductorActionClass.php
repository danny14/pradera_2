<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class traductorActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') === TRUE) {
                $language = request::getInstance()->getCookie('language');
                $PATH_INFO = request::getInstance()->getServer('PATH_INFO');
                config::setDefaultCulture($language);
                config::getUrlBase() . config::getIndexFile() . $PATH_INFO;
                
                
            } else {
                routing::getInstance()->redirect('animal', 'index');
            }
            /*
             * Limpia Variables en session correspondientes al formulario
             */
            session::getInstance()->setAttribute('form_' . animalTableClass::getNameTable(), NULL);
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

}
