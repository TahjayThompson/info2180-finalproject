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

    $title = trim(filter_var(htmlspecialchars($_POST['title']), FILTER_SANITIZE_STRING));
    $descr = trim(filter_var(htmlspecialchars($_POST['descr']), FILTER_SANITIZE_STRING));
    $assignTo = trim(filter_var(htmlspecialchars($_POST['assignTo']), FILTER_SANITIZE_STRING));
    $type = trim(filter_var(htmlspecialchars($_POST['type']), FILTER_SANITIZE_STRING));
    $priority = trim(filter_var(htmlspecialchars($_POST['priority']), FILTER_SANITIZE_STRING));

    $splitStr = explode(" ", $assignTo);    
    //get id for user
    $getId="SELECT id From users WHERE users.firstname='$splitStr[0]' AND users.lastname='$splitStr[1]'";
    $qId = $conn->query($getId);
    $user_id = $qId->fetchAll(PDO::FETCH_ASSOC);
    $logged_In_User = $_SESSION['current_id'];

    $qStr = "INSERT INTO issues (title,description,type,priority,status,assigned_to,created_by) VALUES ('$title','$descr','$type','$priority','Open','$user_id','$logged_In_User')";

    if ($conn->query($qStr)) {
        echo "added successfully";

    }
}

// INSERT INTO users(firstname,lastname,password,email) VALUES ('test','test','9u2irhiwhruy43yugyhufnioui ','test@test.com');
// password_verify(current, testpas)
// session_destroy();
