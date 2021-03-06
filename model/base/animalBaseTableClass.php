<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of bitacoraBaseTableClass
 *
 * @author Danny Steven Ruiz Hernandez <danny_ruiz_1995@hotmail.com>
 */
class animalBaseTableClass extends tableBaseClass {

    private $id;
    private $nombre;
    private $genero;
    private $peso;
    private $fecha_ingreso;
    private $numero_partos;
    private $id_raza;
    private $id_estado;
    private $id_madre;
    private $created_at;
    private $updated_at;
    private $deleted_at;

    const ID = 'id';
    const NOMBRE = 'nombre';
    const NOMBRE_LENGTH = 80;
    const GENERO = 'genero';
    const GENERO_LENGTH = 1;
    const PESO = 'peso';
    const PESO_LENGTH = 3;
    const FECHA_INGRESO = 'fecha_ingreso';
    const NUMERO_PARTOS = 'numero_partos';
    const NUMERO_PARTOS_LENGTH = 2;
    const ID_RAZA = 'id_raza';
    const ID_ESTADO = 'id_estado';
    const ID_MADRE = 'id_madre';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'created_at';
    const DELETED_AT = 'deleted_at';
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getGenero() {
        return $this->genero;
    }

    function getPeso() {
        return $this->peso;
    }

    function getFecha_ingreso() {
        return $this->fecha_ingreso;
    }

    function getId_raza() {
        return $this->id_raza;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function getId_madre() {
        return $this->id_madre;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getUpdate_at() {
        return $this->update_at;
    }

    function getDeleted_at() {
        return $this->deleted_at;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setGenero($genero) {
        $this->genero = $genero;
        return $this;
    }

    function setPeso($peso) {
        $this->peso = $peso;
        return $this;
    }

    function setFecha_ingreso($fecha_ingreso) {
        $this->fecha_ingreso = $fecha_ingreso;
        return $this;
    }

    function setId_raza($id_raza) {
        $this->id_raza = $id_raza;
        return $this;
    }

    function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
        return $this;
    }

    function setId_madre($id_madre) {
        $this->id_madre = $id_madre;
        return $this;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
        return $this;
    }

    function setUpdate_at($update_at) {
        $this->update_at = $update_at;
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
    return 'hoja_de_vida';
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
