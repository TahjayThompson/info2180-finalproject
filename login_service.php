<?php
session_start();
/// all echo prints must be commented after working
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";    
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}



if(ISSET($_POST['submit'])){

    //collect info
    $password = trim(filter_var(htmlspecialchars($_POST['password']), FILTER_SANITIZE_STRING));
    $email = trim(filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_STRING));
    $hashpassword= password_hash($password);

    // get data from database to test it
    $db_email="SELECT email From users WHERE users.email='$email'";
    $all_db_passwords="SELECT password From users";
    
    $get_email = $conn->query($db_email);
    $get_passwords = $conn->query($all_db_passwords);

    $res_email = $get_email->fetchAll(PDO::FETCH_ASSOC);
    $res_passwords = $get_passwords->fetchAll(PDO::FETCH_ASSOC);
  


    /// loop used to check if password is in the database 
    $checked;
    foreach ($all_db_passwords as $hash_password_from_db): 
        //verify is used to unhash the hashed password which stores a boolean of t/f
        $checked=password_verify($hashpassword, $hash_password_from_db);
    endforeach;

    if ($checked) {
        echo 'Password is valid!';

        $getId="SELECT id From users WHERE users.email='$get_email' AND users.password='$hashpassword'";
        $qId = $conn->query($getId);
        $id = $qId->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['current_id']=$id;

        if(isset($_SESSION['current_id']) && $_SESSION['current_id'] > 0){
            ///must be set to the home or main page
            header("Location:./");
            exit;
        }
    } 
    else {
        echo 'Invalid password.';
    }
 
}


// INSERT INTO users(firstname,lastname,password,email) VALUES ('test','test','9u2irhiwhruy43yugyhufnioui 





