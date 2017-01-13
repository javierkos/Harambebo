<?php
  require_once(__DIR__.'/../controllers/dbController.php');
  $dbController = new DBController();
  $mysqli=$dbController->connect();
  $query = "SELECT username,password,icon_url,homepage_url FROM users WHERE user_id=?;";
  if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')){
      $username;$hashpass;$icon;$hp;

      $stmt->bind_param('s',$_SESSION['user_id']);
      $stmt->execute();
      $stmt->bind_result($username,$hashpass,$icon,$hp);

      while ($stmt->fetch()) {
        echo '<form id="login" style="text-align: center;border:none" action="controllers/editController.php" method="post" >
        <label ><b>Username:</b></label>
        <input id="user" type="text" placeholder="Insert Username" name="username" maxlength="20" required value="'.htmlspecialchars($username).'">
        <label><b>New Password:</b></label>
        <input id="pass" type="password" placeholder="Insert Password" name="password" maxlength="20" required>
        <label ><b>Icon URL:</b></label>
        <input id="user" type="text" placeholder="Insert URL" name="icon" value="'.htmlspecialchars($icon).'">
        <label ><b>Homepage URL:</b></label>
        <input id="user" type="text" placeholder="Insert URL" name="hp" value="'.htmlspecialchars($hp).'">
        <button type="submit" id="log">Save Changes</button>
      </form>';
      }
      $stmt->close();
  }
  //$dbController->disconnect();
?>
