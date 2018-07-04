<?php
include ( "./inc/header.inc.php" );
$get_friend_check=mysqli_query($db,"SELECT count(user_from) FROM friend_requests WHERE user_to='$username'");
$get_friend_row=mysqli_fetch_assoc($get_friend_check);
$friend_array=$get_friend_row['count(user_from)'];
?>
