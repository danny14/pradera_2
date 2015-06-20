<?php

use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class credencialTableClass extends credencialBaseTableClass {
    
      public static function getTotalPages($lines,$where){
        try {
            $sql = 'SELECT count(' . credencialTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . credencialTableClass::getNameTable();
//                    ' WHERE'. fecundadorTableClass::DELETED_AT.'IS NULL';
               if(is_array($where) == TRUE){
                foreach ($where as $field => $value) {
                    $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                }
               }
            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / $lines);
        } catch (PDOException $exc){
            throw $exc;
        }
        
    }
  
}
