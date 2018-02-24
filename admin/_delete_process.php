<?php
//session start
  include "db.php";
  db_connect();

  if(db_connect()) {

    if(isset($_GET['id']) && isset($_GET['tb'])) {
      $id = $_GET['id'];
      $tb = $_GET['tb'];
      $delete = "DELETE FROM " . $tb . " WHERE id ='" . $id . "' LIMIT 1";
      $deleteQuery = mysqli_query(db_connect(), $delete);
      echo $deleteQuery;

      //if delete was successful
      if ($deleteQuery) {
        //send back to cms page
        echo "<script>location.replace('cms.php?delete=".$tb."')</script>";
      }
      else {
        echo $deleteQuery;
      }
    }
  }
  db_close(db_connect());
//delete
?>
