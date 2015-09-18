<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class trabajadorTableClass extends trabajadorBaseTableClass {
    
        public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . trabajadorTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . trabajadorTableClass::getNameTable(). ' '.
                    ' WHERE '. trabajadorTableClass::DELETED_AT. ' IS NULL ';
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

        public static function getNameFieldForaneaTurno($id){
        try{
            $sql = 'SELECT '. turnoTableClass::DESCRIPCION . ' AS des_turno '
                   .' FROM '.turnoTableClass::getNameTable() . ' '
                   . ' WHERE ' .turnoTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->des_turno;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }
  /**
   * funcion para traer el nombre de una foranea
   * @param type $id integer
   * @return type
   * @throws PDOException
   */

        public static function getNameFieldForaneaCredencial($id){
        try{
            $sql = 'SELECT '. credencialTableClass::NOMBRE . ' AS nom_credencial '
                   .' FROM '.credencialTableClass::getNameTable() . ' '
                   . ' WHERE ' .credencialTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom_credencial;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }
     
   /**
   * funcion para traer el nombre de una foranea
   * @param type $id integer
   * @return type
   * @throws PDOException
   */

        public static function getNameFieldForaneaCiudad($id){
        try{
            $sql = 'SELECT '. ciudadTableClass::DESCRIPCION . ' AS des_ciudad '
                   .' FROM '.ciudadTableClass::getNameTable() . ' '
                   . ' WHERE ' .ciudadTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->des_ciudad;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }
  
}
