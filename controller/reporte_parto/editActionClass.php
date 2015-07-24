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
            if(request::getInstance()->hasRequest(reportePartoTableClass::ID)){
                $fields= array(
                reportePartoTableClass::ID,
                reportePartoTableClass::FECHA_PARTO,
                reportePartoTableClass::N_ANIMALES_VI,
                reportePartoTableClass::N_ANIMALES_M,
                reportePartoTableClass::N_MACHOS,
                reportePartoTableClass::N_HEMBRAS,
                reportePartoTableClass::ID_ANIMAL,
                reportePartoTableClass::OBSERVACIONES,
                
                );
                $where = array(
                    reportePartoTableClass::ID => request::getInstance()->getRequest(reportePartoTableClass::ID)
                );
                $this->objReporteParto = reportePartoTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $fields = array(
                animalTableClass::ID,
                animalTableClass::NOMBRE,
                animalTableClass::GENERO,
                animalTableClass::EDAD,
                animalTableClass::PESO,
                animalTableClass::FECHA_INGRESO,
                animalTableClass::NUMERO_PARTOS,
                animalTableClass::ID_RAZA,
                animalTableClass::ID_ESTADO
                );
//                $where = array(
//                animalTableClass::ID => request::getInstance()->getRequest(reportePartoTableClass::ID_ANIMAL)
//                );
                $this->objAnimal = animalTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, NULL);
                $this->defineView('edit', 'reporte_parto', session::getInstance()->getFormatOutput());
            }else{
                routing::getInstance()->redirect('reporte_parto', 'index');
            }
           
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
