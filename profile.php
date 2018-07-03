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
    <textarea id="post" name= "post" rows="6" cols="58"></textarea>
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
 //Messaging
 if(isset($_POST['sendmsg']))
 {
   header("Location: chat.php?u=$user");
 }
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
<?php

$friendarray="";
$countfriend="";
$friendarray12="";
$friend_query=mysqli_query($db, "SELECT friend_array FROM users WHERE username='$user'" );
$friendrow=mysqli_fetch_assoc($friend_query);
$friendarray=$friendrow['friend_array'];
if($friendarray!="")
{
  $friendarray=explode(",",$friendarray);
  $countfriend=count($friendarray);
  $friendarray12= array_slice($friendarray,0,12);

$i=0;
if($username!=$user)
{
  if(in_array($username,$friendarray))
  {
    $addasfriend='<input type="submit" name="removefriend" class="btnn btn--secondary " value="Remove Friend" />';
    $sendmessage='<input type="submit" name="sendmsg" class="btnn btn--primary ind" value="Message" width="30" class="icon"/>';

  }
  else
  {
    $addasfriend='<input type="submit" name="addasfriend" class="btnn btn--secondary " value="Send Request" />';
    $sendmessage='<input type="submit" name="sendmsg" class="btnn btn--primary ind" value="Message" width="30" class="icon"/>';
  }
}
else
{
    $addasfriend="";
    $sendmessage="";
}

 ?>
<?php
}
else
{
  if($username!=$user)
  {
    $addasfriend='<input type="submit" name="addasfriend" class="btnn btn--secondary " value="Send Request" />';
    $sendmessage='<input type="submit" name="sendmsg" class="btnn btn--primary ind" value="Message" width="30" class="icon"/>';
  }
  else
  {
      $addasfriend="";
      $sendmessage="";
  }
}

 ?>

 <?php
 if(@$_POST['removefriend'])
 {
   $already_friends=mysqli_query($db,"SELECT friend_array FROM users WHERE username='$username'");
   $already_friends_row=mysqli_fetch_assoc($already_friends);
   $already_friends_array=$already_friends_row['friend_array'];
   //echo "$already_friends_array";
   $already_friends_explode=explode(",",$already_friends_array);
   $already_friends_count=count($already_friends_explode);
   $comma=",".$username;
   $comma2=$username.",";

   $already_friends_profile=mysqli_query($db,"SELECT friend_array FROM users WHERE username='$user'");
   $already_friends_row_profile=mysqli_fetch_assoc($already_friends_profile);
   $already_friends_array_profile=$already_friends_row_profile['friend_array'];
   //echo "$already_friends_array";
   $already_friends_explode_profile=explode(",",$already_friends_array_profile);
   $already_friends_count_profile=count($already_friends_explode_profile);
   $comma_profile=",".$user;
   $comma2_profile=$user.",";
   //Editing logged in user database
   if(strstr($already_friends_array,$comma_profile))
   {
     $friend1=str_replace("$comma_profile","",$already_friends_array);
   }
   elseif(strstr($already_friends_array,$comma2_profile))
   {
     $friend1=str_replace("$comma2_profile","",$already_friends_array);
   }
   elseif(strstr($already_friends_array,$user))
   {
     $friend1=str_replace("$user","",$already_friends_array);
   }
   //editing current profile user database
   if(strstr($already_friends_array_profile,$comma))
   {
     $friend2=str_replace("$comma","",$already_friends_array_profile);
   }
   elseif(strstr($already_friends_array_profile,$comma2))
   {
     $friend2=str_replace("$comma2","",$already_friends_array_profile);
   }
   elseif(strstr($already_friends_array_profile,$username))
   {
     $friend2=str_replace("$username","",$already_friends_array_profile);
   }

   $removefriend_query=mysqli_query($db, "UPDATE users SET friend_array='$friend1' WHERE username='$username'");
   $removefriend_query_profile=mysqli_query($db, "UPDATE users SET friend_array='$friend2' WHERE username='$user'");

   echo "Friend Removed <br />";
   header("Location: $user");
 }
 else
 {

 }

 ?>

<?php echo $error_send; echo $addasfriend; ?>
<?php echo $sendmessage;?>

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
  <?php
  if($countfriend !=0)
  {
    foreach ($friendarray12 as $key => $value)
    {
      $i++;
      $getfriend=mysqli_query($db,"SELECT * FROM users WHERE username='$value' LIMIT 1");
      $getfriendrow=mysqli_fetch_assoc($getfriend);
      $friendusername=$getfriendrow['username'];
      $friendprofilepic=$getfriendrow['profile_pic'];
      $friendsfirstname=$getfriendrow['first_name'];
      if($friendprofilepic=="")
      {
        echo "<a href='$friendusername'><img src='img/default_dp.jpg' alt=\"$friendsfirstname's Profile\" title=\"$friendsfirstname's Profile\" height='50' width='50' style='padding-right: 6px;'></a>";
      }
      else
      {
        echo "<a href='$friendusername'><img src='userdata/profile_pics/$friendprofilepic' alt=\"$friendsfirstname's Profile\" title=\"$friendsfirstname's Profile\" height='50' width='50' style='padding-right: 6px;'></a>";
      }
    }
  }
  else
  {
    echo $user." has no friends";
  }
  ?>
  </div>
  <?php include ( "./inc/footer.inc.php" );?>
