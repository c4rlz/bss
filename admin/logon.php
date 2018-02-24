<?php session_start();
  include "db.php";
  include "partials/head.html";
?>
<main class="container">
  <h1> Welcome to Your Admin Page </h1>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Name</label>
    <div class="col-sm-10">
      <input type="text" name='uName' class="form-control" id="name" placeholder="Enter Username">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10">
      <input type="password" name="pWord" class="form-control" id="pwd" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name='submit' class="btn btn-default btn-block" value="Sign In">
    </div>
    <?php
      if(isset($_POST['submit']) && !empty($_POST['uName']) && !empty($_POST['pWord'])) {
        db_connect();

        if(!db_connect()) {
            die("<p>Connection error " . db_connect() . "</p>");
        }
        else {
            //create variables for username and password that user inputted
            $userName = mysqli_real_escape_string(db_connect(), $_POST['uName']);
            $pW =  mysqli_real_escape_string(db_connect(), $_POST['pWord']);

//             $selectQuery = 'SELECT * FROM user_tb WHERE user = "'.$userName.'" AND pWord = "'.$pW.'"';
             $selectQuery = "SELECT * FROM user_tb
                             WHERE user ='".$userName."'
                             AND pWord ='".$pW."'";

            $selectQueryResult = mysqli_query(db_connect(), $selectQuery);

            $numOfRows = mysqli_num_rows($selectQueryResult);

            if($numOfRows == 1) {
                //username and password are correct, create a session for username
                $_SESSION['userName'] = $userName;
                //redirect user to the user-page
                echo "<script> location.replace('cms.php')</script>";
            }
            else {
                echo "<p>User name or Password was Incorrect, Please Try Again!</p>";
            }
        }
      }
    ?>
  </div>
</form>
</main>
<?php include "partials/footer.php" ?>
