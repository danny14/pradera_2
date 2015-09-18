<?php
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class detailActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if(request::getInstance()->hasGet(animalTableClass::ID)){
                $id_animal = request::getInstance()->getRequest(animalTableClass::ID);
                $fields= array(
                animalTableClass::ID,
                animalTableClass::NOMBRE,
                animalTableClass::GENERO,
                animalTableClass::PESO,
                animalTableClass::FECHA_INGRESO,
                animalTableClass::NUMERO_PARTOS,
                animalTableClass::ID_RAZA,
                animalTableClass::ID_ESTADO
                );
                $where = array(
                    animalTableClass::ID => request::getInstance()->getRequest(animalTableClass::ID)
                );
                $this->objAnimal = animalTableClass::getAll($fields, FALSE , NULL, NULL, NULL , NULL, $where);
                /*
                 *  Ordeño 
                 */
                $fields = array(
                ordennoTableClass::ID,
                ordennoTableClass::FECHA_ORDENNO,
                ordennoTableClass::ID_ANIMAL,
                ordennoTableClass::ID_TRABAJADOR
                );
                $where = array(
                ordennoTableClass::ID_ANIMAL => $id_animal
                );
                $this->objOrdenno = ordennoTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                /*
                 * Registro Vacunacion
                 */
                $fields = array(
                registroVacunacionTableClass::ID,
                registroVacunacionTableClass::FECHA_REGISTRO,
                registroVacunacionTableClass::ID_TRABAJADOR,
                registroVacunacionTableClass::DOSIS_VACUNA,
                registroVacunacionTableClass::HORA_VACUNA,
                registroVacunacionTableClass::ID_ANIMAL,
                registroVacunacionTableClass::ID_INSUMO,
                );
                $where = array(
                registroVacunacionTableClass::ID_ANIMAL => $id_animal
                );
                $this->objRegistroVacunacion = registroVacunacionTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                /*
                 * Reporte Parto
                 */
                $fields = array(
                reportePartoTableClass::ID,
                reportePartoTableClass::FECHA_PARTO,
                reportePartoTableClass::N_ANIMALES_VI,
                reportePartoTableClass::N_ANIMALES_M,
                reportePartoTableClass::N_MACHOS,
                reportePartoTableClass::N_HEMBRAS,
                reportePartoTableClass::ID_ANIMAL,
                reportePartoTableClass::OBSERVACIONES
                );
                $where = array(
                reportePartoTableClass::ID_ANIMAL => $id_animal
                );
                $this->objReporteParto = reportePartoTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                /*
                 * Registro Vacunacion
                 */
                $fields = array(
                registroCeloTableClass::ID,
                registroCeloTableClass::FECHA,
                registroCeloTableClass::ID_FECUNDADOR,
                registroCeloTableClass::ID_ANIMAL
                );
                $where = array(
                registroCeloTableClass::ID_ANIMAL => $id_animal
                );
                $this->objRegistroCelo = registroCeloTableClass::getAll($fields, FALSE, NULL, NULL, NULL, NULL, $where);
                
                $this->defineView('detail', 'animal', session::getInstance()->getFormatOutput());
            }else{
                session::getInstance()->setError('Error no se pudo visualizar correctamente');
                routing::getInstance()->redirect('animal', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
