




<?php

    session_start();   
    if(!isset($_SESSION['admin'])){
    header("Location: index.html");
  }

  $root = $_SERVER['DOCUMENT_ROOT'];
  include("$root" . "/info2180-finalproject/compiled/config.php");

  $fname = filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
  $lname = filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
  $pass =  $_POST['password'];



  function check_password($data){
    if(strlen($data) < 8){//checks string length
     FALSE;
    } 
    else if (preg_match('/[A-Za-z]/', $data)==FALSE){
     return FALSE;

    }
    else if (preg_match('/[A-Z]/', $data) == FALSE){
     return FALSE;

    } 
    else if (preg_match('/[0-9]/', $data) ==FALSE){
     return FALSE;

    } 
    else{
      return TRUE;
    }
  }


  
if(check_password($pass)){

  $pass_hash = password_hash($pass, PASSWORD_DEFAULT); //hash users pass word
  

  // $q = "INSERT INTO users(firstname,lastname,password,email) VALUES('$fname','$lname','$pass_hash','$email');";

  $stmt = $conn->prepare("INSERT INTO users(firstname,lastname,password,email) VALUES(:Fname,:Lname,:passwd,:mail_addr)");
  $stmt->bindParam(':Fname', $fname);
  $stmt->bindParam(':Lname', $lname);
  $stmt->bindParam(':passwd', $pass_hash);
  $stmt->bindParam(':mail_addr', $email);

  if($stmt->execute() == TRUE){
    echo"<script> alert('User Created!'); </script>";
    echo"<script> window.location.href = '../main.php'; </script>";

    
  }
  else{
    echo"<script> alert('Error processing request!'); </script>";
    echo"<script> window.location.href = 'newuser.php'; </script>";


  }
}
else{
  echo"<script> alert('Your password has an incorrect format!'); </script>";
  echo"<script> window.location.href = 'newuser.php'; </script>";
}

?>