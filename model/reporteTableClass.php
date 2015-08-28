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
     * Recordar hacer otra funcion general
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
//    
//    public static function getNameFieldForaneaEstado($id){
//        try{
//            $sql = 'SELECT '. estadoTableClass::DESCRIPCION . ' AS nom_estado '
//                   .' FROM '.estadoTableClass::getNameTable() . ' '
//                   . ' WHERE ' .estadoTableClass::ID . ' = :id';
//            $params = array(
//                ':id' => $id
//            );
//            $answer = model::getInstance()->prepare($sql);
//            $answer->execute($params);
//            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//            return $answer[0]->nom_estado;
//        }
//        catch (PDOException $exc){
//            throw $exc;
//        }
//    }

}