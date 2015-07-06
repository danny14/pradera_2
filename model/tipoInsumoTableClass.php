<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class tipoInsumoTableClass extends tipoInsumoBaseTableClass {
  
        public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . tipoInsumoTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . tipoInsumoTableClass::getNameTable(). ' ';
//                    ' WHERE'. tipoInsumoTableClass::DELETED_AT.'IS NULL';
            if (is_array($where) === TRUE) {
                foreach ($where as $campo => $dato) {
                    if(is_array($dato)){
                        $sql = $sql . ' WHERE ' . $campo .' = ' . ((is_numeric($dato[0])) ? $dato[0] : "'$dato[0]]'") . ' AND '. $campo .' = ' . ((is_numeric($dato[1])) ? $dato[1] : "'$dato[1]'") . ' AND '. $campo .' = ' . ((is_numeric($dato[2])) ? $dato[2] : "'$dato[2]'") . ' ';
                    }else{
                    }
//                    if (is_array($value)) {
//                        $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
//                    } else {
//                        $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
//                    }
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
