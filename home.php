<?php
include ( "./inc/header.inc.php" );
if($username)
{

}
else
{
    die("You must be logged in you view this page");
}
echo "Hello, ".$username;
echo "<br />Would you like to logout? <a href='logout.php'>Logout</a>"
 ?>
<?php include ( "./inc/footer.inc.php" );?>
