<?php
/**
 *
 */
class Session
{

  public static function exists($nama){
    return (isset($_SESSION[$nama])) ? true : false;
  }

  public static function set($nama, $nilai)
  {
    return $_SESSION[$nama] = $nilai;
  }
  public static function get($nama)
  {
    return $_SESSION[$nama];
  }
}



 ?>
