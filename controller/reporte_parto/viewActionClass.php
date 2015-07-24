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
          if(request::getInstance()->hasRequest(reportePartoTableClass::ID)){
            $fields = array(
            reportePartoTableClass::ID,
            reportePartoTableClass::FECHA_PARTO,
            reportePartoTableClass::N_ANIMALES_VI,
            reportePartoTableClass::N_ANIMALES_M,
            reportePartoTableClass::N_MACHOS,
            reportePartoTableClass::N_HEMBRAS,
            reportePartoTableClass::OBSERVACIONES,
            reportePartoTableClass::ID_ANIMAL,
            
            );
            $where = array(
            reportePartoTableClass::ID => request::getInstance()->getRequest(reportePartoTableClass::ID)
            );
            
                $this->objReporteParto = reportePartoTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                $this->defineView('view', 'reporte_parto', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('reporte_parto', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo "<br>";
            echo $exc->getTraceAsString();
        }
    }

}
