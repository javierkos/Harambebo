<?php
  require_once(__DIR__.'/../controllers/dbController.php');
  $dbController = new DBController();
  if(!isset($_SESSION['user_id'])){ die('You are not logged in.'); } //this is to prevent unauthorised users trying to add snippets
  $url=$_SERVER['REQUEST_URI'];
  $urlreq=substr($url, -1);
  $icon;$uname;$hp;
  $mysqli=$dbController->connect();
  $query = 'SELECT username,icon_url,homepage_url FROM users WHERE user_id=?;';
  if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')){
      error_log('prepared query');
      if ($urlreq=="p"){
        $stmt->bind_param('s',$_SESSION['user_id']);
        $own=true;
      }else{
        $stmt->bind_param('s',$urlreq);
        $own=false;
      }
      error_log('binded parameters');
      $stmt->bind_result($icon,$uname,$hp);
      while($stmt->fetch()){
        $icon= $result[icon_url];
        $uname=$result[username];
        $hp=$result[homepage_url];
        $small=substr($hp, 0, 30);
        echo '<img src="'.$icon.'">';
        echo '<p class="side-content">';
        echo $uname;
        echo '<a style="display:block;color:blue;" href="'.$hp.'">'.$small.'';
        if (strlen($hp)>30){
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
