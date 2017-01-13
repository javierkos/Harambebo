<?php

  require_once(__DIR__.'/../controllers/dbController.php');
  $dbController = new DBController();
  $mysqli=$dbController->connect();
  $query= 'SELECT t.user_id,username, title, text, date
  FROM (select b.user_id,b.id, a.username, b.title, b.text, b.date FROM users a, snippets b WHERE a.user_id = b.user_id) AS t
  WHERE t.id IN (
  SELECT MAX(id)
  FROM (select b.id, a.username, b.title, b.text, b.date from users a, snippets b where a.user_id = b.user_id) AS b
      GROUP BY username
  )';
  if($stmt = $mysqli->prepare($query) or die('Query not satisfactory')){
    $stmt->execute();
    $stmt->bind_result($user_id,$username,$title,$text,$date);

    while ($stmt->fetch()) {
      echo '<div class="blog-post"><h1 class="blog-title">';
      echo htmlspecialchars($title);
      echo '</h1><h2 class="date">';
      echo htmlspecialchars($date);
      echo '</h2><p class="blog-content">';
      echo htmlspecialchars($text);
      echo '</p>';
      echo '<p id="user'.$user_id.'" href="add.php" style="font-size:30px;margin_left:50px;">'.htmlspecialchars($username).'</p>';
      echo '</div>';
    }
  }
  $dbController->disconnect();

?>
