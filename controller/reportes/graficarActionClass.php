<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as bitacora;
use mvc\model\modelClass as model;

/*
 * @author: Danny Steven Ruiz Hernandez
 * @date: 10/03/2015
 * @static:
 * @abstract
 * @category:
 */

class graficarActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            function datediffInWeeks($date1, $date2) {
                if ($date1 > $date2) {
                    return datediffInWeeks($date2, $date1);
                }
                $first = DateTime::createFromFormat('d-m-Y', $date1);
                $second = DateTime::createFromFormat('d-m-Y', $date2);
                return ceil($first->diff($second)->days / 7);
            }

            
            $fechaInicio = '01-08-2015';
            $fechaFin = '31-08-2015';
            $semanas = datediffInWeeks($fechaInicio, $fechaFin); // 5
            $arraySemanas = array();
            $cantidadDias = 6;
            for ($x = 0; $x < $semanas; $x++) {
                $dw = date("w", strtotime($fechaInicio));
                $cantidadDiasCompletarSemana = $cantidadDias - $dw;
                $arraySemanas[$x]['inicio'] = $fechaInicio;
                $arraySemanas[$x]['fin'] = date("d-m-Y", strtotime($fechaInicio . '+' . $cantidadDiasCompletarSemana . ' day'));
                if (strtotime($arraySemanas[$x]['fin']) >= strtotime($fechaFin)) {
                    $arraySemanas[$x]['fin'] = $fechaFin;
                }
                $fechaInicio = date("d-m-Y", strtotime($arraySemanas[$x]['fin'] . '+1 day'));
            }

            foreach ($arraySemanas as $semana) {
                $sql = 'SELECT raza.descripcion as raza, SUM(ordeno.cantidad_leche) AS cantidad_leche FROM ordeno, hoja_de_vida, raza WHERE ordeno.id_animal=hoja_de_vida.id AND hoja_de_vida.id_raza=raza.id AND ordeno.fecha_ordeno BETWEEN :finicio AND :ffin GROUP BY raza.descripcion ORDER BY raza, cantidad_leche';
                $params = array(
                    ':finicio' => $semana['inicio'],
                    ':ffin' => $semana['fin']
                );
                var_dump($sql);
                var_dump($params);
                //$datos[] = model::getInstance()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
                $respuesta = model::getInstance()->prepare($sql);
                $respuesta->execute($params);
                $datos[] = $respuesta->fetchAll(\PDO::FETCH_OBJ);
            }
            
            $xSemana = 0;
            $raza = array();
            $razaTick = array();
            foreach ($datos as $semanaSQL) {
                
                foreach ($semanaSQL as $semanaSQLfinal) {
                    $clave = array_search($semanaSQLfinal->raza, $razaTick);
                    if ($clave === false) {
                        $razaTick[] = $semanaSQLfinal->raza;
                        $clave = array_search($semanaSQLfinal->raza, $razaTick);
                    }
                    //$raza[$semanaSQLfinal->raza]['raza'] = $semanaSQLfinal->raza;
                    $raza[$clave][$xSemana][] = $xSemana + 1;
                    $raza[$clave][$xSemana][] = (integer) $semanaSQLfinal->cantidad_leche;
                    $xSemana++;
                }
            }
            $this->raza = $raza;
            $this->razaTick = $razaTick;
            
            var_dump($raza);
            
            // $raza - $razaTick
//            var_dump($razaTick);
//
//            exit();
//
//            foreach ($datos as $value) {
//                $descripcion[] = $value->descripcion;
//                $cantidad_leche[] = (int) $value->cantidad_leche;
//            }
//            $this->datos = array(
//                $descripcion,
//                $cantidad_leche
//            );
//            $this->fecha_inicio = $fecha_inicio;
//            $this->fecha_fin = $fecha_fin;


            $this->defineView('graficar', 'reportes', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                // 42601
                case 23505:
                    session::getInstance()->setError(i18n::__('23505'));
//                    session::getInstance()->setError($exc->getMessage());
                    break;
                case 42601:
                    session::getInstance()->setError(i18n::__('42601'));
                    break;
                case 08006:
                    session::getInstance()->setError(i18n::__('08006'));
                    break;
                case 22007:
                    session::getInstance()->setError(i18n::__('22007'));
                    break;
                default :
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
//            routing::getInstance()->redirect('animal', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

    /**
     * Validaciones para el Animal o Hoja de vida
     */
    private function Validate($nombre, $genero, $peso, $fecha_ingreso, $numero_partos, $id_raza, $id_estado) {
        $flag = FALSE;
        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
        $fechaActual = date('Y-m-d');

        // VALIDACION PARA EL NOMBRE
        if ($nombre === '' or $nombre === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => animalTableClass::NOMBRE)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        } else if (strlen($nombre) > animalTableClass::NOMBRE_LENGTH) {
            session::getInstance()->setError(i18n::__('errorCharacterName', NULL, 'default', array('%name%' => $nombre, '%character%' => animalTableClass::NOMBRE_LENGTH)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        } else if (!preg_match("/^[a-z A-Z]{3,80}$/", $nombre)) {
            session::getInstance()->setError(i18n::__('errorCharacterSpecial', NULL, 'default', array('%field%' => animalTableClass::NOMBRE)), 'errorNombre');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE), TRUE);
        }
        // FIN VALIDACION NOMBRE
        // FIN DE LA VALIDACION DEL GENERO
        if ($genero === '' or $genero === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => animalTableClass::GENERO)), 'errorGenero');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE);
        } else if ($genero !== "F" and $genero !== "M") {// and $genero !== "f"  and $genero !== "m"  ){
            /* se le agrega una llave para el error */
            session::getInstance()->setError(i18n::__('errorGender', NULL, 'default'), 'errorGenero');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::GENERO, TRUE), TRUE);
        }
        /*
         * VALIDACION PARA EDAD
         */
//        if($edad === '' or $edad === NULL){
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default',array('%field%' => animalTableClass::PESO)),'errorEdad');
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);                        
//        }else if (!is_numeric($edad)) {
//            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default',array('%field%' => animalTableClass::EDAD)),'errorEdad');
//            $flag = TRUE;
//            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::EDAD, TRUE), TRUE);
//        }
        //-------------------------------------------

        /*
         * VALIDACION PESO
         */
        if ($peso === '' or $peso === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => animalTableClass::PESO)), 'errorPeso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);
        } else if (!is_numeric($peso)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default', array('%field%' => animalTableClass::PESO)), 'errorPeso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::PESO, TRUE), TRUE);
        }
        /*
         * VALIDACION FECHA INGRESO
         */
        if ($fecha_ingreso === '' or $fecha_ingreso === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => animalTableClass::FECHA_INGRESO)), 'errorFechaIngreso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);
        } else if (!preg_match($pattern, $fecha_ingreso)) {
            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default', array('%date%' => animalTableClass::FECHA_INGRESO)), 'errorFechaIngreso');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::FECHA_INGRESO, TRUE), TRUE);
        }if (strtotime($fecha_ingreso) > strtotime($fechaActual)) {
            session::getInstance()->setError(i18n::__('ErrorDate', NULL, 'default', array('%date%' => $fecha_ingreso)), 'errorFechaIngreso');
            $flag = TRUE;
            session::getInstance()->setFlash(registroCeloTableClass::getNameField(registroCeloTableClass::FECHA, TRUE), TRUE);
        }

        /*
         * VALIDACION NUMERO DE PARTOS
         */
        if ($numero_partos === '' or $numero_partos === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => animalTableClass::NUMERO_PARTOS)), 'errorNumeroPartos');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);
        } else if (!is_numeric($numero_partos)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default', array('%field%' => animalTableClass::NUMERO_PARTOS)), 'errorNumeroPartos');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::NUMERO_PARTOS, TRUE), TRUE);
        }

        /*
         * VALIDACIONES DE ID RAZA
         */
        if ($id_raza === '' or $id_raza === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => animalTableClass::ID_RAZA)), 'errorRaza');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE), TRUE);
        }
        if (!is_numeric($id_raza)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default', array('%field%' => animalTableClass::ID_RAZA)), 'errorRaza');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_RAZA, TRUE), TRUE);
        }
        // ---------------------------------------
        /*
         * VALIDACIONES DE ID ESTADO
         */
        if ($id_estado === '' or $id_estado === NULL) {
            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => animalTableClass::ID_ESTADO)), 'errorEstado');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE), TRUE);
        } else if (!is_numeric($id_estado)) {
            session::getInstance()->setError(i18n::__('errorNumber', NULL, 'default', array('%field%' => animalTableClass::ID_ESTADO)), 'errorEstado');
            $flag = TRUE;
            session::getInstance()->setFlash(animalTableClass::getNameField(animalTableClass::ID_ESTADO, TRUE), TRUE);
        }
        //------------------------------------------
        /* _______________________________ */
        if ($flag === TRUE) {
            request::getInstance()->setMethod('GET'); //POST
            routing::getInstance()->forward('animal', 'insert');
        }
    }

}
