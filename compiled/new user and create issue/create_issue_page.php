

<?php
    session_start();   
if(!isset($_SESSION['current_id'])){
  header("Location: ../main.php");
}

    $root = $_SERVER['DOCUMENT_ROOT'];
    include("$root" . "/info2180-finalproject/compiled/config.php");

    $q = "SELECT * FROM users";
    $fetched = $conn->query($q);
    $cx_data = $fetched->fetchAll(PDO::FETCH_ASSOC);



  function get_cx_name($cx){
    $fname = $cx['firstname'];
    $lname = $cx['lastname'];

    echo $fname." ".$lname;
  }

  function get_cx_id($cx){
    echo $cx['id'];
  }



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="create.css" />
  </head>
  <body>

    <header>
      <img class = "header-img" src="bug_report-white-18dp.svg">
      <h1>BugMe Issue Tracker </h1>
    </header>

  <aside> 
      <div class="sideNav" >
          <ul>
              <div class="info">  
                  <img src="homeIcon.svg">
                  <a href="../main.php">Home</a>
              </div>
              <div class="info">  
                  <img src="userIcon.svg">
                  <a href="newuser.php">Add User</a>
              </div>
              <div class="info">  
                  <img src="issueIcon.svg" class="x">
                  <a href="#">New Issue</a>
              </div>
              <div class="info">  
                  <img src="logIcon.svg">
                  <a href="../logout.php">Logout</a>
              </div>
          </ul>
  </aside>

  <section class="new">
    <h1 class = "issue">Create Issue</h1>
    <form action="create_issue_service.php" method="POST">
      <div>
        <label>Title</label>
        <input type = "text" name = "title" placeholder="">
      </div>

      <div>
        <label>Description</label>
        <textarea name = "description" rows="10" cols="55"></textarea>
      </div>

      <div class="">
      <label for ="assignTo">Assisgned To</label>
        <select name="assignTo">
          <?php foreach($cx_data as $cx):?>
            <option value= <?=get_cx_id($cx)?>><?= get_cx_name($cx)?></option>
          <?PHP endforeach;?>
        </select>
      </div>

      <div>
        <label>Type</label>
        <select name="type">
            <option value="Bug">Bug</option>
            <option value="Proposal">Proposal</option>
            <option value="Task">Task</option>
        </select>
     </div>

      <div>
        <label>Priority</label>
        <select name="priority">
            <option value="major">Major</option>
            <option value="medium">Medium</option>
            <option value="Low">Low</option>
        </select>
      </div>

      <div id="submit">
        <input type= "submit" value="submit">
    </div>
    </form>
  </section>

  </body>

</html>