<!-- DEBUGGING MODE -->
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING MODE -->

<?php
    require('config.php');

    if(isset($_POST['closed'])){
        $id = $_POST['closed'];
        $q = "UPDATE issues SET status = 'closed', updated = NOW() WHERE id = $id;";
        if($conn->query($q)){
            echo "Issue updated";
        }
        else{
            echo "Failed to update issue";

        }

    }

    if(isset($_POST['progress'])){
        $id = $_POST['progress'];
        $q = "UPDATE issues SET status = 'In Progress', updated = NOW() WHERE id = $id;";
        if($conn->query($q)){
            echo "Issue updated";

        }
        else{
            echo "Failed to update issue";

        }

    }

    

?>