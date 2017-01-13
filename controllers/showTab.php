<?php
  session_start();
  if (isset($_SESSION['user_id'])){
    echo '<li class="nav-item"><a href="add.php">My Snippets</a></li>';
    echo '<li class="nav-item"><a href="editDetails.php">Edit Profile</a></li>';
  }

?>
