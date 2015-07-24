<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class entradaBodegaTableClass extends entradaBodegaBaseTableClass {

    public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . entradaBodegaTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . entradaBodegaTableClass::getNameTable() . ' ';
//                    ' WHERE'. fecundadorTableClass::DELETED_AT.'IS NULL' paginado sin tener en cuenta el borrado logico;
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

    /**
     * Recordar hacer otra funcion general
     * @param type $id
     * @return type
     * @throws PDOException
     */
    
    public static function getNameFieldForaneaTrabajador($id){
        try{
            $sql = 'SELECT '. trabajadorTableClass::NOMBRE . ' AS nom_trabajador '
                   .' FROM '.trabajadorTableClass::getNameTable() . ' '
                   . ' WHERE ' .trabajadorTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom_trabajador;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }
    public static function getNameFieldForaneaProveedor($id){
        try{
            $sql = 'SELECT '. proveedorTableClass::NOMBRE . ' AS nom_proveedor '
                   .' FROM '.proveedorTableClass::getNameTable() . ' '
                   . ' WHERE ' .proveedorTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom_proveedor;
        }
        catch (PDOException $exc){
            throw $exc;
        }
    }

}
