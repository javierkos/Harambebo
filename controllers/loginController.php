<?php
require_once(__DIR__.'/../models/user.php');
session_start();

if(isset( $_SESSION['user_id'] )){
    header("Location: ../home.php");
}
if(!isset( $_POST['username'], $_POST['password'])){
    die('Please enter a valid username and password');
    header("Location: ../login.php");
}
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4){
    die('Incorrect Length for Username');
    header("Location: ../login.php");
}
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4){
    die('Incorrect Length for Password');
    header("Location: ../login.php");
}
elseif (ctype_alnum($_POST['username']) != true){
    die("Username must be alpha numeric");
    header("Location: ../login.php");
}
elseif (ctype_alnum($_POST['password']) != true){
    die("Password must be alpha numeric");
    header("Location: ../login.php");

}
else
{
    // call the model and create a user object
    $user = new User($_POST['username']);
    $user->dbPopulate(); //populate the user object from database
    $password = $_POST['password'];


    if($user->loginattempts > 3) {
      die("Your account has been locked out, further password requests will not be checked. Email 'helpdesk@harambebo.com' to reset your password.");
    } else {
      if ($user->authenticateUser($_POST['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']=$user->user_id;
        setcookie("token", $user->user_id*1337, time() + (86400 * 30), "/");
        $user->resetLogins();
        header("Location: ../home.php");
      } else {
        error_log('password not verified',0);
        $user->incrementLogins();
        session_unset();
        session_destroy();
        session_regenerate_id(true);
        header("Location: ../login.php");
      }
    }
}

?>
