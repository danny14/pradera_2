<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class animalTableClass extends animalBaseTableClass {
    public static function getTotalPages($lines){
        try{
            $sql = 'SELECT count('.animalTableClass::ID.') AS cantidad '.
                    ' FROM '.animalTableClass::getNameTable();
//                    ' WHERE'. fecundadorTableClass::DELETED_AT.'IS NULL';
            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad/$lines);
        }  catch (PDOException $exc){
            throw $exc;
        }
        
    }
  
}
