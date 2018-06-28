<?php
$reg= @$_POST['reg'];
$fn="";//First Name
$ln="";//Last Name
$un="";//UserName
$em="";//Email1
$em2="";//Email2
$pswd="";//Password1
$pswd2="";//Password2
$d="";//Join Date
$u_check="";//Checking Username EXISTS
//Assigning Values
$fn= strip_tags(@$_POST['fname']);
$ln= strip_tags(@$_POST['lname']);
$un= strip_tags(@$_POST['username']);
$em= strip_tags(@$_POST['email']);
$em2= strip_tags(@$_POST['email2']);
$pswd= strip_tags(@$_POST['password']);
$pswd2= strip_tags(@$_POST['password2']);
$d= date("Y-m-d");
//Checking
if($reg)
{//Matching of username-if entered correctly
  if($em==$em2)
  {
    $u_check= mysqli_query($db,"SELECT username FROM users WHERE username='$un'");
    $check=mysqli_num_rows($u_check);
    $e_check=mysqli_query($db,"SELECT email FROM users WHERE email='$em'");
    $email_check=mysqli_num_rows($e_check);
      if($check==0)
      {
        if($email_check==0)
        {
            if($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2)
            {
              if($pswd==$pswd2)
              {
                if(strlen($un)>25||strlen($fn)>25||strlen($ln)>25)
                {
                  echo "Username/First Name/Last Name exceeds 25 Characters";
                }
                else
                {
                  if(strlen($pswd)>30||strlen($pswd)<5)
                  {
                    echo "Your password must be between 5 and 30 characters long";
                  }
                  else
                  {
                    $pswd=md5($pswd);
                    $pswd=md5($pswd2);
                    $query=mysqli_query($db,"INSERT INTO users VALUES('','$un','$fn','$ln','$em','$pswd','$d','0','','','')");
                    die("<h2>Welcome to El Arte Connect</h2>Login in to get started");
                  }
                }
              }
              else
              {
                echo "Password doesn't match";
              }
            }
          else
          {
            echo "Please fill every detail then proceed";
          }
        }
        else
        {
          echo "Email already exists, enter another";
        }
      }
      else
      {
        echo "Username already exists";
      }
  }
  else
  {
    echo "Email doesn't match";
  }
}
 ?>
