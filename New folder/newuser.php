<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>

<?php
  $fname = filter_var($_GET['fname'],FILTER_SANITIZE_STRING);
  $lname = filter_var($_GET['lname'],FILTER_SANITIZE_STRING);
  $email = filter_var($_GET['email'],FILTER_SANITIZE_STRING);
  $pass =  filter_var($_GET['password'],FILTER_SANITIZE_STRING);
 
  function check_password($data){
    if(strlen($data) < 8){//checks string length
      echo "password should be atleast 8 characters long";
    } 
    else if (preg_match('/[A-Za-z]/', $data)==FALSE){
      echo 'password must have atleast one letter';
    }
    else if !(preg_match('/[A-Z]/', $data)){
      echo "password should contain an upper case letter";
    } 
    else if !(preg_match('/[0-9]/', $data)){
      echo 'password must have atlest one number';
    } 
    else{
      return $data;
    }
  }


  $validated_password = check_password($pass);

  $pass_hash = password_hash($validated_password, PASSWORD_DEFAULT); //hash users pass word

?>