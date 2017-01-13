
<html >
<head>
  <meta charset="UTF-8">
  <title>Harambebo</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700|Poiret+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/button.css">
</head>

<body>
  <header>
		  <h1 class="logo">Harambebo</h1>
	</header>
  <nav>
    <ul>
          <li class="nav-item"><a href="home.php">Home</a></li>
          <?php include 'controllers/showTab.php' ?>
    </ul>
    <div class="menu-bar">
          Menu
          <span class="hamburger-icon"><i class="fa fa-bars"></i></span>
    </div>
  </nav>
  <h2 class="logo" style="margin: 0 auto; font-size: 40px; display:block;">Edit details:</h2>
  <?php include 'controllers/userDetailsController.php' ?>


	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/home.js"></script>

</body>
</html>
