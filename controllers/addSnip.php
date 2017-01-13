<?php
  session_start();
  require_once(__DIR__.'/../controllers/dbController.php');
  $dbController = new DBController();
  $mysqli=$dbController->connect();

  $title=mysqli_real_escape_string($mysqli, $_POST["title"]);
  $text=mysqli_real_escape_string($mysqli, $_POST["text"]);
  $date = date('Y-m-d H:i:s');
  $query = 'INSERT INTO snippets values(NULL,?,?,?,?)';

  if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')){
      $stmt->bind_param('ssss',$_SESSION['user_id'], $title,$text,$date);

      /* Execute query */
      $stmt->execute();
      $stmt->fetch();
      header('Location: ../home.php');
  }
  header('Location: ../add.php');
?>
