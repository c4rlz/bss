<?php
  //DB connection
  function db_connect() {
    static $connection;

    if(!isset($connection)){
      //create connection
       $config = parse_ini_file("../../../con/box_con.ini");
			$connection = mysqli_connect($config['host'],
										 $config["username"],
										 $config["password"],
										 $config["database"]);
      //if connection has failed
      if(!$connection) {
        return mysqli_connect_error();
      }
      else {
        return $connection;
      }
    }
    else {
      return $connection;
    }
  }
  //FUNCTION TO REMOVE MEDIA FROM IMAGES THAT ARE SELECTED
  function removeMedia($img) {
    return str_replace('media/', "", $img);
  }
  //close connection

  function db_close($conn) {
    if($conn) {
      mysqli_close($conn);
    }
  }
?>
