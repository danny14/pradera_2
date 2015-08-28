<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class insumoTableClass extends insumoBaseTableClass {
    
  public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . insumoTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . insumoTableClass::getNameTable(). ' ';
                    ' WHERE '. insumoTableClass::DELETED_AT.' IS NULL ';
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
}
