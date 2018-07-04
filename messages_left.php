<?php
include ( "./inc/connect.inc.php" );
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
