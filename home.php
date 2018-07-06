<?php
include ( "./inc/header.inc.php");
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
  //profile_picture of the user logged include
  $logged_profile_picture_query=mysqli_query($db,"SELECT profile_pic FROM users WHERE username='$username'");
  $dp_fetch=mysqli_fetch_assoc($logged_profile_picture_query);
  $dp=$dp_fetch['profile_pic'];
  if($dp=="")
  {
    $dp="img/default_dp.jpg";
  }
  else
  {
    if(!file_exists("userdata/profile_pics/".$dp))
    {
      $dp="img/default_dp.jpg";
    }
    else
    {
      $dp="userdata/profile_pics/".$dp;
    }
  }
  //check if username likes or note
  $likes_query=mysqli_query($db, "SELECT * FROM likes WHERE post_id='$id' AND user_liked='$username'");
  $likes_row=mysqli_num_rows($likes_query);
  //like$
  $get_likes_query_id=mysqli_query($db, "SELECT max(id) FROM likes WHERE post_id='$id'");
  $get_id_fetch=mysqli_fetch_assoc($get_likes_query_id);
  $lid=$get_id_fetch['max(id)'];
  $get_likes_query=mysqli_query($db, "SELECT total_likes FROM likes WHERE id='$lid'");
  $get_likes_row=mysqli_num_rows($get_likes_query);
  $get_likes_fetch=mysqli_fetch_assoc($get_likes_query);
  $total_like_nos=$get_likes_fetch['total_likes'];
  if($total_like_nos == NULL)
  {
    $total_like_nos=0;
    $total_like=$total_like_nos;
  }
  else
  {
    $total_like=$total_like_nos;
  }
  if (isset($_POST['like' . $id . '']))
  {
    $new_total_like=++$total_like_nos;
    $new_like_query=mysqli_query($db,"INSERT INTO likes VALUES('','$username','$new_total_like','$id')");
    echo "
    <script>
        alert('Post Liked!');
    </script>";
    $likes_row=1;
    $total_like=++$total_like;
  }
  if (isset($_POST['unlike' . $id . '']))
  {
    $new_unlike_query=mysqli_query($db,"DELETE FROM likes WHERE post_id='$id' AND user_liked='$username'");

    $get_likes_query_id=mysqli_query($db, "SELECT max(id) FROM likes WHERE post_id='$id'");
    $get_id_fetch=mysqli_fetch_assoc($get_likes_query_id);
    $lid=$get_id_fetch['max(id)'];
    if($lid == NULL)
    {
      $total_like_nos=0;
      $total_like=$total_like_nos;
    }
    else
    {
      $new_total_like=--$total_like_nos;
      $get_likes_query=mysqli_query($db, "UPDATE likes SET total_likes='$new_total_like' WHERE id='$lid'");
    }
    echo "
    <script>
        alert('Post Unliked!');
    </script>";
    $likes_row=0;
  }
  //Posting comments
  if (isset($_POST['postComment' . $id . '']))
  {
    $comment_posted=$_POST['post_body'];
    $insert_comment_query=mysqli_query($db,"INSERT INTO post_comments VALUES ('','$comment_posted','$username','$added_by','0','$id')");
    //echo "Comment Posted";
    echo "
    <script>
        alert('Comment Posted');
    </script>";
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
    </div>
    <div style='color: rgba(22, 219, 147, 1); font-size: 0.8em;'>
      $total_like people likes this
    </div>
    <hr />
    <div class='postspublic$id'>";
    if($likes_row==1)
    {
      echo"
      <div class='like$id' >
        <form action='./home.php' method='POST'>
          <input type='submit' name='unlike$id' class='btn_like' value='Unlike'>
        </form>
      </div>";
    }
    else
    {
      echo"
      <div class='like$id'>
        <form action='./home.php' method='POST'>
          <input type='submit' name='like$id' class='btn_like' value='Like'>
        </form>
      </div>";
    }
    echo"
      <div class='comment$id'>
        Comment
      </div>
    </div><hr>
    <div class='comments_reveal$id'>
      <div class='post_com'>
        <img src='$dp' height='30' style='border-radius: 50%;display:inline-block;'>
        <form action='./home.php' method='POST' style='display:inline-block;'>
          <textarea rols='1' cols='70' id='normal' placeholder='enter comment...' name='post_body'></textarea>
          <input type='submit' name='postComment$id' class='btn_comment' value='Comment'>
        </form><br><br>
      </div>
      <script src='js/autoresize.jquery.min.js'></script>
  		<script>
  			$(function(){
  				$('#normal').autosize();
  			});
  		</script>
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
          <img id='comment_dp' src='$comment_profilepic_post' height='30' style='border-radius: 50%;'>
          <div class='comment_body'>
            <a href='$comment_posted_by' id='by_user'>$comment_firstname_post $comment_lastname_post</a>
            <span>$comment_body</span>
          </div><br /><br />

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
</div>
</div></br>
<?php }
include ( "./inc/footer.inc.php" );?>
