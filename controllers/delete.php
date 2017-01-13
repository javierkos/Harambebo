<?php
  session_start();
  require_once(__DIR__.'/../controllers/dbController.php');
  $dbController = new DBController();
  $mysqli = $dbController->connect();
  $snip_id=mysqli_real_escape_string($mysqli, $_POST['id']);
  $user_id = $_SESSION['user_id'];

  $query = "DELETE FROM snippets WHERE id=? AND user_id=?;";
  if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')){

      $stmt->bind_param('ss',$snip_id, $user_id);

      /* Execute query */
      $stmt->execute();
      header("Location: ../add.php");

  }
  $dbController->disconnect();
?>
