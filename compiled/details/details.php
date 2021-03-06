

<?php
    session_start();

    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root" . "/info2180-finalproject/compiled/config.php");

    $id = filter_var($_GET['id'],FILTER_SANITIZE_STRING) ;

    $q = "SELECT * FROM issues WHERE id = $id;";
    $fetched = $conn->query($q);
    $arr = $fetched->fetchAll(PDO::FETCH_ASSOC);
    $issue = $arr[0];
    // var_dump($issue);


    function get_name($id){
        $root = $_SERVER['DOCUMENT_ROOT'];
        include("$root" . "/info2180-finalproject/compiled/config.php");

        // $createdID = $is['created_by'];
        $nme = "SELECT firstname,lastname FROM users WHERE id = $id;";
        $retrived = $conn->query($nme);
        $names = $retrived->fetchAll(PDO::FETCH_ASSOC);
        echo $names[0]['firstname']." ".$names[0]['lastname'];

    }

    function get_date($str){
        $date = explode(" ",$str)[0];

        return $date;

    }



?>

<!DOCTYPE html>

<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie = edge">

        <link href = "styles.css" rel = "stylesheet" type = "text/css">
        <link href = "details_styles.css" rel = "stylesheet" type = "text/css">

        <script src = "https://kit.fontawesome.com/bd35384d11.js" crossorigin = "anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src = "script.js"></script>

        <title>Details</title>
    </head>

    
    <body>
        <header>
            <img src = "logo.png" alt = "BugMe Isue Tracker logo">
            <h1>BugMe Issue Tracker</h1>
        </header>
        
        <main>
            <aside id = "sidebar">
                <nav>
                    <ol>
                        <li><a href = "../main.php"> <i class = "fas fa-home"> Home</i></a></li>
                        <li><a href = "../new user and create issue/newuser.php"> <i class = "fas fa-user-plus"> Add User</i></a></li>
                        <li><a href = "../new user and create issue/create_issue_page.php"> <i class = "fas fa-plus-circle"> New Issue</i></a></li>
                        <li><a href = "../logout.php"> <i class = "fas fa-power-off"> Logout</i></a></li>
                    </ol>
                </nav>
            </aside>

            <div id = "main">
                <h1 id = "title"><?=$issue['title']?></h1>

                <h4 id = "id">Issue  #<?=$issue['id']?></h4>

                <div id = "details">
                    <div>
                        <p id = "description"><?=$issue['description']?></p>

                        <ul>
                            <li><p id = "created"> Issue created on <?=date("F jS, Y", strtotime(get_date($issue['created'])));?> at <?=date('h:i A', strtotime($issue['created']));?> by <?=get_name($issue['created_by']);?> </p></li>
                            <li><p id = "updated"> Last updated on <span id = "date"> <?=date("F jS, Y", strtotime(get_date($issue['updated'])));?> </span>  at <span id= "time"> <?=date('h:i A', strtotime($issue['updated']));?> </span> </p></li>
                        </ul>
                    </div>
                    
                    <aside>
                        <div id = "other">
                            <div id = "assigned_to">
                                <h5>Assigned To:</h5>
                                <p><?=get_name($issue['assigned_to']);?></p>
                            </div>
        
                            <div id = "type">
                                <h5>Type:</h5>
                                <p><?=$issue['type']?></p>
                            </div>
        
                            <div id = "priority">
                                <h5>Priority:</h5></h>
                                <p><?=$issue['priority']?></p>
                            </div>
        
                            <div id = "status">
                                <h5>Status:</h5>
                                <p><?=$issue['status']?></p>
                            </div>
                        </div>
        
                        <button id = "<?=$id?>" class = "closed"> Mark as Closed</button>
                        <button id = "<?=$id?>" class = "progress"> Mark in Progress</button>
                    </aside>
                </div>
            </div>
        </main>
    </body>
</html>