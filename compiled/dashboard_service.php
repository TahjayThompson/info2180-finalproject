<!-- DEBUGGING MODE -->
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING MODE -->


<?php
session_start();

require_once 'config.php';


// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
   
// } catch (PDOException $pe) {
//     die("Could not connect to the database $dbname :" . $pe->getMessage());
// }

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
    
    default:
    $current_user = $_SESSION['current_id'];
    $issues_query = $conn->query("SELECT * FROM issues WHERE assigned_to = $current_user;");
}


$fetched_issues = $issues_query->fetchAll(PDO::FETCH_ASSOC);
?>

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


<?php
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

?>

