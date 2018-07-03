<?php
include ( "./inc/header.inc.php");
if($username)
{

}
else
{
    die("You must be logged in you view this page");
}
if (isset($_GET['u']))
{
  $user= mysqli_real_escape_string($db,$_GET['u']);
  if(ctype_alnum($user))
  {
    $check=mysqli_query($db,"SELECT username, first_name FROM users WHERE username='$user'");
    if(mysqli_num_rows($check) == 1)
    {
      $get=mysqli_fetch_assoc($check);
      $user=$get['username'];
      //echo $user;
      
      if($username!=$user)
      {
        if(isset($_POST['submit']))
        {
          $msg_body=strip_tags(@$_POST['msg_body']);
          $date=date("Y-m-d");
          $opened="no";

          if($msg_body=="Enter your message....")
          {
            echo "Please write something";
          }
          else
          {
            if(strlen($msg_body)<2)
            {
              echo "Your message must be minimum of 3 characters";
            }
            else
            {
              $sen_msg_query=mysqli_query($db,"INSERT INTO pvt_messages VALUES ('','$username','$user','$msg_body','$date','$opened')");
              echo "Message send!";
              exit();
            }
          }
        }
        echo "
        <form action='send_msg.php?u=$user' method='POST'>
          <h2>Send a Message:</h2>
          <textarea cols='40' rows='5' name='msg_body'>Enter your message....</textarea><p />
          <input type='submit' class='btn btn--secondary' name='submit' value='Send Message'>
        </form>
        ";
      }
      else
      {
        header("Location:$username");
      }
    }
  }
}
?>
<?php include ( "./inc/footer.inc.php" );?>
