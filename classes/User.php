<?php
/**
 *
 */
class User
{
  private $_db;
  function __construct()
  {
    $this->_db=Database::getInstance();
  }

  public function register_user($fields = array())
  {
    if ($this->_db->insert('users', $fields)) return true;
      else return false;
  }
}



 ?>
