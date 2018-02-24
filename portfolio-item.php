<?php include "partials/head.html";
      include "partials/navbar.php";
      include "db.php";
?>
<div id="main">
  <div class="container-fluid">
    <?php if (isset($_GET['id'])) {
      $pId = $_GET['id'];
      $query = "SELECT * FROM portfolio_tb WHERE id = '".$pId."'";
      $queryResult = mysqli_query(db_connect(), $query);
      $numRows = mysqli_num_rows($queryResult);

    if($numRows > 0) {
        while($rowArray = mysqli_fetch_assoc($queryResult)){
          $id = $rowArray['id'];
          $image = $rowArray['image'];
          $name = $rowArray['name'];
          $testimonial = $rowArray['testimonial'];
          $description = $rowArray['description'];
          $details = $rowArray['details'];
          $image1 = $rowArray['image1'];
          $image2 = $rowArray['image2'];
          //LARGE IMAGE OF WORK
          echo "<section class='row'>";
            echo '<article class="col-md-8">';
              echo '<div class="service-cover">';
                echo '<img class="service-img img-responsive" src="admin/media/'.$image1.'" alt="An image of the project we did for '.$name.'">';
              echo '</div>';
            echo '</article>';
            //DESCRIPTION OF WORK
            echo '<article class="col-md-4">';
              echo '<div class="page-descript">';
                echo '<h1>'.$name.'</h1>';
                echo '<p class="italic bold">'.$description .'</p>';
                echo '<p>'. $details .'</p>';
              echo '</div>';
            echo '</article>';
          echo "</section>";
        echo "</div>"; //END OF CONTAINER FLUID
          echo "<div class='container'>";
          echo "<section class='row'>";
            echo '<article class="col-md-4 col-md-offset-1">';
            //TESTIMONIAL
              echo '<div class="testimonial-section">';
                echo '<h1>Project Testimonial</h1>';
                echo '<p class="italic bold"> What '.$name.' Thought of Working with Boxspring Studio</p>';
                echo '<p>'. $testimonial.'</p>';
              echo '</div>';
            echo '</article>';
            //SECOND IMAGE OF WORK
            echo '<article class="col-md-6 col-md-offset-1">';
              echo '<div class="service-cover">';
                echo '<img class="service-img img-responsive center-block" src="admin/media/'.$image2.'" alt="An image of the project we did for '.$name.'">';
              echo '</div>';
            echo '</article>';
          echo "</section>";
          }
        }
      }
    ?>
    <article class='banner stand-out'>
        <div class='text-center'>
          <h1> View More Projects </h1>
          <a href='portfolio.php' class='btn btn-default text-center'> Go back </a>
        </div>
      </article>
  </div>
<?php include "partials/footer.php" ;?>
