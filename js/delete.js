
$('[id^=del]').click(function(){
  $id=this.id.substring(3);
  $.ajax({
   url: 'controllers/delete.php',
   type: 'post',
   data: {id: $id},
   success: function (response) {//response is value returned from php (for your example it's "bye bye"
        window.location.href="add.php";
   }
});

});
