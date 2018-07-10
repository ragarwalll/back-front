<?php include ( "./inc/connect.inc.php");
$username=stripslashes(htmlspecialchars($_GET['username']));
$profile=stripslashes(htmlspecialchars($_GET['profile']));
//$result=("SELECT user_from,msg_body from pvt_messages WHERE user_to='$username'");
$seen_query=mysqli_query($db, "UPDATE pvt_messages SET opened='yes' WHERE user_to='$username' AND user_from='$profile'");
$result=$db->prepare("SELECT user_from,msg_body,date,opened from pvt_messages WHERE user_to IN('$username','$profile') AND user_from IN('$username','$profile')");
$result->execute();
$result=$result->get_result();

while($r = $result->fetch_row()){
  if($r[3] == "yes")
  {
    $r[3] = "Seen";
  }
  else {
    $r[3] = "";
  }
  echo $r[0]."\\".$r[1]."\\".$r[2]."\\".$r[3]."\n";
}
//$user_from
?>
