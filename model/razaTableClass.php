<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class razaTableClass extends razaBaseTableClass {
  public static function getTotalPages($lines){
        try{
            $sql = 'SELECT count('.razaTableClass::ID.') AS cantidad '.
                    ' FROM '.razaTableClass::getNameTable();
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
