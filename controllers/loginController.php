<?php
require_once(__DIR__.'/../controllers/dbController.php');
$dbController = new DBController();
session_start();
/*** check if the users is already logged in ***/
if(isset( $_SESSION['user_id'] ))
{
    header("Location: ../home.php");
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['username'], $_POST['password']))
{
    die('Please enter a valid username and password');
    header("Location: ../login.php");
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    die('Incorrect Length for Username');
    header("Location: ../login.php");
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    die('Incorrect Length for Password');
    header("Location: ../login.php");
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    die("Username must be alpha numeric");
    header("Location: ../login.php");
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['password']) != true)
{
    /*** if there is no match ***/
    die("Password must be alpha numeric");
    header("Location: ../login.php");

}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $mysqli=$dbController->connect();

    $username = mysqli_real_escape_string($mysqli, $_POST['username']); //escape post data to protect against sql injections
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    $query = "SELECT user_id,password,loginattempts FROM users WHERE username=?;";

    if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')){
        $stmt->bind_param('s',$username);

        /* Execute query */
        $stmt->execute();

        /* Get the result */
        $stmt->bind_result($userid,$hashpass,$loginattempts);
        while ($stmt->fetch()) {
          $userid=$userid;$hashpass=$hashpass;$loginattempts=$loginattempts;
        }
        if($loginattempts > 3) {
          die("Your account has been locked out, further password requests will not be checked. Email 'helpdesk@harambebo.com' to reset your password.");
        } else {
          if (password_verify($pass, $hashpass)) {
            $stmt->free_result();
            $stmt->close();
            $_SESSION['user_id']=$userid;
            $query= 'UPDATE users SET loginattempts=0 WHERE user_id=?;';
            $mysqli=$dbController->connect();
            if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
              $stmt->bind_param('i',$userid);
              $stmt->execute();
            }
            header("Location: ../home.php");
          } else {
            error_log('password not verified',0);
            $loginattempts+=1;
            $stmt->free_result();
            $stmt->close();
            $query= 'UPDATE users SET loginattempts=? WHERE user_id=?;';
            $mysqli=$dbController->connect();
            if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
              $stmt->bind_param('ii',$loginattempts,$userid);
              $stmt->execute();
            }
            session_unset();
            session_destroy();
            session_regenerate_id(true);
            header("Location: ../login.php");
          }
        }
      }

}

?>
