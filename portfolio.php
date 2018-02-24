<?php
  include "db.php";
  include "partials/head.html";
  include "partials/navbar.php";
  db_connect();
 ?>
 </header>
  <div id="main">
    <div class='portfolio-heading' id='portfolio-heading'>
     <h1 class="text-center heading large-heading page-heading"> Our Portfolio </h1>
     <p class="medium-bold italic subhead text-center">We take pride in each project we take on.</p>
     <hr class='styled'>
   </div>


 <main class="flex-container">
   <?php
   if (db_connect()) {
     $query = "SELECT * FROM portfolio_tb";
     $queryResult = mysqli_query(db_connect(), $query);

     mysqli_set_charset(db_connect(), "utf8");

     $numberOfRows = mysqli_num_rows($queryResult);

     if ($numberOfRows > 0 ){
        while($rowArray = mysqli_fetch_assoc($queryResult)) {
          $imgSrc = $rowArray['image'];
          $compName = $rowArray['name'];
          $descript = $rowArray['description'];
          $testimon = $rowArray['testimonial'];
          $link = $rowArray['link'];

          echo "<article class='item-container'>";
            echo "<img class='portfolio-img' src='admin/media/" . $imgSrc . "' alt='" . $compName . $descript . "'>";
              //I want this information to be hidden until hover
              echo "<div class='item-overlay'>";
               echo "<div class='text'>";
               echo "<h2>" . $compName . "</h2>";
               echo "<p>" . $descript . "</p>";
               echo "<a class='btn btn-default' href='" . $link . "'> View Project Details  </a>";
               echo "</div>";
            echo "</div>";

          echo "</article>";
          }
        }
      }
    ?>
  </main>
</div>
  <!-- THIS PAGE WILL BE A MASONRY LAYOUT OF ITEMS THAT ARE STORED IN THE DATABASE
  WITH SECTIONS THAT ARE TESTIMONIALS -->
<?php include "partials/footer.php"; ?>
