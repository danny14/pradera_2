<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of bitacoraBaseTableClass
 *
 * @author Danny Steven Ruiz Hernandez <danny_ruiz_1995@hotmail.com>
 */
class registroCeloBaseTableClass extends tableBaseClass {
    
    private $id;
    private $edad_animal;
    private $fecha;
    private $id_fecundador;
    private $id_animal;
    private $created_at;
    private $updated_at;
    private $deleted_at;
    
  const ID = 'id';
  const EDAD_ANIMAL = 'edad_animal';
  const EDAD_ANIMAL_LENGTH = 2;
  const FECHA = 'fecha';
  const ID_FECUNDADOR = 'id_fecundador';
  const ID_ANIMAL = 'id_animal';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  
  public function getId() {
      return $this->id;
  }

  public function getEdad_animal() {
      return $this->edad_animal;
  }

  public function getFecha() {
      return $this->fecha;
  }

  public function getId_fecundador() {
      return $this->id_fecundador;
  }

  public function getId_animal() {
      return $this->id_animal;
  }

  public function setId($id) {
      $this->id = $id;
      return $this;
  }

  public function setEdad_animal($edad_animal) {
      $this->edad_animal = $edad_animal;
      return $this;
  }

  public function setFecha($fecha) {
      $this->fecha = $fecha;
      return $this;
  }

  public function setId_fecundador($id_fecundador) {
      $this->id_fecundador = $id_fecundador;
      return $this;
  }

  public function setId_animal($id_animal) {
      $this->id_animal = $id_animal;
      return $this;
  }
  function getCreated_at() {
      return $this->created_at;
  }

  function getUpdated_at() {
      return $this->updated_at;
  }

  function getDeleted_at() {
      return $this->deleted_at;
  }

  function setCreated_at($created_at) {
      $this->created_at = $created_at;
      return $this;
  }

  function setUpdated_at($updated_at) {
      $this->updated_at = $updated_at;
      return $this;
  }

  function setDeleted_at($deleted_at) {
      $this->deleted_at = $deleted_at;
      return $this;
  }

    

  /**
   * Método para obtener el nombre del campo más la tabla ya sea en formato
   * DB (.) o en formato HTML (_)
   *
   * @param string $field Nombre del campo
   * @param string $html [optional] Por defecto traerá el nombre del campo en
   * versión DB
   * @return string
   */
  public static function getNameField($field, $html = false, $table = null) {
    return parent::getNameField($field, self::getNameTable(), $html);
  }

  /**
   * Obtiene el nombre de la tabla
   * @return string
   */
  public static function getNameTable() {
    return 'registro_celo';
  }

  /**
   * Método para borrar un registro de una tabla X en la base de datos
   *
   * @param array $ids Array con los campos por posiciones
   * asociativas y los valores por valores a tener en cuenta para el borrado.
   * Ejemplo $fieldsAndValues['id'] = 1
   * @param boolean $deletedLogical [optional] Borrado lógico [por defecto] o
   * borrado físico de un registro en una tabla de la base de datos
   * @return PDOException|boolean
   */
  public static function delete($ids, $deletedLogical = true, $table = null) {
    return parent::delete($ids, $deletedLogical, self::getNameTable());
  }

  /**
   * Método para insertar en una tabla usuario
   *
   * @param array $data Array asociativo donde las claves son los nombres de
   * los campos y su valor sería el valor a insertar. Ejemplo:
   * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
   * @return PDOException|boolean
   */
  public static function insert($data, $table = null) {
    return parent::insert(self::getNameTable(), $data);
  }

  /**
   * Método para leer todos los registros de una tabla
   *
   * @param array $fields Array con los nombres de los campos a solicitar
   * @param boolean $deletedLogical [optional] Indicación de borrado lógico
   * o borrado físico
   * @param array $orderBy [optional] Array con el o los nombres de los campos
   * por los cuales se ordenará la consulta
   * @param string $order [optional] Forma de ordenar la consulta
   * (por defecto NULL), pude ser ASC o DESC
   * @param integer $limit [optional] Cantidad de resultados a mostrar
   * @param integer $offset [optional] Página solicitadad sobre la cantidad
   * de datos a mostrar
   * @return mixed una instancia de una clase estandar, la cual tendrá como
   * variables publica los nombres de las columnas de la consulta o una
   * instancia de \PDOException en caso de fracaso.
   */
  public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null) {
    return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
  }

  /**
   * Método para actualizar un registro en una tabla de una base de datos
   *
   * @param array $ids Array asociativo con las posiciones por nombres de los
   * campos y los valores son quienes serían las llaves a buscar.
   * @param array $data Array asociativo con los datos a modificar,
   * las posiciones por nombres de las columnas con los valores por los nuevos
   * datos a escribir
   * @return PDOException|boolean
   */
  public static function update($ids, $data, $table = null) {
    return parent::update($ids, $data, self::getNameTable());
  }

}
