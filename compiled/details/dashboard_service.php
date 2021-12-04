<?php
// session_start();
require_once 'config.php';


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";    
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

$ajax_query = $_GET['issue_data'];

// returns selected issue based on the standardised filter options
$issues_query;
switch($ajax_query){

    case 'all':
        $issues_query = $conn->query("SELECT * FROM issues;");
        break;

    case 'open':
        $issues_query = $conn->query("SELECT * FROM issues WHERE status = 'open';");
        break;
    
    case $_SESSION['current_id']:
    $current_user = $_SESSION['current_id'];
    $issues_query = $conn->query("SELECT * FROM issues WHERE assigned_to = $current_user;");
        break;
    default:
        $issues_query = $conn->query("SELECT * FROM issues WHERE 1 = 0;");// select nothing in the query                        
}


$fetched_issues = $issues_query->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <tr>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Assigned To</th>
        <th>Created</th>
    </tr>

    <?php foreach($fetched_issues as $row): ?>
        <tr>
            <td><?=$row['title']?></td>
            <td><?=$row['type']?></td>
            <td><?=$row['status']?></td>
            <td><?=get_username($row['assigned_to'])?></td>
            <td><?=$row['created']?></td>

        </tr>
    <?php endforeach; ?>
</table>


<?php
    function get_username($user_id){
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


?>