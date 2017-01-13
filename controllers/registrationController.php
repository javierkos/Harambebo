<?php
require_once(__DIR__.'/../models/user.php');
session_start();

/*** check the username is the correct length ***/
if (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4) {
    die('Incorrect Length for Username');
    header("Location: ../register.php");
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4) {
    die('Incorrect Length for Password');
    header("Location: ../register.php");
}
elseif (ctype_alnum($_POST['username']) != true) {
    die("Username must be alpha numeric");
    header("Location: ../register.php");
}
elseif (ctype_alnum($_POST['password']) != true) {
    die("Password must be alpha numeric");
    header("Location: ../register.php");
}
else {

  $user = new User($_POST['username']);
  $user->manualPopulate($_POST['password'],$_POST['icon'],$_POST['hp']);
  $user->insert();
  $_SESSION['user_id']=$mysqli->insert_id;
  header("Location: ../home.php");

}
?>
