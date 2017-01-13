$('.menu-bar').on('click', function(){
	$('nav ul').toggleClass('reveal');
});


$( ".popup" ).click(function() {
	$("#pop").hide();
  
});

$("#adds").click( function()
       {
         $("#addform").show();
       }
);

$("#editb").click( function()
{
       window.location.href="editDetails.php";
}
);


