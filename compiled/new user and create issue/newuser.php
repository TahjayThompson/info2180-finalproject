<!-- DEBUGGING MODE -->
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<!-- END OF DEBUGGING MODE -->





<?php session_start();?>

<!-- Enable once admin login has been activated -->
<?php
  // if(!isset($_SESSION['admin'])){
    // header("Location: ../main.php");
  // }
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
                  <a href="#">Add User</a>
              </div>
              <div class="info">  
                  <img src="issueIcon.svg" class="x">
                  <a href="create_issue_page.php">New Issue</a>
              </div>
              <div class="info">  
                  <img src="logIcon.svg">
                  <a href="../logout.php">Logout</a>
              </div>
          </ul> 
  </aside>

  <section class="new">
    <h1 class = "new-user">New User</h1>
    <form action="newuser_service.php" method="POST">
      
      <div>
        <label>Firstname</label>
        <input type = "text" name = "fname" required>
      </div>

      <div>
        <label>Lastname</label>
        <input type = "text" name = "lname" required>
      </div>


      <div>
        <label>Email</label>
        <input type = "email" name = "email" required>
      </div>

      <div>
        <label>Password</label>
        <input type = "password" name = "password" required>
      </div>


      <div id="submit">
        <input type= "submit" value="submit" required>
    </div>
    </form>
  </section>

  </body>

</html>