<?php
include ( "./inc/header.inc.php" );
if($username)
{

}
else
{
    die("You must be logged in you view this page");
}
  ?>
<?php
//New friend_requests
$friendrequests=mysqli_query($db,"SELECT * FROM friend_requests WHERE user_to='$username'");
$num_row = mysqli_num_rows($friendrequests);
if($num_row == 0)
{
  echo "You have no friend request";
  $user_from="";
}
else
{
  while($get_requests=mysqli_fetch_assoc($friendrequests))
  {
    $id=$get_requests['id'];
    $user_from=$get_requests['user_from'];
    $user_to=$get_requests['user_to'];
    $getDetails=mysqli_query($db,"SELECT first_name,last_name FROM users WHERE username='$user_from'");
    while($get_details=mysqli_fetch_assoc($getDetails))
    {
      $fname=$get_details['first_name'];
      $lname=$get_details['last_name'];

    }//echo ''.$fname.' '.$lname.' send a request';
    echo "
    <a href=$user_from >$fname $lname </a><a>send a request</a><br />
    ";

 ?>

<?php
if (isset($_POST['acceptrequest'.$user_from]))
{
  //echo "Friend requested accepted";
  //logged In user
  $get_friend_check=mysqli_query($db,"SELECT friend_array FROM users WHERE username='$username'");
  $get_friend_row=mysqli_fetch_assoc($get_friend_check);
  $friend_array=$get_friend_row['friend_array'];
  $friend_array_explode=explode(",",$friend_array);
  $friend_array_explodecount=count($friend_array_explode);

  //Friend Username
  $get_friend_check_friend=mysqli_query($db,"SELECT friend_array FROM users WHERE username='$user_from'");
  $get_friendrow_friend=mysqli_fetch_assoc($get_friend_check_friend);
  $friend_array_friend=$get_friendrow_friend['friend_array'];
  $friend_array_explode_friend=explode(",",$friend_array_friend);
  $friend_array_explodecount_friend=count($friend_array_explode_friend);

  if($friend_array=="")
  {
    $friend_array_explodecount=NULL;
  }
  if($friend_array_friend=="")
  {
    $friend_array_explodecount_friend=NULL;
  }
  //If no friends
  if($friend_array_explodecount == NULL)
  {
    $new_friend=mysqli_query($db,"UPDATE users SET friend_array=CONCAT(friend_array,'$user_from') WHERE username='$username'");
  }
  if($friend_array_explodecount_friend == NULL)
  {
    $new_friend=mysqli_query($db,"UPDATE users SET friend_array=CONCAT(friend_array,'$user_to') WHERE username='$user_from'");
  }

  if($friend_array_explodecount >= 1)
  {
    $new_friend=mysqli_query($db,"UPDATE users SET friend_array=CONCAT(friend_array,',$user_from') WHERE username='$username'");
  }
  if($friend_array_explodecount_friend >= 1)
  {
    $new_friend=mysqli_query($db,"UPDATE users SET friend_array=CONCAT(friend_array,',$user_to') WHERE username='$user_from'");
  }
  $delete_request=mysqli_query($db, "DELETE FROM friend_requests WHERE user_from='$user_from' AND user_to='$user_to'");
  echo "You are now friends";
  Header("Location: friend_requests.php");
}
if (isset($_POST['ignorerequest'.$user_from]))
{
  $delete_request=mysqli_query($db, "DELETE FROM friend_requests WHERE user_from='$user_from' AND user_to='$user_to'");
  echo "Request deleted";
  Header("Location: friend_requests.php");
}

?>
<form action="friend_requests.php" method="POST">
  <input type="submit" name=acceptrequest<?php echo $user_from; ?> value="Accept" style="">
  <input type="submit" name=ignorerequest<?php echo $user_from; ?> value="Ignore" style="">
</form>

<?php
  }
}
 ?>
 <?php include ( "./inc/footer.inc.php" );?>
