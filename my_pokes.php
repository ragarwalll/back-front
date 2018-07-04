<?php
include ( "./inc/header.inc.php" );
?>

<?php
$checkpoke_query=mysqli_query($db,"SELECT * FROM pokes WHERE user_to='$username'");
$if_pokes=mysqli_num_rows($checkpoke_query);
if($if_pokes==0)
{
  echo "You have no pokes";
}
else
{
  while($checkpoke=mysqli_fetch_assoc($checkpoke_query))
  {
    $user_topoke=$checkpoke['user_to'];
    $user_frompoke=$checkpoke['user_from'];
    echo "You have been poked by $user_frompoke<br>";
?>
<?php
if (isset($_POST['pokeback'.$user_frompoke]))
{
  $pokecheck_query=mysqli_query($db,"SELECT * FROM pokes WHERE user_to='$user_frompoke' AND user_from='$username'");
  $check=mysqli_num_rows($pokecheck_query);
  if($check==1)
  {
    echo "You cannot poke twice";
  }
  else
  {
      $updatepoke=mysqli_query($db,"INSERT INTO pokes VALUES('','$username','$user_frompoke')");
      $removepoke_query=mysqli_query($db,"DELETE FROM pokes WHERE user_from='$user_frompoke' AND user_to='$username'");
      Header("Location: my_pokes.php");
  }
}
if (isset($_POST['ignorepoke'.$user_frompoke]))
{
  $removepoke_query=mysqli_query($db,"DELETE FROM pokes WHERE user_from='$user_frompoke' AND user_to='$username'");
  Header("Location: my_pokes.php");
}
?>
<form action="my_pokes.php" method="POST">
  <input type="submit" class="btnn btn--secondary" name=pokeback<?php echo $user_frompoke; ?> value="Poke Back" >
  <input type="submit" class="btnn btn--primary" name=ignorepoke<?php echo $user_frompoke; ?> value="Ignore">
</form>

 <?php
  }
}
?>
 <?php include ( "./inc/footer.inc.php" );?>
