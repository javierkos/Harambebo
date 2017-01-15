<?php
  session_start();
  if(isset($_SESSION['user_id']) && $_COOKIE['token'] != $_SESSION['user_id']*420){ 
    echo '<li class="nav-item"><a href="add.php">My Snippets</a></li>';
    }

?>
