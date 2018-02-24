<?php
//session start
  include "db.php";
  db_connect();

  //------------UDPATE PORTFOLIO --------//
  //IF USER SUBMITTED INFO TO UDPATE PORTFOLIO
  if(isset($_POST['update-portfolio'])) {

    $id = $_POST['postId'];
    $image = mysqli_real_escape_string(db_connect(), $_POST['image-select']);
    $company = mysqli_real_escape_string(db_connect(), $_POST['company-name']);
    $description = mysqli_real_escape_string(db_connect(), $_POST['description']);
    $testi = mysqli_real_escape_string(db_connect(), $_POST['testimonial']);
    $link = mysqli_real_escape_string(db_connect(), $_POST['link']);
    $details = mysqli_real_escape_string(db_connect(), $_POST['details']);
    $image1 = mysqli_real_escape_string(db_connect(), $_POST['image1-select']);
    $image2 = mysqli_real_escape_string(db_connect(), $_POST['image2-select']);

    $update = "UPDATE portfolio_tb SET image = '".removeMedia($image)."', name= '".$company."', description = '".$description."', testimonial = '".$testi."', link='".$link."', image1 = '".removeMedia($image1)."', image2 = '".removeMedia($image2)."' WHERE id ='".$id."'";
    $updateQuery = mysqli_query(db_connect(), $update);

    if($updateQuery){
      echo "<script>location.replace('cms.php?success=portfolio_tb&id=".$id."')</script>";
    }
  }

  else if (isset($_POST['update-services'])){
    $id = $_POST['postId'];
    $service = $_POST['service'];
    $category = $_POST['category'];
    $cost = $_POST['cost'];

      $update = "UPDATE services_tb SET service_name ='".$service."', cost = '" . $cost ."', category = '".$category."'WHERE id='" .$id. "'";

      $updateQuery = mysqli_query(db_connect(), $update);

      if($updateQuery){
        echo "<script>location.replace('cms.php?success=services_tb&id=".$id."')</script>";
      }

  }





 ?>
