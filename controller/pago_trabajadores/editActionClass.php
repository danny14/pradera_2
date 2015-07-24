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
            if(request::getInstance()->hasRequest(pagoTrabajadoresTableClass::ID)){
                $fields= array(
                pagoTrabajadoresTableClass::ID,
                pagoTrabajadoresTableClass::FECHA_INICIO,
                pagoTrabajadoresTableClass::FECHA_FIN,
                pagoTrabajadoresTableClass::SUBTOTAL,
                pagoTrabajadoresTableClass::VALOR_HORA,
                pagoTrabajadoresTableClass::ID_TRABAJADOR,
                pagoTrabajadoresTableClass::HORAS_EXTRAS,
                pagoTrabajadoresTableClass::CANTIDAD_DIAS,
                
                );
                $where = array(
                    pagoTrabajadoresTableClass::ID => request::getInstance()->getRequest(pagoTrabajadoresTableClass::ID)
                );
                $this->objPagoTrabajadores = pagoTrabajadoresTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $fieldsTrabajador = array(
                trabajadorTableClass::ID,
                trabajadorTableClass::NOMBRE,
                
                );
//                $where = array(
//                animalTableClass::ID => request::getInstance()->getRequest(pagoTrabajadoresTableClass::ID_ANIMAL)
//                );
                $this->objTrabajador = trabajadorTableClass::getAll($fieldsTrabajador, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'pago_trabajadores', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('pago_trabajadores', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
