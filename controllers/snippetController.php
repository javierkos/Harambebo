<?php

  if(isset($_GET['user'])){
    $display_id = $_GET['user'];
  } else {
    $display_id = null;
  }

  require_once(__DIR__.'/../controllers/dbController.php');
  $dbController = new DBController();
  $mysqli=$dbController->connect();

  $query = 'SELECT id,title,text,date FROM snippets WHERE user_id=?;';
  $admin = 'SELECT admin,user_id FROM users WHERE user_id=?;';
  if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')) {
      if($stnt=$mysqli->prepare($admin) or die('Query not satisfactory')) {
          $stnt->bind_param('s', $_SESSION['user_id']);
          $stnt->execute();
          $stnt->bind_result($admin,$user_id);
          while($stnt->fetch()) {
            $user_id=$user_id;
          }
          if(null!==$display_id) {
              $stmt->bind_param('s',$display_id);
          } else {
              $stmt->bind_param('s',$user_id);
          }
          $stmt->execute();
          $stmt->bind_result($itemid,$title,$text,$date);

          while ($stmt->fetch()) {
            echo '<div class="blog-post"><h1 class="blog-title">';
            echo ($title);
            echo '</h1><h2 class="date">';
            echo ($date);
            echo '</h2><p class="blog-content">';
            echo ($text);
            if($admin=='1' || null==$display_id) {echo '<button id="del',$itemid,'" style="float:right;">Delete</button>';}
            echo '</p></div>';
          }
      }
  }
  $dbController->disconnect();
?>
