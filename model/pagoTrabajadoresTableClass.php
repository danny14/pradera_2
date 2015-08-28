<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class pagoTrabajadoresTableClass extends pagoTrabajadoresBaseTableClass {
  public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . pagoTrabajadoresTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . pagoTrabajadoresTableClass::getNameTable(). ' ' .
                   ' WHERE'. pagoTrabajadoresTableClass::DELETED_AT.'IS NULL';
            if (is_array($where) === TRUE) {
                foreach ($where as $field => $value) {
                    
                    if (is_array($value)) {   
                            $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                    }else if(is_numeric($field)){
                           $sql = $sql . ' AND ' . $value . ' ';  
                    } else { 
                            $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
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
     * funcion para traer el nombre de una foranea
     * @param type $id integer
     * @return type
     * @throws PDOException
     */
    
    public static function getNameFieldForaneaTrabajador($id){
        try{
            $sql = 'SELECT '. trabajadorTableClass::NOMBRE . ' AS nom_trabajador '
                   .' FROM '.trabajadorTableClass::getNameTable() . ' '
                   . ' WHERE ' .trabajadorTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom_trabajador;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }
    
}
 

