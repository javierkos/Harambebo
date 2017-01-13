
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
