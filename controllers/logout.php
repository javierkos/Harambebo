<?php
  session_start();
  if(isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    session_regenerate_id(true);
  }
  header('Location: ../add.php');
?>
