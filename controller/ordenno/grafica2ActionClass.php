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

class grafica2ActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
//            if (request::getInstance()->isMethod('POST')) {
                
                
//                $cantidad_leche = 'Sum("public"'.ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, FALSE).'';
//                $nombre_animal = animalTableClass::getNameField(animalTableClass::NOMBRE, FALSE);
//                $fecha_ordenno = ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, FALSE);
                //$sql1 = 'select '.$cantidad_leche.', '.$nombre_animal.' from ordeno,hoja_de_vida where ordeno.id_animal=hoja_de_vida.id and '.ordennoTableClass::FECHA_ORDENNO
                    //    .' BETWEEN '."'$fecha_inicio'".' AND '."'$fecha_fin'".' GROUP BY '.$nombre_animal.' ORDER BY '.$nombre_animal.' ASC';
                
                //$hola = '"SELECT .$cantidad_leche,"public".hoja_de_vida.nombre FROM "public".hoja_de_vida INNER JOIN "public".ordeno ON "public".ordeno.id_animal = "public".hoja_de_vida."id" GROUP BY "public".hoja_de_vida.nombre ORDER BY "public".hoja_de_vida.nombre ASC "';
//                $sql = 'select SUM(ordeno.cantidad_leche) as cantidad_leche, hoja_de_vida.nombre from ordeno,hoja_de_vida where ordeno.id_animal=hoja_de_vida.id and fecha_ordeno BETWEEN '."'$fecha_inicio'".' AND '."'$fecha_fin'".' GROUP BY hoja_de_vida.nombre ORDER BY hoja_de_vida.nombre ASC';
//                echo $sql;
//                exit();
                $fecha_inicio = '2015-08-01'; //request::getInstance()->getPost('start_date');
                $fecha_fin = '2015-08-30' ;
                $id_animal = 1;//request::getInstance()->getPost('end_date');
                $sql = "SELECT ordeno.cantidad_leche, ordeno.fecha_ordeno FROM ordeno,hoja_de_vida WHERE ordeno.id_animal = hoja_de_vida.id and ordeno.id_animal = ".$id_animal." AND ordeno.fecha_ordeno BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' ORDER BY ordeno.fecha_ordeno ASC";
                $this->fecha_inicio = $fecha_inicio;
                $this->fecha_fin = $fecha_fin;
                $this->arrayDatos = array();
                $this->arrayDatos2 = array();
                $objGrafica2 = model::getInstance()->query($sql)->fetchAll(\PDO::FETCH_OBJ);
                foreach ($objGrafica2 as $valor) {
                    $arrayDatos3[] = array(
                    $this->arrayDatos[] = $valor->fecha_ordeno,
                    $this->arrayDatos2[] = $valor->cantidad_leche
                    );
                }
                $this->arrayDatos3 = $arrayDatos3;
                
                $grafica = array();
                foreach ($objGrafica2 as $dato) {
                    $grafica[] = array($dato->fecha_ordeno, $dato->cantidad_leche);
                }
                $this->grafica = $grafica;


            $this->defineView('grafica2', 'ordenno', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
        }
    }

//    private function Validate($fecha_ordenno, $cantidad_leche, $id_trabajador, $id_animal) {
//        $flag = FALSE;
//        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
//        /*
//         * Validacion para Fecha Ordeño
//         */
//        if ($fecha_ordenno === '' or $fecha_ordenno === NULL) {
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::FECHA_ORDENNO)), 'errorFechaOrdenno');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE), TRUE);
//        } else if (!preg_match($pattern, $fecha_ordenno)) {
//            session::getInstance()->setError(i18n::__('errorDate', NULL, 'default', array('%date%' => ordennoTableClass::FECHA_ORDENNO)), 'errorFechaOrdenno');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE), TRUE);
//        }
//        /*
//         * Validacion para Cantidad Leche
//         */
//        if ($cantidad_leche === '' or $cantidad_leche === NULL) {
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::cantidad_leche)), 'errorCantidadLeche');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::cantidad_leche, TRUE), TRUE);
//        } else if (!is_numeric($cantidad_leche)) {
//            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%number%' => $cantidad_leche)), 'errorCantidadLeche');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, TRUE), TRUE);
//        }
//        /*
//         * Validacion para ID TRABAJADOR
//         */
//        if ($id_trabajador === '' or $id_trabajador === NULL) {
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::id_trabajador)), 'errorTrabajador');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::id_trabajador, TRUE), TRUE);
//        } else if (!is_numeric($id_trabajador)) {
//            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%number%' => $id_trabajador)), 'errorTrabajador');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_TRABAJADOR, TRUE), TRUE);
//        }
//        /*
//         * Validacion para ID ANIMAL
//         */
//        if (!is_numeric($id_animal) === FALSE) {
//            session::getInstance()->seterror(i18n::__('errorNumber', null, 'default', array('%number%' => $id_animal)),'errorAnimal');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, TRUE), TRUE);
//        }
//        if ($id_animal === '' or $id_animal === NULL) {
//            session::getInstance()->setError(i18n::__('errorCharacterEmpty', NULL, 'default', array('%field%' => ordennoTableClass::id_animal)),'errorAnimal');
//            $flag = TRUE;
//            session::getInstance()->setFlash(ordennoTableClass::getNameField(ordennoTableClass::id_animal, TRUE), TRUE);
//        }
//        
//        if($flag === TRUE){
//            request::getInstance()->setMethod('GET'); //POST
//            routing::getInstance()->forward('ordenno', 'insert');
//        }
//    }

}
