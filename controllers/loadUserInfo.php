<?php
  require_once(__DIR__.'/../models/user.php');
  if(!isset($_SESSION['user_id']) || $_COOKIE['token'] != $_SESSION['user_id']*420){ die('You are not logged in.'); } //this is to prevent unauthorised users trying to add snippets
  if(isset($_GET['user'])){
    $user_id = $_GET['user'];
    $own=false;
  } else {
    $user_id = $_SESSION['user_id'];
    $own=true;
  }

  $user = new User((int)$user_id);
  $user->dbPopulate();
  echo '<img src="'.htmlspecialchars($user->icon).'">';
  echo '<p class="side-content">';
  echo htmlspecialchars($user->username);
  echo '<a style="display:block;color:blue;" href="'.htmlspecialchars($user->homepage).'">Homepage';
  if (strlen($user->homepage)>30){
    echo '...';
  }
  echo '</a>';
  if ($own){
    echo '<button style="display:inline-block;margin-left:50px;width:100px" id="editb">Edit</button></p> </div>';
  }else{
    echo '</p> </div>';
  }
  ?>
