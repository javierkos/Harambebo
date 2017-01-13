<?php
class DBController{

  public $link;

  private static $user='administrator';
  private static $password='password';
  private static $db='Harambebo';
  private static $host='localhost';

  public function connect(){
    $this->link = new mysqli($this::$host,
                          $this::$user,
                          $this::$password,
                          $this::$db);
    return $this->link;
  }

  public function disconnect(){
    $this->link->close();
  }

}
?>
