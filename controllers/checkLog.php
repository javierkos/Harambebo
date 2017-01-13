<?php
  session_start();
  if (isset($_SESSION['user_id'])){
    echo 'You are currently logged in';
    echo '<button style="display:inline-block;margin-left:50px;width:100px;margin-top:20px;" id="logout">Log out</button> </div>';

  }else{
    unset($_SESSION['user_id']);
    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);
  	echo 'You are not logged in';
    echo '<button style="display:inline-block;margin-left:50px;width:100px;margin-top:20px;" id="login">Log in</button> </div>';
  }

?>
