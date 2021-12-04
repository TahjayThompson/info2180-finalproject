<!-- DEBUGGING MODE -->
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING MODE -->


<?php
session_start();

require_once 'config.php';





if(ISSET($_POST['password']) && ISSET($_POST['email'])){

    //collect info
    $password = trim(filter_var(htmlspecialchars($_POST['password']), FILTER_SANITIZE_STRING));
    $email = trim(filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_STRING));

    // get data from database to test it
    // $db_email="SELECT email From users WHERE users.email='$email';";
    $user_q="SELECT * From users WHERE users.email='$email';";

    $user = $conn->query($user_q);
    $u_info = $user-> fetchAll(PDO::FETCH_ASSOC);
    // var_dump($u_info[0]['id']);

    // if the user data has been received
    if(count($u_info[0]) > 0 ){
        $checked=password_verify($password, $u_info[0]['password']);

        if ($checked) {
            $_SESSION['current_id']=$u_info[0]['id'];


            if($email == 'admin@project2.com'){
                $_SESSION['admin'] = $u_info[0]['id'];
            }
    
            if(isset($_SESSION['current_id']) && $_SESSION['current_id'] > 0){
                ///must be set to the home or main page
                header("Location:main.php");
                exit;
            }
        } 
        else {
            echo "<script>alert('You have entered Incorrect Credentials');</script>";
            header("Location:index.html");            
        }


    }else{
        echo "<script>alert('You have entered Incorrect Credentials');</script>";
        header("Location:index.html");
    }
    

  
 
}


// INSERT INTO users(firstname,lastname,password,email) VALUES ('test','test','9u2irhiwhruy43yugyhufnioui 





