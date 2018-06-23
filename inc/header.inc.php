<?php include ( "connect.inc.php");
session_start();
if(!isset($_SESSION["user_login"]))
{
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
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <!--header===================-->
    <header class="main-header">
      <div class="container grid">
        <div class="logo">
          <img src="img/logo1.png" alt="">
        </div>
        <div class="search_box">
          <form action="search.php" method="GET" id="search">
            <input type="text" name="q" size="60" placeholder="Search">
          </form>
        </div>
        <nav class="main-nav">
          <ul class="unstyled-list">
            <li><a href="">Home</a></li>
            <li><a href="">About</a></li>
            <li><a href="https://el1arte.blogspot.com/">Blog</a></li>
            <li><a href="">Sign Up</a></li>
            <li><a href="">Log In</a></li>
        </nav>
      </div>
    </header>
