<?php
session_start();
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";    
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

if(ISSET($_POST['submit'])){

    $fname = trim(filter_var(htmlspecialchars($_POST['fname']), FILTER_SANITIZE_STRING));
    $lname = trim(filter_var(htmlspecialchars($_POST['lname']), FILTER_SANITIZE_STRING));
    $password = trim(filter_var(htmlspecialchars($_POST['password']), FILTER_SANITIZE_STRING));
    $email = trim(filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_STRING));
    $hashpassword= password_hash($password, PASSWORD_DEFAULT);
    $qStr = "INSERT INTO users(firstname,lastname,password,email) VALUES ('$fname','$lname','$hashpassword','$email')";

    if ($conn->query($qStr)) {
        echo "added successfully";

    }
}


// INSERT INTO users(firstname,lastname,password,email) VALUES ('test','test','9u2irhiwhruy43yugyhufnioui ','test@test.com');
// password_verify(current, testpas)
// session_destroy();





