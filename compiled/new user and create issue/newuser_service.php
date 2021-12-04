<!-- START OF DEBUGGING -->

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING -->




<?php

  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root" . "/info2180-finalproject/compiled/config.php");

  $fname = filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
  $lname = filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
  $pass =  filter_var($_POST['password'],FILTER_SANITIZE_STRING);

  function check_password($data){
    if(strlen($data) < 8){//checks string length
      echo "password should be atleast 8 characters long";
    } 
    else if (preg_match('/[A-Za-z]/', $data)==FALSE){
      echo 'password must have atleast one letter';
    }
    else if (preg_match('/[A-Z]/', $data) == FALSE){
      echo "password should contain an upper case letter";
    } 
    else if (preg_match('/[0-9]/', $data) ==FALSE){
      echo 'password must have atlest one number';
    } 
    else{
      return $data;
    }
  }


  $validated_password = check_password($pass);

  $pass_hash = password_hash($validated_password, PASSWORD_DEFAULT); //hash users pass word

  $q = "INSERT INTO users(firstname,lastname,password,email) VALUES('$fname','$lname','$pass_hash','$email');";

  if($conn->query($q) == TRUE){
    echo"<script> alert('User Created!'); </script>";
    echo"<script> window.location.href = '../main.php'; </script>";

    
  }
  else{
    echo"<script> alert('Error processing request!'); </script>";
    echo"<script> window.location.href = 'newuser.php'; </script>";


  }

?>