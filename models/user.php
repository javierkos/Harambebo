<?php
 // this is a model that retreives data from the database
  Class User {

      public $username;
      public $password;
      public $icon;
      public $homepage;
      public $admin;
      public $loginattempts;
      public $user_id;
      private $dbController;

      public function __construct($username) {
          require_once(__DIR__.'/../controllers/dbController.php');
          $this->dbController = new DBController();
          $mysqli = $this->dbController->connect();
          $this->username = mysqli_real_escape_string($mysqli, $username); //escape post data to protect against sql injections
      }

      private function dbPopulate() { //for getting users
        //populates the current object with all data from the database
        $mysqli=$this->dbController->connect();
        $query = "SELECT user_id,password,loginattempts,icon_url,homepage_url,admin FROM users WHERE username=?;";

        if($stmt = $mysqli->prepare($query) or die($mysqli->error)){
            $stmt->bind_param('s',$this->username);

            /* Execute query */
            $stmt->execute();

            /* Get the result */
            $stmt->bind_result($user_id,$hashpass,$loginattempts,$icon,$homepage,$admin);
            while ($stmt->fetch()) {
              $this->user_id=$user_id;
              $this->password=$hashpass;
              $this->loginattempts=$loginattempts;
              $this->icon=$icon;
              $this->homepage=$homepage;
              $this->admin=$admin;
            }

            error_log($this->password,0);
            $this->dbController->disconnect();
        }
      }

      public function manualPopulate($password,$icon,$homepage) { //for creating users
        $options = [
          'cost' => 11,
          'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];

        $this->password = password_hash($pass, PASSWORD_BCRYPT, $options); //Hash the password with a salt before storing it.
        $this->icon=$icon;
        $this->homepage=$homepage;
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
          $stmt->bind_param('ii',$this->loginattempts,$this->userid);
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
        $this->dbController->disconnect();
      }

      public function authenticateUser($pass) {
          return password_verify($pass, $this->password);
      }
  }
