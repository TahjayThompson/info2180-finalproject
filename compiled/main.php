<!-- DEBUGGING MODE -->
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING MODE -->



<?php
    session_start();   
    if(!isset($_SESSION['current_id'])){
    header("Location: index.html");
  }


  function get_username($user_id){
    include 'config.php';
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $name =$conn->query("SELECT firstname,lastname FROM users WHERE id = $user_id;");
    $names_fetched = $name->fetchAll(PDO::FETCH_ASSOC);
    $fname;
    $lname;
    foreach($names_fetched as $single){
        $fname = $single['firstname'];
        $lname = $single['lastname'];
    }
    return $fname." ".$lname;
}

require_once 'config.php';

$current_user = $_SESSION['current_id'];
$issues_query = $conn->query("SELECT * FROM issues;");

$fetched_issues = $issues_query->fetchAll(PDO::FETCH_ASSOC);
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="home_styles.css" />
    <script src="script.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <body>
        <header>
            <img class = "header-img" src="bug_report-white-18dp.svg">
            <title>Issues</title>
            <h1>BugMe Issue Tracker </h1>
        </header>
        <aside> 
            <div class="sideNav">
                <ul>
                    <div class="info">  
                        <img src="homeIcon.svg">
                        <a href="#">Home</a>
                    </div>
                    <div class="info">  
                        <img src="userIcon.svg">
                        <a href="./new user and create issue/newuser.php">Add User</a>
                    </div>
                    <div class="info">  
                        <img src="issueIcon.svg">
                        <a href="./new user and create issue/create_issue_page.php">New Issue</a>
                    </div>
                    <div class="info">  
                        <img src="logIcon.svg">
                        <a href="logout.php">Logout</a>
                    </div>
                </ul>
        </aside>

        <section class = "add-issue">
            <h1 class="issue">Issues</h1>
            <div class="submit">
                <button id="createIssue" onclick = "window.location.href = 'new user and create issue/create_issue_page.php';">Create New Issue</button>
                <!-- <input type= "submit" id= "createIssue"  value = "Create New Issue"> -->
            </div>
        </section>
        
        <div id="filter-by"> 
            <p> 
                <span><h1>Filter by: </h1></span>
                <button id="all" class="selected"> All</button>
                <button id="open"> OPEN </button>
                <button id="all-t"> MY TICKETS</button>
            </p>
        </div>

        <div id="result" >
        <table class="issueTable">
    <thead>
        <tr id="heading1">
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Created</th>
        </tr>
</thead>

    <?php foreach($fetched_issues as $row): ?>
        <tr class ="row">
            <td><b>#<?=$row['id']?></b> <a href="details/details.php?id=<?=$row['id']?>" class="link"><?=$row['title']?></a></td>
            <td><?=$row['type']?></td>
            <td><?=$row['status']?></td>
            <td><?=get_username($row['assigned_to'])?></td>
            <td><?=explode(" ", $row['created'])[0]?></td>
        </tr>
    <?php endforeach; ?>
</table>
            
        </div>


    </body>
</html>