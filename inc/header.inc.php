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
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="js/reload.js" type="text/javascript"></script>
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <!--header===================-->
    <header class="main-header">
      <div class="container grid">
        <div class="logo">
          <img src="img/logo1.png" alt="El Arte">
        </div>
        <?php
        if($username)
        {
          $get_friend_check=mysqli_query($db,"SELECT count(user_from) FROM friend_requests WHERE user_to='$username'");
          $get_friend_row=mysqli_fetch_assoc($get_friend_check);
          $friend_array=$get_friend_row['count(user_from)'];
          $get_friend_messages=mysqli_query($db,"SELECT count(opened) FROM pvt_messages WHERE opened='no' AND user_to='$username'");
          $get_messages_row=mysqli_fetch_assoc($get_friend_messages);
          $friend_array_messages=$get_messages_row['count(opened)'];
          //<li><a href="friend_requests.php">Requests('.$friend_array.')</a></li>

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
                <li><a href="my_messages.php">Messages(<div id="screen">'.$friend_array_messages.'</div>)</a></li>
                <li><a href="friend_requests.php">Requests('.$friend_array.')</a></li>
                <li><a href="account_settings.php">Settings</a></li>
                <li><a href="logout.php">Log Out</a></li>';
          }
          else
          {

            echo'
            <nav class="main-nav">
              <ul class="unstyled-list">
              <li><a href="index.php">Sign up/Log in</a></li>
              <li><a href="">Blog</a></li>
              ';
          }
          ?>

          </nav>
          <div class="nav-toggle">
            <div class="hamburger"></div>
          </div>
        </div>
      <?php
      if($username)
      {
        echo '
        <div class="search-icon">
          <i class="fa fa-search icon_color" aria-hidden="true"></i>
        </div>';
      }
      else
      {
      }
      ?>

    </header>
    <div id="wrapper">
      <br />
      <br />
      <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
      <script src="js/search_icon.js"></script>
      <script src="js/nav.js"></script>
      <script src="https://use.fontawesome.com/97974f9c24.js"></script>
