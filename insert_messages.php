<?php include ( "./inc/connect.inc.php");
$username=stripslashes(htmlspecialchars($_GET['username']));
$profile=stripslashes(htmlspecialchars($_GET['profile']));
$message=stripslashes(htmlspecialchars($_GET['message']));
$date=$_GET['date'];
if($username=="" || $message=="" || $user=""){
  die();
}
$date=date("Y-m-d");
$opened="no";
$result=mysqli_query($db,"INSERT INTO pvt_messages VALUES('','$username','$profile','$message','$date','$opened')");
?>
