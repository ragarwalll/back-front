<?php include ( "./inc/header.inc.php" );  ?>
<?php
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
      $firstname=$get['first_name'];
    }
    else
    {
      echo "<meta http-equiv=\"refresh\" content=\"0; url=http://127.0.0.1/back-front/index.php\">";
      exit();
    }
  }
}
//Posting On others wall
$post=@$_POST['post'];
if($post != "")
{
  $date_added=date("Y-m-d");
  $added_by=$username;
  $user_posted_to=$user;

  $sql_command= "INSERT INTO posts VALUES('','$post','$date_added','$added_by','$user_posted_to')";
  $query= mysqli_query($db,$sql_command) or die(mysqlerror());
}
else {

}
 ?>

<div class="postForm"><br />
  <form action="<?php echo $user; ?>" method="POST">
    <textarea id="post" name="post" rows="6" cols="58"></textarea>
    <input type="image" src="./img/post.png"  name="send" width="50" style="float: right; padding-right: 10px; padding-top: 4.5em;" />
  </form>
</div>
<div class="profilePosts">
  <?php
    $getposts=mysqli_query($db,"SELECT * FROM posts WHERE user_posted_to='$user' ORDER BY id DESC LIMIT 10") or die(mysqlerror());
    while ($row= mysqli_fetch_assoc($getposts))
    {
      $id=$row['id'];
      $body=$row['body'];
      $date_added=$row['date_added'];
      $added_by=$row['added_by'];
      $user_posted_to=$row['user_posted_to'];
      $getname=mysqli_query($db,"SELECT first_name, last_name FROM users WHERE username='$added_by' ") or die(mysqlerror());
      while ($get_name= mysqli_fetch_assoc($getname))
      {
        $firstname_post=$get_name['first_name'];
        $lastname_post=$get_name['last_name'];
      }
      echo "
      <div class='posted_by'>
        <a href='$added_by'>$firstname_post $lastname_post</a>
        <div class='datediv'>$date_added<br /></div>
      </div><br />
      &nbsp;&nbsp;<br />$body<br /<br /><hr />
      ";
    }
   ?>

<?php
$get_pic=mysqli_query($db, "SELECT profile_pic FROM users WHERE username='$user'");
$get_rows=mysqli_fetch_assoc($get_pic);
$profilepic=$get_rows['profile_pic'];
if($profilepic=="")
{
  $profilepic="img/default_dp.jpg";
}
else
{
  if(!file_exists("userdata/profile_pics/".$profilepic))
  {
    $profilepic="img/default_dp.jpg";
  }
  else
  {
    $profilepic="userdata/profile_pics/".$profilepic;
  }
}
 ?>
 <?php
//Add as Friend
$error_send="";
if (isset($_POST['addasfriend']))
{
  $friend_request=$_POST['addasfriend'];
  $user_to=$user;
  $user_from=$username;

  if($user_to==$user_from)
  {
    $error_send= "Hi lonely, bt you can't send a request to yourself! <br />";

  }
  else
  {
    $request_query=mysqli_query($db, "INSERT INTO friend_requests VALUES('','$user_from','$user_to')");
    $error_send="Friend request send! <br />";
  }
}


  ?>
</div>
<img src=<?php echo $profilepic; ?> height="200" width="200 "  />
<!--Add as Friend-->
<form action="<?php echo $user; ?>" method="POST">
<?php echo $error_send; ?>
<input type="submit" name="addasfriend" class="btnn btn--secondary " value="Send Request" />
<input type="image" name="sendmsg" src="./img/message.png" value="" width="30" class="icon"/>
</form>
  <div class="textHeader"><?php echo $firstname?>'s Profile</div>
  <div class="profileLeftSideContent">
    <?php
      $about_query=mysqli_query($db, "SELECT bio FROM users WHERE username='$user'");
      $get_result=mysqli_fetch_assoc($about_query);
      $about=$get_result['bio'];
      echo $about;
    ?>
  </div>
  <div class="textHeader"><?php echo $firstname?>'s Friends</div>
  <div class="profileLeftSideContent">
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
    <img src='#' height="50" width="40"/>&nbsp;&nbsp;
  </div>
