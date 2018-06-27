<?php include ( "./inc/connect.inc.php");
session_start();
if(!isset($_SESSION["user_login"]))
{
  $username="";
}
else
{
  $username= $_SESSION["user_login"];
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
    initial scale=1">
    <title>El Arte</title>
    <script src="js/main.js" type="text/javascript"></script>

    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <!--header===================-->
    <header class="main-header">
      <div class="container grid">
        <div class="logo">
          <img src="img/logo1.png" alt="">
        </div>
        <?php
        if($username)
        {
          echo '
          <div class="search_box">
            <form action="search.php" method="GET" id="search">
              <input type="text" name="q" size="60" placeholder="Find friends">
            </form>
          </div>
          <nav class="main-nav">
            <ul class="unstyled-list">
            <li><a href="home.php">Home</a></li>
              <li><a href="'.$username.'">Profile</a></li>
              <li><a href="account_settings.php">Account Settings</a></li>
              <li><a href="logout.php">Log Out</a></li>';
          }
          else
          {
              echo' <nav class="main-nav">
              <ul class="unstyled-list">
                <li><a href="index.php">Sign up/Log in</a></li>
                <li><a href="">Blog</a></li>';
          }
          ?>
        </nav>
      </div>
    </header>
    <div id="wrapper">
<br />
<br />
