<?php include ( "./inc/header.inc.php" );  ?>
<?php
if($username)
  Header("Location:home.php");
 ?>
<?php include ( "./inc/register.inc.php" );  ?>
<?php include ( "./inc/login.inc.php" );  ?>
      <br></br>
        <table align="center">
          <tr>
            <td class="box1">
              <h2>Already a member? Log in now!</h2>
              <form action="index.php" method="POST">
                <input type="text" name="user_login" size="25" placeholder="Username" /><p />
                <input type="password" name="password_login" size="25" placeholder="Password" /><p />
                <input type="submit" name="login" class="btn btn--secondary" value="Sign In">
              </form>
            </td>
            <td class="box2">
              <h2>Create a new account</h2>
              <form action="index.php" method="POST">
                <p /><input type="text" name="fname" size="25" placeholder="First Name" /><p />
                <input type="text" name="lname" size="25" placeholder="Last Name" /><p />
                <input type="text" name="username" size="25" placeholder="Username" /><p />
                <input type="text" name="email" size="25" placeholder="Email" /><p />
                <input type="text" name="email2" size="25" placeholder="Retype Email" /><p />
                <input type="password" name="password" size="25" placeholder="Password" /><p />
                <input type="password" name="password2" size="25" placeholder="Retype Password" /><p />
                <input type="submit" name="reg" class="btn btn--primary" value="Sign Up">
              </form>
            </td>
          </tr>
        </table>
<?php include ( "./inc/footer.inc.php" );?>
