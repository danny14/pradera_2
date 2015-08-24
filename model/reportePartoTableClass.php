<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author 
 */
class reportePartoTableClass extends reportePartoBaseTableClass {
   public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . reportePartoTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . reportePartoTableClass::getNameTable(). ' ';
       //            ' WHERE'. reportePartoTableClass::DELETED_AT.'IS NULL';
            if (is_array($where) === TRUE) {
                foreach ($where as $field => $value) {
                  $flag = FALSE;
                   if (is_array($value)) {
                     if($flag === FALSE){
                       $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                       $flag = true;
                    } else {
                        $sql = $sql . ' AND' . $field . ' = ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]]'") . ' AND '. ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                    }
                }else {
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
    
    public static function getNameFieldForaneaAnimal($id){
        try{
            $sql = 'SELECT '. animalTableClass::NOMBRE . ' AS nom_animal '
                   .' FROM '.animalTableClass::getNameTable() . ' '
                   . ' WHERE ' .animalTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom_animal;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }
    
}
