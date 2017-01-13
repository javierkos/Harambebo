$("#logout").click(function() {
 $.ajax({
  url: "controllers/logout.php",
  success: function(response){
                        window.location.href = "home.php";
                    }
         });
});

$("#login").click(function() {
 
    window.location.href = "login.php";
});

$("#login").click(function() {
 
    window.location.href = "login.php";
});

$('[id^=user]').click(function(){
  $id=this.id.substring(4);
  window.location.href="add.php?user="+$id;
});