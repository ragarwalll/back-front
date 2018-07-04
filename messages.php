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
$get_friend_messages=mysqli_query($db,"SELECT DISTINCT user_from FROM pvt_messages WHERE user_to='$username' AND opened='no'");
$friend_array_messages=mysqli_num_rows($get_friend_messages);
echo "$friend_array_messages";
?>
