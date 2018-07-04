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
$get_friend_messages=mysqli_query($db,"SELECT count(opened) FROM pvt_messages WHERE opened='no' AND user_to='$username'");
$get_messages_row=mysqli_fetch_assoc($get_friend_messages);
$friend_array_messages=$get_messages_row['count(opened)'];
echo "$friend_array_messages";
?>
