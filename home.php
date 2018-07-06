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
//get posts
$getposts=mysqli_query($db,"SELECT * FROM posts WHERE user_posted_to='$username' ORDER BY id DESC LIMIT 10") or die(mysqlerror());
while ($row= mysqli_fetch_assoc($getposts))
{
  $id=$row['id'];
  $body=$row['body'];
  $date_added=$row['date_added'];
  $added_by=$row['added_by'];
  $user_posted_to=$row['user_posted_to'];
  //get details of the post by the user
  $getname=mysqli_query($db,"SELECT * FROM users WHERE username='$added_by' ") or die(mysqlerror());
  while ($get_name= mysqli_fetch_assoc($getname))
  {
    $firstname_post=$get_name['first_name'];
    $lastname_post=$get_name['last_name'];
    $profilepic_post=$get_name['profile_pic'];
  }
  if($profilepic_post=="")
  {
    $profilepic_post="img/default_dp.jpg";
  }
  else
  {
    if(!file_exists("userdata/profile_pics/".$profilepic_post))
    {
      $profilepic_post="img/default_dp.jpg";
    }
    else
    {
      $profilepic_post="userdata/profile_pics/".$profilepic_post;
    }
  }
  echo "
  <div class='newsfeed'>
    <div class='newsfeedoptions$id'>
      <div class='options$id'></div>
    </div>
    <div class='posted_by'>
      <img src='$profilepic_post' height='40' style='border-radius: 50%;'>
      <a href='$added_by'>$firstname_post $lastname_post</a><span>$date_added</span><br />
    </div><br />
    &nbsp;&nbsp;<br />
    <div class='actual_post' style='overflox-x: 100px;'>
      $body
    </div><hr />
    <div class='postspublic$id'>
      <div class='like$id'>
        Like
      </div>
      <div class='comment$id'>
        Comment
      </div>
    </div><hr>
    ";
    include ("js/post.js");
    //get comments
    $comments_query=mysqli_query($db,"SELECT * FROM post_comments WHERE post_id='$id' ORDER BY id DESC");
    $comments_row=mysqli_num_rows($comments_query);
    if($comments_row!=0)
    {
      while($comments=mysqli_fetch_assoc($comments_query))
      {

        $comment_body=$comments['post_body'];
        $comment_posted_to=$comments['posted_to'];
        $comment_posted_by=$comments['posted_by'];
        $comment_removed=$comments['post_removed'];

        //get name of the user who commented
        $comment_getname_query=mysqli_query($db,"SELECT * FROM users WHERE username='$comment_posted_by'") or die(mysqlerror());
        $comment_get_name= mysqli_fetch_assoc($comment_getname_query);
        $comment_firstname_post=$comment_get_name['first_name'];
        $comment_lastname_post=$comment_get_name['last_name'];
        $comment_profilepic_post=$comment_get_name['profile_pic'];
        //Check and setting default d[]
        if($comment_profilepic_post=="")
        {
          $comment_profilepic_post="img/default_dp.jpg";
        }
        else
        {
          if(!file_exists("userdata/profile_pics/".$comment_profilepic_post))
          {
            $comment_profilepic_post="img/default_dp.jpg";
          }
          else
          {
            $comment_profilepic_post="userdata/profile_pics/".$comment_profilepic_post;
          }
        }

        echo"
        <div class='comments_reveal$id'><br>
          <img id='comment_dp' src='$comment_profilepic_post' height='30' style='border-radius: 50%;'>
          <div class='comment_body'>
            <a href='$comment_posted_by' id='by_user'>$comment_firstname_post $comment_lastname_post</a>
            <span>$comment_body</span>
          </div><br />
        </div>
        ";
      }
    }
    else
    {
      $error="No comments";
      echo"
      <div class='comments_reveal$id'>
        $error
      </div>";
    }
  include ("css/extra/post.css");
  include ("js/comments_reveal.js");

?>
</div></br>
<?php }include ( "./inc/footer.inc.php" );?>
