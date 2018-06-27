<?php include ( "./inc/header.inc.php" );  ?>
<?php
if (isset($_GET['u']))
{
  $username= mysqli_real_escape_string($db,$_GET['u']);
  if(ctype_alnum($username))
  {
    $check=mysqli_query($db,"SELECT username, first_name FROM users WHERE username='$username'");
    if(mysqli_num_rows($check) == 1)
    {
      $get=mysqli_fetch_assoc($check);
      $username=$get['username'];
      $firstname=$get['first_name'];
    }
    else
    {
      echo "<meta http-equiv=\"refresh\" content=\"0; url=http://127.0.0.1/back-front/index.php\">";
      exit();
    }
  }
}

 ?>
<div class="postForm"><br />
    <textarea id="post" name="post" rows="6" cols="58"></textarea>
    <input type="submit"  name="send" onclick="javascript:send_post()"  value="Post" style="float: right;background: #dce5ee;color:#000;padding:47px 10px; border-radius: 0; border: 1px solid #666 " />
</div>
<div class="profilePosts">
  <?php
    $getposts=mysqli_query($db,"SELECT * FROM posts WHERE user_posted_to='$username' ORDER BY id DESC LIMIT 10") or die(mysqlerror());
    while ($row= mysqli_fetch_assoc($getposts))
    {
      $id=$row['id'];
      $body=$row['body'];
      $date_added=$row['date_added'];
      $added_by=$row['added_by'];
      $user_posted_to=$row['user_posted_to'];
      echo "
      <div class='posted_by'>
        <a href='$added_by'>$added_by</a> - $date_added -
      </div>&nbsp;&nbsp;$body<br /><hr />
      ";
    }
   ?>
</div>
<img src="" height="250" width="200 "  />
<br />

  <div class="textHeader"><?php echo $firstname?>'s Profile</div>
  <div class="profileLeftSideContent">
    <?php
      $about_query=mysqli_query($db, "SELECT bio FROM users WHERE username='$username'");
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
  </div>
