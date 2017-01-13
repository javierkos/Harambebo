
<html>
<head>
  <meta charset="UTF-8">
  <title>Harambebo</title>
  <meta name="viewport" content="width=device-width">
  <link href="css/login.css" rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type='text/css' href="css/popup.css">
  <link rel="stylesheet" href="css/style.css">


</head>

<body>
  <?php
    $connectstr_dbhost = '';
    $connectstr_dbname = '';
    $connectstr_dbusername = '';
    $connectstr_dbpassword = '';

    foreach ($_SERVER as $key => $value) {
        if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
            continue;
        }

        $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
        $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
        $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
        $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
    }

    $link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

    mysqli_close($link);
?>
  <header>
		  <h1 class="logo">Harambebo</h1>
	</header>
  <div class="imgcontainer">
    <img src="http://static.boredpanda.com/blog/wp-content/uploads/2016/06/gorilla-shot-boy-zookeper-explains-harambe-amanda-odonoughue-cincinnati-zoo-1.jpg" alt="Avatar" class="avatar">
  </div>
  <form id="login" style="text-align: center;border:none" action="controllers/loginController.php" method="post" >
    <label ><b>Username</b></label>
    <input id="username" type="text" placeholder="Insert Username" name="username" required>

    <label><b>Password</b></label>
    <input id="pass" type="password" placeholder="Insert Password" name="password" required>
    <button type="submit" id="log">Login</button>
    <a href="register.php" style="display:block">No account? Register now!</a>
    <a href="home.php" style="align-self: left">Continue as Guest.</a>
  </form>
  </body>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/home.js"></script>

</body>
</html>
