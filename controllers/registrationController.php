<?php

require_once(__DIR__.'/../controllers/dbController.php');
session_start();
$dbController = new DBController();

/*** check the username is the correct length ***/
if (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
    header("Location: ../register.php");
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
    header("Location: ../register.php");
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
    header("Location: ../register.php");
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['password']) != true)
{
    /*** if there is no match ***/
    $message = "Password must be alpha numeric";
    header("Location: ../register.php");
}
else
{

  $mysqli=$dbController->connect();

  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
  $icon = mysqli_real_escape_string($mysqli, $_POST['icon']);
  $hp = mysqli_real_escape_string($mysqli, $_POST['hp']);

  $options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
  ];

  $hashpass = password_hash($pass, PASSWORD_BCRYPT, $options); //Hash the password with a salt before storing it.

  $query = 'INSERT INTO users VALUES(NULL,?,?,?,?,0,0)';

  if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')){

      $stmt->bind_param('ssss',$username, $hashpass,$icon,$hp);

      /* Execute query */
      $stmt->execute();
      $_SESSION['user_id']=$mysqli->insert_id;
      header("Location: ../home.php");

  }
}
?>
