<?php
Class Snippets {
  // public $id;
  // public $user_id;
  // public $title;
  // public $text;
  // public $date;
  private $dbController;
  public $snippets=array();

  public function __construct(){
    require_once(__DIR__.'/../controllers/dbController.php');
    $this->dbController = new DBController();
  }

  public function getSnippetsForUser($user_id) {
    $mysqli = $this->dbController->connect();
    $query = 'SELECT id,title,text,date FROM snippets WHERE user_id=?;';
    if($stmt = $mysqli->prepare($query) or die($mysqli->error)) {
      $stmt->bind_param('s',$display_id);
      $stmt->execute();
      $stmt->bind_result($itemid,$title,$text,$date);
      while($stmt->fetch()) {
        //append to snippets property
        $snippets += {"id" => $itemid, "title" => $title, "text" => $text, "date" => $date};
      }
    }
    $this->dbController->disconnect();
}
?>
