<?php
    require('config.php');
    if(isset($_POST['closed'])){
        $id = $_POST['closed'];
        $q = "UPDATE issues SET status = 'closed', updated = NOW() WHERE id = $id;";
        if($conn->query($q)){

            $qry = "SELECT updated FROM issues WHERE id = $id;";
            $fetched = $conn->query($qry);
            $arr = $fetched->fetchAll(PDO::FETCH_ASSOC);
            $issue = $arr[0];
            $date = explode(" ",$issue['updated'])[0];
            $time = explode(" ",$issue['updated'])[1];
            $dp = date("F jS, Y", strtotime($date));
            $tp = date('h:i A', strtotime($time));

            $obj = array("dt" => $dp, "te"=> $tp);

            echo $dp."+". $tp;
            
        }
        else{
            echo "Failed to update issue";

        }

    }

    if(isset($_POST['progress'])){
        $id = $_POST['progress'];
        $q = "UPDATE issues SET status = 'In Progress', updated = NOW() WHERE id = $id;";
        if($conn->query($q)){
            
            $qry = "SELECT updated FROM issues WHERE id = $id;";
            $fetched = $conn->query($qry);
            $arr = $fetched->fetchAll(PDO::FETCH_ASSOC);
            $issue = $arr[0];
            $date = explode(" ",$issue['updated'])[0];
            $time = explode(" ",$issue['updated'])[1];
            $dp = date("F jS, Y", strtotime($date));
            $tp = date('h:i A', strtotime($time));

            $obj = array("dt" => $dp, "te"=> $tp);

            echo $dp."+". $tp;

        }
        else{
            echo "Failed to update issue";

        }

    }

    

?>