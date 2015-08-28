<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Danny Steven Ruiz Hernandez
 */
class registroCeloTableClass extends registroCeloBaseTableClass {

  public static function getTotalPages($lines, $where) {
    try {
      $sql = 'SELECT count(' . registroCeloTableClass::ID . ') AS cantidad ' .
              ' FROM ' . registroCeloTableClass::getNameTable() . ' ';

      if (is_array($where) === TRUE) {
        foreach ($where as $field => $value) {
          $flag = FALSE;
          if (is_array($value)) {
            if ($flag === FALSE) {
              $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
              $flag = true;
            } else {
              $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'") . ' ';
            }
          } else {
            $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? "'$value'" : "'$value'") . ' ';
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
  public static function getNameFieldForaneaAnimal($id) {
    try {
      $sql = 'SELECT ' . animalTableClass::NOMBRE . ' AS nom_animal '
              . ' FROM ' . animalTableClass::getNameTable() . ' '
              . ' WHERE ' . animalTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nom_animal;
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
  public static function getNameFieldForaneaFecundador($id) {
    try {
      $sql = 'SELECT ' . fecundadorTableClass::NOMBRE . ' AS nom_fecundador '
              . ' FROM ' . fecundadorTableClass::getNameTable() . ' '
              . ' WHERE ' . fecundadorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nom_fecundador;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
