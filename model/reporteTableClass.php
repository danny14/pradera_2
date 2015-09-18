<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class reporteTableClass extends reporteBaseTableClass {

    public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . reporteTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . reporteTableClass::getNameTable(). ' ';
//                    ' WHERE'. animalTableClass::DELETED_AT.' IS NULL';
            if (is_array($where) === TRUE) {
                foreach ($where as $field => $value) {
                    if (is_array($value)) {
                        $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                    } else if(is_numeric($field)) {
                        $sql = $sql . ' WHERE ' . $value . ' ';
                    }else{
                        $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                    }
                }
            }


            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / $lines);
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    /**
     * Funcion para la cantidad de leche por animal
     * @param type $id
     * @return type
     * @throws PDOException
     */
    
//    public static function getNameFieldForaneaRaza($id){
//        try{
//            $sql = 'SELECT '. razaTableClass::DESCRIPCION . ' AS nom_raza '
//                   .' FROM '.razaTableClass::getNameTable() . ' '
//                   . ' WHERE ' .razaTableClass::ID . ' = :id';
//            $params = array(
//                ':id' => $id
//            );
//            $answer = model::getInstance()->prepare($sql);
//            $answer->execute($params);
//            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//            return $answer[0]->nom_raza;
//        }
//        catch (PDOException $exc){
//            throw $exc;
//        }
//    }
    /*
     * Funcion para la cantidad de Leche en total de Cada Vaca
     */
    public static function getCantidadLeche($fecha_inicio,$fecha_fin){
        try {
            $sql = 'SELECT SUM('.ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, FALSE).') AS '.ordennoTableClass::CANTIDAD_LECHE.', '
                    . animalTableClass::getNameField(animalTableClass::NOMBRE, FALSE).', '.animalTableClass::getNameField(animalTableClass::ID, FALSE).
                    ' AS '.ordennoTableClass::ID_ANIMAL.' FROM '.ordennoTableClass::getNameTable().', '.animalTableClass::getNameTable().
                    ' WHERE '.ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL,FALSE).'='.animalTableClass::getNameField(animalTableClass::ID,FALSE).' AND '.ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, FALSE).
                    ' BETWEEN :fecha_inicio AND :fecha_fin GROUP BY '.animalTableClass::getNameField(animalTableClass::ID,FALSE).' ORDER BY '.animalTableClass::getNameField(animalTableClass::ID,FALSE).' ASC ';
            $params = array(
                ':fecha_inicio' => $fecha_inicio,
                ':fecha_fin' => $fecha_fin
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    /*
     * Funcion para la cantidad de leche por Raza
     */
    public function getCantidadLecheRaza($fecha_inicio,$fecha_fin){
        try {
            $sql = 'SELECT '.razaTableClass::getNameField(razaTableClass::DESCRIPCION, FALSE).', '.'SUM('.ordennoTableClass::getNameField(ordennoTableClass::CANTIDAD_LECHE, FALSE).') AS '.ordennoTableClass::CANTIDAD_LECHE.''
                    . ' FROM '.ordennoTableClass::getNameTable().', '.animalTableClass::getNameTable().', '.razaTableClass::getNameTable().''
                    . ' WHERE '.ordennoTableClass::getNameField(ordennoTableClass::ID_ANIMAL, FALSE).'='.animalTableClass::getNameField(animalTableClass::ID, FALSE).''
                    . '';
        } catch (PDOException $exc) {
            throw $exc;
        }
        }
}
