<?php
include ( "./inc/connect.inc.php" );
session_start();
if(!isset($_SESSION["user_login"]))
{
  $username="";
}
else
{
  $username= $_SESSION["user_login"];
}

$post=$_POST['post'];
if($post != "")
{
  $date_added=date("Y-m-d");
  $added_by=$username;
  $user_posted_to="test123";

  $sql_command= "INSERT INTO posts VALUES('','$post','$date_added','$added_by','$user_posted_to')";
  $query= mysqli_query($db,$sql_command) or die(mysqlerror());
}
else
{
  echo "Enter something";
}

 ?>
