<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of FecundadorTableClass
 *
 * @autho Karen Marcela Zambrano Melo
 */
class fecundadorTableClass extends fecundadorBaseTableClass {
    
    /**
     * funcion para el total de paginas con Filtro Sostenido y toca cambiar la sentencia SQL
     * @param type $lines
     * @param type $where
     * @return type
     * @throws PDOException
     */
    
        public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . fecundadorTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . fecundadorTableClass::getNameTable(). ' ';
//                  ' WHERE '. fecundadorTableClass::DELETED_AT.' IS NULL ';
            if (is_array($where) === TRUE) {
                
                foreach ($where as $field => $value) {
                    
                    if (is_array($value)) {
                        $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                    }else if(is_numeric($field)){
                        $sql = $sql . ' WHERE ' . $value . ' ';
                    } else { 
                        $flag = FALSE;
                        if($flag === TRUE){
                        $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                        }else{
                            $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
                            $flag = TRUE;
                        }
                    }
                }
            }
            echo $sql;
            exit();
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
        public static function getNameFieldForaneaRaza($id) {
        try {
            $sql = 'SELECT ' . razaTableClass::DESCRIPCION . ' AS nom_raza '
                    . ' FROM ' . razaTableClass::getNameTable() . ' '
                    . ' WHERE ' . razaTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom_raza;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

}
