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
      echo "User does not exists";
      exit();
    }
  }
}

 ?>
<h2>Profile: <?php echo "$username"; ?></h2>
<h2>First Name: <?php echo "$firstname"; ?></h2>
