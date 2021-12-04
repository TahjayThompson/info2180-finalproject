<!-- DEBUGGING MODE -->
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING MODE -->


<?php
session_start();
/// all echo prints must be commented after working
require_once 'config.php';

// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     // echo "Connected to $dbname at $host successfully.";    
// } catch (PDOException $pe) {
//     die("Could not connect to the database $dbname :" . $pe->getMessage());
// }



if(ISSET($_POST['password']) && ISSET($_POST['email'])){

    //collect info
    $password = trim(filter_var(htmlspecialchars($_POST['password']), FILTER_SANITIZE_STRING));
    $email = trim(filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_STRING));

    // get data from database to test it
    // $db_email="SELECT email From users WHERE users.email='$email';";
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
    
            if(isset($_SESSION['current_id']) && $_SESSION['current_id'] > 0){
                ///must be set to the home or main page
                header("Location:main.html");
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
    

    



    // $all_db_passwords="SELECT password From users";
    
    // $get_email = $conn->query($db_email);
    // $get_passwords = $conn->query($all_db_passwords);

    // $res_email = $get_email->fetchAll(PDO::FETCH_ASSOC);
    // $res_passwords = $get_passwords->fetchAll(PDO::FETCH_ASSOC);
  


    // /// loop used to check if password is in the database 
    // $checked;
    // foreach ($all_db_passwords as $hash_password_from_db): 
    //     //verify is used to unhash the hashed password which stores a boolean of t/f
    //     $checked=password_verify($password, $hash_password_from_db);
    // endforeach;

    // if ($checked) {
    //     echo 'Password is valid!';

    //     $getId="SELECT id From users WHERE users.email='$get_email' AND users.password='$hashpassword'";
    //     $qId = $conn->query($getId);
    //     $id = $qId->fetchAll(PDO::FETCH_ASSOC);
    //     $_SESSION['current_id']=$id;

    //     if(isset($_SESSION['current_id']) && $_SESSION['current_id'] > 0){
    //         ///must be set to the home or main page
    //         header("Location:main.html");
    //         exit;
    //     }
    // } 
    // else {
    //     echo "<script>alert('You have entered Incorrect Credentials');</script>";
        
    // }
 
}


// INSERT INTO users(firstname,lastname,password,email) VALUES ('test','test','9u2irhiwhruy43yugyhufnioui 





