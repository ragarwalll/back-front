<?php

if(isset($_POST["user_login"]) && isset($_POST["password_login"]))
{
  $user_login=preg_replace('#[^A-Za-z0-9]#i', '',$_POST["user_login"]);
  $password_login=preg_replace('#[^A-Za-z0-9]#i', '',$_POST["password_login"]);
  $password_login= md5($password_login);
  $sql=mysqli_query($db,"SELECT id FROM users WHERE username='$user_login' AND password='$password_login' LIMIT 1");
  $usercount=mysqli_num_rows($sql);
  if($usercount == 1)
  {
    while ($row=mysqli_fetch_array($sql))
    {
      $id=$row["id"];
    }
    $_SESSION["user_login"]=$user_login;
    header("location: home.php");
    exit();
  }
  else
  {
    echo "Incorrect information";
    exit();
  }
}

 ?>
