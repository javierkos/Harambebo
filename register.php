
<html >
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
    <img src="img/logo.png" alt="Avatar" class="avatar">
  </div>
  <form id="login" style="text-align: center;border:none" action="controllers/registrationController.php" method="post" >
    <label ><b>User*:</b></label>
    <input id="user" type="text" placeholder="Insert Username" name="username" maxlength="20" required>
    <label><b>Password*:</b></label>
    <input id="pass" type="password" placeholder="Insert Password" name="password" maxlength="20" required>
    <label ><b>Icon URL:</b></label>
    <input id="user" type="text" placeholder="Insert URL" name="icon">
    <label ><b>Homepage URL:</b></label>
    <input id="user" type="text" placeholder="Insert URL" name="hp">
    <button type="submit" id="log">Register</button>
  </form>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/home.js"></script>

</body>
</html>
