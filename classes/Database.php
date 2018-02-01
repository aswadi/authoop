<?php

/**
 *
 */
class Database
{
  private static $INSTANCE= null;
  private $mysqli,
          $HOST = '127.0.0.1',
          $USER = 'root',
          $PASS = '',
          $DBNAME = 'authoop';

  public function __construct()
  {
    $this->mysqli = new mysqli( $this->HOST, $this->USER, $this->PASS, $this->DBNAME);
    if (mysqli_connect_error()) {
      die('koneksi gagal');
    }
  }

//getInstance MENGUJI KONEKSI AGAR TIDAK DOUBLE
  public static function getInstance()
  {
    if (!isset(self::$INSTANCE)) {
      self::$INSTANCE = new Database();
    }
    return self::$INSTANCE;
  }

  public function insert($table, $fields = array())
  {
    // mengambil kolom
    $column = implode (", ",array_keys($fields));

    // mengambil values
    $valuesArrays = array();
    $i=0;
    foreach ($fields as $key => $values) {
      if (is_int($values)){
        $valuesArrays[$i] = $this->escape($values);
      }else {
        $valuesArrays[$i] = "'" . $this->escape($values) . "'";
      }
      $i++;
    }

    $values = implode (", ", $valuesArrays);

    $query = "INSERT INTO $table ($column) VALUES ($values)";
    return $this->run_query($query, ' Masalah saat memasukkan data');

  }

  public function escape($name)
  {
    return $this->mysqli->real_escape_string($name);
  }

  public function run_query($query, $msg)
  {
    if ($this->mysqli->query($query)) return true;
    else die($msg);
  }

}



?>
