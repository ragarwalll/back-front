<?php
include ( "./inc/header.inc.php");
if($username)
{
  $profile=$_GET['profile'];
  $seen_query=mysqli_query($db, "UPDATE pvt_messages SET opened='yes' WHERE user_to='$username' AND user_from='$profile'");
}
else
{
    die("You must be logged in you view this page");
}
?>

<div class="msg-area" id="msg-area"></div>
<div class="bottom">
  <input type="text" name="msginput" class="msginput" id="msginput" onkeydown="if (event.keyCode == 13) sendmsg()" value="" placeholder="Enter your message here ... (Press enter to send message)">
</div>
<script type="text/javascript">
var msginput=document.getElementById("msginput");
var msgarea=document.getElementById("msg-area");

function update(){
      var xmlhttp= new XMLHttpRequest();
      var username ="<?php echo $username; ?>";
      var profile ="<?php echo $profile; ?>";
      var output= "";
      xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 || xmlhttp.readyState == 200){
          var response= xmlhttp.responseText.split("\n")
          var rl=response.length
          var item="";
          for(var i=0; i<rl ; i++){
            item = response[i].split("\\")
            if(item[1] != undefined){
              if(item[0] == username){
                //Right side
                output += "<div class=\"message_right1\"></div><div class=\"message_right2\"><span>" + item[1] + "</span><h6 style='margin-bottom: 0;'>" + item[2] + "</h6><h6>" + item[3] + "</h6></div><hr />";;
              }
              else {
                output += "<div class=\"message_left1\"><span>" + item[1] + "</span><h6 style='margin-bottom: 0;'>" + item[2] + "</h6></div><div class=\"message_left2\"></div><hr />";
              }
            }
          }
          msgarea.innerHTML = output;
          msgarea.scrollTop = msgarea.scrollHeight;
        }
      }
      xmlhttp.open("GET", "update-messages.php?username=" + username + "&profile=" + profile, true);
      xmlhttp.send();
    }

//sending Message
function sendmsg(){
      var message = msginput.value;
      if(message != ""){
        var username ="<?php echo $username; ?>";
        var profile ="<?php echo $profile; ?>";<?php $datee=date("Y-m-d");?>

        var datee ="<?php echo $datee; ?>";
        var xmlhttp= new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
          if(xmlhttp.readyState == 4 || xmlhttp.readyState == 200){
            msgarea.innerHTML += "<div class=\"message_right1\"></div><div class=\"message_right2\"><span>" + message + "</span><h6>" + datee + "</h6></div><hr />";
            msginput.value = "";
          }
        }
        xmlhttp.open("GET", "insert_messages.php?username=" + username + "&profile=" + profile + "&message=" + message + "&date=" + datee, true);
        xmlhttp.send();

      }
    }
      setInterval(function() {update();},2500)
      </script>
      <?php include ( "./inc/footer.inc.php" );?>
