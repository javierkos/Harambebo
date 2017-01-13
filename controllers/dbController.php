<?php
class DBController{

  public $link;

  private static $user='';
  private static $password='';
  private static $db='';
  private static $host='';

  public function connect(){

    foreach ($_SERVER as $key => $value) {
        if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
            continue;
        }

        $this::$host = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
        $this::$db = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
        $this::$user = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
        $this::$password = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
    }

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
