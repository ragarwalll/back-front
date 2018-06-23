<?php include ( "./inc/header.inc.php" );  ?>
<?php include ( "./inc/register.inc.php" );  ?>
    <br></br>
    <div style="width: 1000px; margin: 0px auto 0px auto">
      <table>
        <tr>
          <td class="box" valign="top">
            <h2>Already a member? Log in now!</h2>
            <form action="index.php" method="POST">
              <input type="text" name="username" size="25" placeholder="Username" /><p />
              <input type="text" name="password" size="25" placeholder="Password" /><p />
              <input type="submit" name="reg" value="Sign Up">
            </form>
          </td>
          <td class="box "valign="top">
            <h2>Create a new account</h2>
            <form action="index.php" method="POST">
              <p /><input type="text" name="fname" size="25" placeholder="First Name" /><p />
              <input type="text" name="lname" size="25" placeholder="Last Name" /><p />
              <input type="text" name="username" size="25" placeholder="Username" /><p />
              <input type="text" name="email" size="25" placeholder="Email" /><p />
              <input type="text" name="email2" size="25" placeholder="Retype Email" /><p />
              <input type="text" name="password" size="25" placeholder="Password" /><p />
              <input type="text" name="password2" size="25" placeholder="Retype Password" /><p />
              <input type="submit" name="reg" value="Sign Up">
            </form>
          </td>
        </tr>
      </table>
<?php include ( "./inc/footer.inc.php" );  ?>
