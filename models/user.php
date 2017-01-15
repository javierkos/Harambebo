<?php
 // this is a model that retreives data from the database
  Class User {

      public $username;
      public $password;
      public $icon;
      public $homepage;
      public $admin;
      public $loginattempts=0;
      public $user_id;
      private $dbController;

      public function __construct($param) {
          require_once(__DIR__.'/../controllers/dbController.php');
          $this->dbController = new DBController();
          $mysqli = $this->dbController->connect();
          if(is_string($param)) {
            $this->username = mysqli_real_escape_string($mysqli, $param); //escape post data to protect against sql injections
          } elseif(is_numeric($param)) {
            $this->user_id = mysqli_real_escape_string($mysqli, $param); //escape post data to protect against sql injections
          }
          error_log('new user object constructed '.$param);
      }

      public function dbPopulate() { //for getting users
        //populates the current object with all data from the database, depending on whether username or userid are defined
        $mysqli=$this->dbController->connect();
        if(NULL !== $this->username) { //username defined therefore get from db by username
          $query = "SELECT user_id,password,loginattempts,icon_url,homepage_url,admin FROM users WHERE username=?;";
          if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
              $stmt->bind_param('s',$this->username);
              $stmt->execute();
              $stmt->bind_result($user_id,$hashpass,$loginattempts,$icon,$homepage,$admin);
              while ($stmt->fetch()) {
                $this->user_id=$user_id;
                $this->password=$hashpass;
                $this->loginattempts=$loginattempts;
                $this->icon=$icon;
                $this->homepage=$homepage;
                $this->admin=$admin;
              }
              $this->dbController->disconnect();
          }
        } else { //username not defined, therefore get from db by user_id
          $query = "SELECT username,password,loginattempts,icon_url,homepage_url,admin FROM users WHERE user_id=?;";
          if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
              $stmt->bind_param('s',$this->user_id);
              /* Execute query */
              $stmt->execute();

              /* Get the result */
              $stmt->bind_result($username,$hashpass,$loginattempts,$icon,$homepage,$admin);
              while ($stmt->fetch()) {
                $this->username=$username;
                $this->password=$hashpass;
                $this->loginattempts=$loginattempts;
                $this->icon=$icon;
                $this->homepage=$homepage;
                $this->admin=$admin;
              }
              $this->dbController->disconnect();
          }
        }
        error_log('populating user details '.$this->username.$this->password);
      }

      public function manualPopulate($password,$icon,$homepage) { //for creating users
        $options = [
          'cost' => 11,
          'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];

        $this->password = password_hash($password, PASSWORD_BCRYPT, $options); //Hash the password with a salt before storing it.
        $this->icon=$icon;
        $this->homepage=$homepage;
      }

      public function isAdmin() {
        if((int)$admin==0){ return false; } else { return true; }
      }

      public function resetLogins() {
        //resets the invalid logins for the current user
        $query= 'UPDATE users SET loginattempts=0 WHERE user_id=?;';
        $mysqli=$this->dbController->connect();
        if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
          $stmt->bind_param('i',$this->user_id);
          $stmt->execute();
        }
        $this->dbController->disconnect();
      }

      public function incrementLogins() {
        //increment incorrect logins for this user on the database
        $this->loginattempts+=1;
        $query= 'UPDATE users SET loginattempts=? WHERE user_id=?;';
        $mysqli=$this->dbController->connect();
        if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
          $stmt->bind_param('ii',$this->loginattempts,$this->user_id);
          echo $this->loginattempts;
          $stmt->execute();
        }
        $this->dbController->disconnect();
      }

      public function insert() {
        $query = 'INSERT INTO users VALUES(NULL,?,?,?,?,0,0)';
        $mysqli=$this->dbController->connect();
        if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
            $stmt->bind_param('ssss',$this->username, $this->password,$this->icon,$this->homepage);
            $stmt->execute();
        }
        $this->user_id = $mysqli->insert_id;
        $this->dbController->disconnect();
      }

      public function authenticateUser($pass) {
          return password_verify($pass, $this->password);
      }
  }
