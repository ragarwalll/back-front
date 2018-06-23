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
<div class="postForm">
  <form action="<?php $username; ?>" method="POST">
    <textarea id="post" name="post" rows="3 " cols="55 ">
    </textarea>
    <input type="submit" name="send" value="Post" style="float: right;background: #dce5ee;color:#000;padding:20px 10px; border-radius: 0; border: 1px solid #666" />
  </form>
</div>
<div class="profilePosts">
  Your Posts
</div>
<img src="" height="250" width="200 "  />
<br />

  <div class="textHeader"><?php echo $firstname?>'s Profile</div>
  <div class="profileLeftSideContent"><?php echo $firstname?>'s Contents</div>
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
