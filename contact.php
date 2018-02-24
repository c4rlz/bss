<?php include "partials/head.html";
      include "partials/navbar.php";
      include "db.php";
?>
</header>
<div id="main">
  <main class="full-bg">
    <div class="black-overlay">
      <div class="container">
        <h1 class="text-center heading"> We'd Love To Hear from You</h1>
          <div class="row">
            <?php if(isset($_POST['contact-submit'])){

            $contact = $_POST['contact-name'];
            $email = $_POST['contact-email'];

            $to = $email;
            $subject = "We will be in touch";
            $mailMessage = "Hello " . ucfirst($contact) . ", \r\n\n";
            $mailMessage .= "We received your contact request and will be in touch soon.";
            $mailMessage .= "Regards, Boxspring Studio";
            $headers = "From: harriott@boxspringstudios.com";

            $didItSend = mail($to, $subject, $mailMessage, $headers);

            if($didItSend){
              echo "<p> Success </p>";
            }
            else {
              echo "<p> Error. Try Again Please </p>";
            }
          }
        ?>
        <article class='col-md-6'>
          <div class='contact-box'>
            <h2> Contact Us </h2>
            <form class="contact" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
              <div class="form-group">
                <label for="contact-name" class="control-label">Name</label>';
                <input type="text" name="contact-name" class="form-control" id="contact-name" required>
              </div>
              <div class="form-group">
                <label for="contact-email" class=" control-label">Email</label>';
                <input type="email" name="contact-email" class="form-control" id="contact-email" required>
              </div>
              <input type='submit' name='contact-submit' class='btn btn-primary btn-block' value="submit">
            </form>
            <p class='warn'> * Expect a reply in 3-5 business days </p>
            <p class='text-uppercase'> Email Us : harriot@boxspringstudios.com </p>
            <p class='text-uppercase'> Phone Us : 604 - 555 -5555 </p>
          </div>
        </article>
        <article class="col-md-6">
          <!--CONTACT FORM -->
          <?php
          db_connect();
          if(db_connect()) {

            if(isset($_POST['submit-btn'])){
              $serviceArray = $_POST['services'];
              $totalCost = 0;
              foreach($serviceArray as $service){
                $totalCost = $totalCost + $service;
              }
              // INPUT VALUES FROM FORM
              $name = $_POST['contact-name'];
              $email = $_POST['contact-email'];
              //EMAIL COMPONENTS
              $to = $email;
              $subject = "Your Custom Estimate from Boxspring Studio";
              $mailMessage = "Hello " . ucfirst($name) . ", \r\n\n";
              $mailMessage .= "Based the selection you made on our website, your Project Estimate would be $" . number_format($totalCost) . "\r\n\n";
              $mailMessage .= "Feel free to reply if you are interested in moving forward. \r\n\n";
              $mailMessage .= "Regards, Harriot Soprano";
              $headers = "From: harriott@boxspringstudios.com";

              $didItSend = mail($to, $subject, $mailMessage, $headers);

              if($didItSend){
                echo "<p> Success </p>";
              }
              else {
                echo "<p> Error. Try Again Please </p>";
              }
            }
            $query = "SELECT * FROM services_tb ORDER BY category";
						$queryResult = mysqli_query(db_connect(), $query);

						$numRows = mysqli_num_rows($queryResult);

            if($numRows > 0){
              echo '<div class="accent-container">';
                echo '<h2>Custom Estimate</h2>';
                echo '<h4>Select the requirements that suits your business needs
                and we will e-mail you with a budget estimate</h4>';
                echo '<form action="' . htmlentities($_SERVER['PHP_SELF']) .'" method="POST">';

                $graphicDesignArray = array();
                $printDesignArray = array();
                $strategyArray = array();
                while($rowArray = mysqli_fetch_assoc($queryResult)){
                  $id = $rowArray['id'];
    		          $service = $rowArray['service_name'];
    		          $cost = $rowArray['cost'];
    							$category = $rowArray['category'];

                  //creating different arrays with checkboxes so that I can organize the form based on category
                  if($category == "Graphic Design"){
                    $currentQuery = "<div class='checkbox'><label><input type='checkbox' name='services[]' id='".$id ."' value='".$cost."'>" .$service. "</label> </div>";

                    array_push($graphicDesignArray, $currentQuery);

                  }
                  else if($category == "Print Design"){
                    $currentQuery = "<div class='checkbox'><label><input type='checkbox' name='services[]' id='".$id ."' value='".$cost."'>" .$service. "</label> </div>";

                    array_push($printDesignArray, $currentQuery);

                  }
                  else if($category == "Strategy"){
                    $currentQuery = "<div class='checkbox'><label><input type='checkbox' name='services[]' id='".$id ."' value='".$cost."'>" .$service. "</label></div>";

                    array_push($strategyArray, $currentQuery);

                  }
                }
                echo "<h3> Graphic Design </h3>";
                foreach($graphicDesignArray as $key => $value) {
                  echo $value;
                }
                echo "<h3> Interior Design </h3>";
                foreach($printDesignArray as $key => $value) {
                  echo $value;

                }
                echo "<h3> Strategy  </h3>";
                foreach($strategyArray as $key => $value) {
                  echo $value;
                }

                echo "<h3> Enter Email for Results</h3>";
                echo "<section class='form-inputs'>";
                  echo '<div class="form-group">';
                    echo '<label for="name" class=" control-label">Name</label>';
                    echo '<input type="text" name="contact-name" class="form-control" id="name" required>';
                  echo '</div>';
                  echo '<div class="form-group">';
                    echo '<label for="email" class=" control-label">Email</label>';
                    echo '<input type="email" name="contact-email" class="form-control" id="email" required>';
                  echo '</div>';
                  echo '<input type="submit" name="submit-btn" class="btn btn-default btn-block" value="submit">';
                echo "</section>";
                echo '</form>';
                echo "</div>";
              }
              echo "</div>";

            }
          ?>
          </div>
        </div>
      </article>
    </div>
</main>

<?php include "partials/footer.php" ?>
