<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class registroVacunacionTableClass extends registroVacunacionBaseTableClass {
    
     public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . registroVacunacionTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . registroVacunacionTableClass::getNameTable(). ' ' .
                    ' WHERE '. registroVacunacionTableClass::DELETED_AT.' IS NULL ';
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
     * funcion para devolver el nombre de una foranea
     * @param type $id integer
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
    
     /**
     * funcion para devolver el nombre de una foranea
     * @param type $id integer
     * @return type
     * @throws PDOException
     */
    public static function getNameFieldForaneaInsumo($id){
        try{
            $sql = 'SELECT '. insumoTableClass::NOMBRE . ' AS nom_insumo '
                   .' FROM '.insumoTableClass::getNameTable() . ' '
                   . ' WHERE ' .insumoTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom_insumo;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }
  
}
