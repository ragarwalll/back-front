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
      //echo $user
      echo "
      <h2>Chat:</h2><hr />
      ";
      if($username!=$user)
      {
        $query=mysqli_query($db,"UPDATE pvt_messages SET opened='yes' WHERE user_from='$user' AND user_to='$username'");
        //setting opened
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
            }
          }
        }
        $get_messages_query=mysqli_query($db,"SELECT * FROM pvt_messages WHERE user_from='$user' AND user_to='$username' OR user_from='$username' AND user_to='$user' ");
        while($get_messages_row=mysqli_fetch_assoc($get_messages_query))
        {
          $get_messages=$get_messages_row['msg_body'];
          $get_messages_id=$get_messages_row['id'];
          $get_messages_date=$get_messages_row['date'];
          $get_messages_user_from=$get_messages_row['user_from'];
          $get_messages_user_to=$get_messages_row['user_to'];
          //echo "$get_messages, $get_messages_id, $get_messages_date, $get_messages_user_to,$get_messages_user_from <br />";
          if($get_messages_user_from==$username && $get_messages_user_to==$user)
          {
            echo "
            <div class='message_right'>
              $get_messages<h6>$get_messages_date</h6>
            </div>
            ";
            echo "<hr />";
          }
          else//if($get_messages_user_from==$user && $get_messages_user_to==$username)
          {
            echo "
            <div class='message_left'>
              $get_messages<h6>$get_messages_date</h6>
            </div>
            ";
            echo "<hr />";

          }
        }
        echo "
        <div id='bottom'><br><br><br></div>
        <div class='chat_it'>
          <form action='chat.php?u=$user' method='POST'>
            <textarea cols='90' rows='2' name='msg_body'>Enter your message....</textarea>
            <input id='send_message' type='submit' class='btn btn--secondary' name='submit' value='Send Message'>
          </form>
        <div>
        ";
      }
      else
      {
        header("Location:$username");
      }

    }
    else
    {
      echo "<meta http-equiv=\"refresh\" content=\"0; url=http://127.0.0.1/back-front/index.php\">";
      exit();
    }
  }
}
?>

<script src="js/bottom_scroll.js" language="javascript" type="text/javascript"></script>
<?php include ( "./inc/footer.inc.php" );?>