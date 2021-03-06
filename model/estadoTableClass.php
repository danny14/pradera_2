<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class estadoTableClass extends estadoBaseTableClass {
    public static function getTotalPages($lines,$where){
        try{
            $sql = 'SELECT count('.estadoTableClass::ID.') AS cantidad '.
                    ' FROM '.estadoTableClass::getNameTable();
                    ' WHERE'. estadoTableClass::DELETED_AT.' IS NULL ';
            if(is_array($where) == TRUE){
                foreach ($where as $field => $value) {
                    if(is_numeric($field)){
                        $sql = $sql . ' AND ' . $value . ' ';
                    }
                    $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                }
                
            }
            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad/$lines);
        }  catch (PDOException $exc){
            throw $exc;
        }
        
    }
  
}
