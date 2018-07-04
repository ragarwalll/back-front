$(document).ready(function(){
  var myVar = setInterval(myTimer, 1000);
  function myTimer() {
    //var x = document.getElementById("screen").innerHTML;
    $('#screen').load('messages.php').fadeIn("slow");
    //$('#message_reload').load('messages_left.php').fadeIn("slow");
    //var url = '../messages.php';
    //document.getElementById("screen").innerHTML = url;
  }
});
