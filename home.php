
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
              <li class="nav-item"><a href="" >Home</a></li>
              <?php include 'controllers/showTab.php' ?>
      </ul>
          <div class="menu-bar">Menu
          <span class="hamburger-icon"><i class="fa fa-bars"></i></span>
      </div>
    </nav>

    <div class="container">
      <h2 class="logo" style=style="margin: 0 auto;font-size: 40px; display:block;">Users:</h2>
          <div class="section" style="margin-top: 20px;">
                <div class="col span_2_of_3" id="snips">
                <div class="blog-post" style="display:none" id="addform">
                <form >
                  <h2>Add Snippet</h2>
                  <input type="text" style="height:30px;font-size: 15px" name="newtitle" placeholder="Title" required="" autofocus="" id="newtitle" />
                  <textarea placeholder="Message" name="nsnip" cols="40" rows="5" style="display: block; margin-top: 10;" id="nsnip"></textarea>
                  <button type="submit" id="newsnip">Add</button>
                </form>
                </div id="info">
                  <?php include 'controllers/showUsers.php'?>
                  </div>
                  <aside class="col span_1_of_3">
                      <div class="side-post">
                  <?php include 'controllers/checkLog.php'?>
                 </aside>

          </div>
    </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/home1.js"></script>

</body>


</html>
