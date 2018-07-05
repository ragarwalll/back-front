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
$getposts=mysqli_query($db,"SELECT * FROM posts WHERE user_posted_to='$username' ORDER BY id DESC LIMIT 10") or die(mysqlerror());
while ($row= mysqli_fetch_assoc($getposts))
{
  $id=$row['id'];
  $body=$row['body'];
  $date_added=$row['date_added'];
  $added_by=$row['added_by'];
  $user_posted_to=$row['user_posted_to'];
  $getname=mysqli_query($db,"SELECT * FROM users WHERE username='$added_by' ") or die(mysqlerror());
  while ($get_name= mysqli_fetch_assoc($getname))
  {
    $firstname_post=$get_name['first_name'];
    $lastname_post=$get_name['last_name'];
    $profilepic_post=$get_name['profile_pic'];
  }
  echo "
  <div class='newsfeed'>
    <div class='newsfeedoptions$id'>
      <div class='options$id'></div>
    </div>
    <div class='posted_by'>
      <img src='userdata/profile_pics/$profilepic_post' height='40' style='border-radius: 50%;'>
      <a href='$added_by'>$firstname_post $lastname_post</a><span>$date_added</span><br />
    </div><br />
    &nbsp;&nbsp;<br />
    <div class='actual_post' style='overflox-x: 100px;'>
      $body
    </div><br />
  </div>
  ";
include ("css/extra/post.css");
include ("js/post.js  ");
?>


<?php }include ( "./inc/footer.inc.php" );?>
