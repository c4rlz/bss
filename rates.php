<?php include "partials/head.html";
      include "partials/navbar.php";
      include "db.php";
?>
</header>
<div id='main'>
  <main class='container'>
    <h1 class="heading">We know that every business is different.</h1>
    <p class="medium-bold italic subhead">We offer a variety of options to suit each individual business' needs.</p>
    <section class="row packages">
      <article class="col-md-6">
        <div class="dark-container">
        <h2>Compare our Rate Packages</h2>
        <div class="table-responsive">
          <table class="table table-bordered ">
            <tr>
              <th>Deliverables</th><th>Graphic Design</th> <th>Full Branding </th>
            </tr>
            <tr>
              <td>Logo</td><td><img class='check' src='img/white-check.png' alt='a white checkmark'></td><td><img class='check' src='img/white-check.png' alt='a white checkmark'></td>
            </tr>
            <tr>
              <td>Website</td><td><img class='check' src='img/white-check.png' alt='a white checkmark'></td><td><img class='check' src='img/white-check.png' alt='a white checkmark'></td>
            </tr>
            <tr>
              <td>Stationary</td><td>-<td><img class='check' src='img/white-check.png' alt='a white checkmark'></td>
            </tr>
            <tr>
              <td>Interior Design</td><td> - </td><td><img class='check' src='img/white-check.png' alt='a white checkmark'></td>
            </tr>
            <tr>
              <td>Signage</td><td> - <td><img class='check' src='img/white-check.png' alt='a white checkmark'></td>
            </tr>
            <tr>
              <td>Business Analysis</td><td> - <td><img class='check' src='img/white-check.png' alt='a white checkmark'></td>
            </tr>
            <tr>
              <td>Brand Strategy</td><td> - <td><img class='check' src='img/white-check.png' alt='a white checkmark'></td>
            </tr>
          </table>
        </div>
      </div>
      <br>
    </article>
    <article class="col-md-6">
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
              echo '<input type="submit" name="submit-btn" class="btn btn-default btn-block" value="Request Estimate">';
            echo "</section>";
            echo '</form>';

          }
          echo "</div>";
        }
      ?>
      </article>
  </section>
  </main>
</div>
<section class="dark-section text-center">
  <h2>Need more? Contact us for add ons!</h2>
  <a href="contact.php" class='btn btn-primary btn-lg'>Contact</a>
</section>
<?php include "partials/footer.php" ?>
