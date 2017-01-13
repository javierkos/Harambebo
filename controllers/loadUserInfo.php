<?php
  require_once(__DIR__.'/../controllers/dbController.php');
  $dbController = new DBController();

  if(!isset($_SESSION['user_id'])){ die('You are not logged in.'); } //this is to prevent unauthorised users trying to add snippets
  if(isset($_GET['user'])){
    $user_id = $_GET['user'];
    $own=false;
  } else {
    $user_id = $_SESSION['user_id'];
    $own=true;
  }

  $mysqli=$dbController->connect();
  $query = 'SELECT username,icon_url,homepage_url FROM users WHERE user_id=?;';
  if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
      $stmt->bind_param('i',$user_id);
      $stmt->bind_result($username,$icon,$homepage);
      echo $stmt->fetch();
      while($stmt->fetch()){
        echo '<img src="'.htmlspecialchars($icon).'">';
        echo '<p class="side-content">';
        echo htmlspecialchars($username);
        echo '<a style="display:block;color:blue;" href="'.htmlspecialchars($homepage).'">Homepage';
        if (strlen($homepage)>30){
          echo '...';
        }
        echo '</a>';
        if ($own){
          echo '<button style="display:inline-block;margin-left:50px;width:100px" id="editb">Edit</button></p> </div>';
        }else{
          echo '</p> </div>';
        }
      }
      $dbController->disconnect();
  }
  ?>
