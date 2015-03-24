<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
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
//                    ' WHERE'. fecundadorTableClass::DELETED_AT.'IS NULL';
            if (is_array($where) === TRUE) {
                foreach ($where as $field => $value) {
                    if (is_array($value)) {
                        $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                    } else {
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
  
}
