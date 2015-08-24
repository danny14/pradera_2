<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author 
 */
class detalleSalidaTableClass extends detalleSalidaBaseTableClass {
   public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . detalleSalidaTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . detalleSalidaTableClass::getNameTable(). ' ';
                  
            if (is_array($where) === TRUE) {
                foreach ($where as $field => $value) {
                  $flag = FALSE;
                   if (is_array($value)) {
                     if($flag === FALSE){
                       $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                       $flag = true;
                    } else {
                        $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]]'") . ' AND '. ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
                    }
                }else {
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
    public static function getNameFieldForaneaInsumo($id) {
    try {
      $sql = 'SELECT ' . insumoTableClass::NOMBRE . ' AS nombre '
              . ' FROM ' . insumoTableClass::getNameTable() . ' '
              . ' WHERE ' . insumoTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
    public static function getNameFieldForaneaTipoInsumo($id) {
    try {
      $sql = 'SELECT ' . tipoInsumoTableClass::DESCRIPCION . ' AS descripcion '
              . ' FROM ' . tipoInsumoTableClass::getNameTable() . ' '
              . ' WHERE ' . tipoInsumoTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->descripcion;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
//    
//    /**
//     * Recordar hacer otra funcion general
//     * @param type $id
//     * @return type
//     * @throws PDOException
//     */
//    
    public static function getNameFieldForaneaSalidaBodega($id){
        try{
            $sql = 'SELECT '. salidaBodegaTableClass::ID . ' AS id '
                   .' FROM '.salidaBodegaTableClass::getNameTable() . ' '
                   . ' WHERE ' .salidaBodegaTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->id;
        }
        catch (PDOException $exc){
            throw $exc;
        }
  }
    
}
