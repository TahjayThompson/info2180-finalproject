
<?php
session_start();

require_once 'config.php';





if(ISSET($_POST['password']) && ISSET($_POST['email'])){

    //collect info
    $password = $_POST['password'];

    $email = filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL);

    // get data from database to test it
    $user_q="SELECT * From users WHERE users.email='$email';";

    $user = $conn->query($user_q);
    $u_info = $user-> fetchAll(PDO::FETCH_ASSOC);


    // if the user data has been received
    if(count($u_info[0]) > 0 ){
        $checked=password_verify($password, $u_info[0]['password']);

        if ($checked) {
            $_SESSION['current_id']=$u_info[0]['id'];


            if($email == 'admin@project2.com'){
                $_SESSION['admin'] = $u_info[0]['id'];
            }
    
            if(isset($_SESSION['current_id'])){
                ///must be set to the home or main page
                
                header("Location:main.php");
                exit;
            }
        } 
        else {
            echo "<script>alert('You have entered Incorrect Credentials');</script>";
            echo "<script> window.location.href = 'index.html'; </script>";

        }


    }else{
        echo "<script>alert('You have entered Incorrect Email');</script>";
        echo "<script> window.location.href = 'index.html'; </script>";

    }   
 
}







