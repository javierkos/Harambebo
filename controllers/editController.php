<?php
session_start();
require_once(__DIR__.'/../controllers/dbController.php');
$dbController = new DBController();

if (!isset($_POST['username']) || !isset($_POST['password'])){
    die("Username must be alpha numeric");
    header("Location: ../editDetails.php");
}
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4){
    die('Incorrect Length for Username');
    header("Location: ../editDetails.php");
}
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4){
    die('Incorrect Length for Password');
    header("Location: ../editDetails.php");
}
elseif (ctype_alnum($_POST['username']) != true){
    die('Username must be alpha numeric');
    header("Location: ../editDetails.php");
}
else
{
      $mysqli=$dbController->connect();
      if(isset($_POST['icon']))){ $icon_url = mysqli_real_escape_string($mysqli, $_POST['icon']); } else { $icon_url = NULL }
      if(isset($_POST['hp'])){ $homepage_url = mysqli_real_escape_string($mysqli, $_POST['hp']); } else { $homepage_url = NULL }

      $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);

      $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
      ];

      $hashpass = password_hash($pass, PASSWORD_BCRYPT, $options); //Hash the new password with a salt before storing it.

      $query= 'UPDATE users SET username=?, password=?, icon_url=?, homepage_url=? WHERE user_id=?;';
      if($stmt = $mysqli->prepare($query)){
          $stmt->bind_param('ssssi',$username, $hashpass,$icon_url,$homepage_url,$user_id);
          /* Execute query */
          $stmt->execute();
      }
      header("Location: ../add.php");
}
?>
