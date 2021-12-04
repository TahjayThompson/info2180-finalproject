<!-- DEBUGGING MODE -->
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING MODE -->





<?php
session_start();

$root = $_SERVER['DOCUMENT_ROOT'];
include("$root" . "/info2180-finalproject/compiled/config.php");


// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     echo "Connected to $dbname at $host successfully.";    
// } catch (PDOException $pe) {
//     die("Could not connect to the database $dbname :" . $pe->getMessage());
// }

if(ISSET($_POST['title']) ){

    $title = trim(filter_var(htmlspecialchars($_POST['title']), FILTER_SANITIZE_STRING));
    $descr = trim(filter_var(htmlspecialchars($_POST['description']), FILTER_SANITIZE_STRING));
    $assignTo = trim(filter_var(htmlspecialchars($_POST['assignTo']), FILTER_SANITIZE_STRING));
    $type = trim(filter_var(htmlspecialchars($_POST['type']), FILTER_SANITIZE_STRING));
    $priority = trim(filter_var(htmlspecialchars($_POST['priority']), FILTER_SANITIZE_STRING));


    $user_id = (int)$assignTo;
    $logged_In_User = $_SESSION['current_id']; 

    $qStr = "INSERT INTO issues (title,description,type,priority,status,assigned_to,created_by) VALUES ('$title','$descr','$type','$priority','Open',$user_id,$logged_In_User)";

    if ($conn->query($qStr) == TRUE) {

        echo "<script> alert('The Item has been added successfully'); </script>";
        echo "<script> window.location.href = '../main.php'; </script>";


    }
}
else{
    echo "<script> alert('There was an errror processing your request. Ensure all fields have been completed.'); </script>";
    echo "<script> window.location.href = '../create_issue_page'; </script>";
    
    }


// INSERT INTO users(firstname,lastname,password,email) VALUES ('test','test','9u2irhiwhruy43yugyhufnioui ','test@test.com');
// password_verify(current, testpas)
// session_destroy();
?>