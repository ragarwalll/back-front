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
    <br></br>
    <div style="width: 1000px; margin: 0px auto 0px auto">
      <table>
        <tr>
          <td class="box  " valign="top">
            <h2>Join <span>El Arte </span>today</h2>
          </td>
          <td class="box "valign="top">
            <h2>Create a new account</h2>
            <form action="#" method="POST">
              <p /><input type="text" name="fname" size="25" placeholder="First Name" /><p />
              <input type="text" name="lname" size="25" placeholder="Last Name" /><p />
              <input type="text" name="username" size="25" placeholder="Username" /><p />
              <input type="text" name="email" size="25" placeholder="Email" /><p />
              <input type="text" name="email2" size="25" placeholder="Retype Email" /><p />
              <input type="text" name="password" size="25" placeholder="Password" /><p />
              <input type="text" name="password" size="25" placeholder="Retype Password" /><p />
              <input type="submit" name="submit" value="Sign Up">
            </form>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
