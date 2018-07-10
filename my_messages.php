<?php include ( "./inc/header.inc.php"); ?>
<!--Unread -->
<?php
$query=mysqli_query($db,"SELECT DISTINCT user_from FROM pvt_messages WHERE user_to='$username' AND opened='no'");
$read_row=mysqli_num_rows($query);
echo "<br /><h2>Unread Messages($read_row)</h2>";
if($read_row>0)
{
  while($query_fetch=mysqli_fetch_assoc($query))
  {
    $get_user_from=$query_fetch['user_from'];
    $get_id_query=mysqli_query($db, "SELECT max(id) FROM pvt_messages WHERE user_to='$username' AND opened='no' AND user_from='$get_user_from'");
    $fetch_id=mysqli_fetch_assoc($get_id_query);
    $id=$fetch_id['max(id)'];
    $get_message_query=mysqli_query($db, "SELECT * FROM pvt_messages WHERE id='$id'");
    $get_count_query=mysqli_query($db, "SELECT * FROM pvt_messages WHERE user_to='$username' AND opened='no' AND user_from='$get_user_from'");
    $read_count_row=mysqli_num_rows($get_count_query);
    while($get_message_row=mysqli_fetch_assoc($get_message_query))
    {
      $id=$get_message_row['id'];
      $user_from=$get_message_row['user_from'];
      $msg_body=$get_message_row['msg_body'];
      $data=$get_message_row['date'];
      $opened=$get_message_row['opened'];
      $getDetails=mysqli_query($db,"SELECT first_name,last_name FROM users WHERE username='$user_from'");
      while($get_details=mysqli_fetch_assoc($getDetails))
      {
        $fname=$get_details['first_name'];
        $lname=$get_details['last_name'];
      if(strlen($msg_body)>100)
      {
        $msg_body=substr($msg_body,0,100)."....";
      }
      else
      {
          $msg_body=$msg_body;
      }
      echo "<a id='name' href='$user_from'>$fname $lname($read_count_row):</a>&nbsp<br>
      <a id='displayText' href='messenger.php?profile=$user_from'>&nbsp$msg_body</a><hr />
      ";
      }
    }
  }
}
else
{
    echo "<p />You have no new messages!";
}
?>
<!--Read-->
<?php
$query=mysqli_query($db,"SELECT DISTINCT user_from FROM pvt_messages WHERE user_to='$username' AND opened='yes'");
$read_row=mysqli_num_rows($query);
echo "<br /><h2>Read Messages($read_row)</h2>";
if($read_row>0)
{
  while($query_fetch=mysqli_fetch_assoc($query))
  {
    $get_user_from=$query_fetch['user_from'];
    $get_id_query=mysqli_query($db, "SELECT max(id) FROM pvt_messages WHERE user_to='$username' AND opened='yes' AND user_from='$get_user_from'");
    $fetch_id=mysqli_fetch_assoc($get_id_query);
    $id=$fetch_id['max(id)'];
    $get_message_query=mysqli_query($db, "SELECT * FROM pvt_messages WHERE id='$id'");
  //$read_row=mysqli_num_rows($get_message_query);

    while($get_message_row=mysqli_fetch_assoc($get_message_query))
    {
      $id=$get_message_row['id'];
      $user_from=$get_message_row['user_from'];
      $msg_body=$get_message_row['msg_body'];
      $data=$get_message_row['date'];
      $opened=$get_message_row['opened'];
      $getDetails=mysqli_query($db,"SELECT first_name,last_name FROM users WHERE username='$user_from'");
      while($get_details=mysqli_fetch_assoc($getDetails))
      {
        $fname=$get_details['first_name'];
        $lname=$get_details['last_name'];
      if(strlen($msg_body)>100)
      {
        $msg_body=substr($msg_body,0,100)."....";
      }
      else
      {
          $msg_body=$msg_body;
      }
      echo "<a id='name' href='$user_from'>$fname $lname:</a>&nbsp<br>
      <a id='displayText' href='messenger.php?profile=$user_from'>&nbsp$msg_body</a><hr />
      ";
      }
    }
  }
}
else
{
      echo "<p />You haven't read any messages yet";
}

?>
<?php include ( "./inc/footer.inc.php" );?>
