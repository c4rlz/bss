<?php
	// Check if image file is a actual image or fake image
	if(isset($_POST["upload"])) {

		$target_dir = "img_folder/";
		$target_file = $target_dir . basename($_FILES["uploaded_image"]["name"]);
		$uploadGood = true;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

		// Check if file is an image
		////////////////////////////
	    $check = getimagesize($_FILES["uploaded_image"]["tmp_name"]);
	    if($check !== true) {
	        echo "<p class='good'>File is an image - " . $check["mime"] . ".</p>";
	    }
	    else {
	        echo "<p class='bad'>FAILED - File is not an image.</p>";
	        $uploadGood = false;
	    }

	    // Check if file already exists
	    ///////////////////////////////
		if (file_exists($target_file)) {
		    echo "<p class='bad'>FAILED - File already exists.</p>";
		    $uploadGood = false;
		}
		else {
			echo "<p class='good'>File does not already exist on directory.</p>";
		}

		// Check file size
		///////////////////////////////
		if ($_FILES["uploaded_image"]["size"] > 5000000) {
		    echo "<p class='bad'>FAILED - Your image is too large.</p>";
		    $uploadGood = false;
		}
		else {
			 echo "<p class='good'>File is correct size.</p>";
		}

		// Allow certain file formats ''
		////////////////////////////////
		if($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif" ) {
		    echo "<p class='bad'>FAILED - Image was not JPG, JPEG, PNG or GIF.</p>";
		    $uploadGood = false;
		}
		else {
			 echo "<p class='good'>File has correct extension.</p>";
		}

		// Final Test
		// Check if file will be uploaded
		if ($uploadGood == false) {
		    echo "<p class='bad'>FILE NOT UPLOADED - Failed tests.</p>";
		}
		else {
			// If everything is ok, try to upload file
			echo "<p class='good'>File has passed all tests.</p>";

		    if (move_uploaded_file($_FILES["uploaded_image"]["tmp_name"], $target_file)) {

		        echo "<p class='good'>The file ". basename( $_FILES["uploaded_image"]["name"]). " has been uploaded.</p>";
		        echo "<img src='" . $target_file . "' />";
		        header("location: insert_admin.php");
		    }
		    else {
		        echo "<p class='bad'>IMAGE UPLOAD FAILED.</p>";
		    }
		}
	}
	else {
		echo "<p>Error on Submit</p>";
	}
?>
