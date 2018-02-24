<?php
	session_start();
	include "partials/head.html";
	include "db.php";
	//first check to see if user has pressed logout or if there is no session created
		if(isset($_GET['logOut']) || !isset($_SESSION['userName'])) {
			session_unset();
			session_destroy();
			//send user back to login password_get_info
			echo "<script>location.replace('logon.php')</script>";
		}
?>
<body class="container">
	<a href="cms.php?changePassword" class='btn btn-success'>Change Password</a>
	<a href="cms.php?logOut" class='btn btn-warning text-left'>Log Out</a>
	<h1 class='text-center'> Welcome to your CMS </h1>

		<?php
			db_connect();
			//CONFIRM DELETE OF EITHER TABLE
			if(isset($_GET['delete'])){
				$deleted = $_GET['delete'];
				if($deleted === "portfolio_tb") {
					$table = "Portfolio";
				}
				else {
					$table = "Services";
				}
				echo "<p class='alert alert-success'>".$table." Item has Successfully Been Deleted </p>";
			}
			//IF CREATE SERVICE BUTTON HAS BEEN PRESSED, INSERT VALUES INTO DB
			if(isset($_POST['create-service'])) {
				$service = mysqli_real_escape_string(db_connect(), $_POST['service']);
				$category = mysqli_real_escape_string(db_connect(), $_POST['category']);
				$cost = mysqli_real_escape_string(db_connect(), $_POST['cost']);

				$insert = "INSERT INTO services_tb (service_name, cost, category) VALUES ('". $service ."','". $cost."','".$category."')";

				$insertQuery = mysqli_query(db_connect(), $insert);

				if($insertQuery) {
					echo "<p class='alert alert-success'> Insert To Services was successful </p>";
				}

				else {
					echo "<p class='alert alert-warning'> Insert To Services was unsuccessful </p>";
				}
			}
			if(db_connect()){
				mysqli_set_charset(db_connect(), "utf8");
				//IF THE PORTFOLIO ITEM CREATION FORM WAS SENT
				if(isset($_POST['create-portfolio'])){
					// $id = intval($_POST['id']);
					$image = mysqli_real_escape_string(db_connect(), $_POST['image-select']);
					$company = mysqli_real_escape_string(db_connect(), $_POST['company-name']);
					$description = mysqli_real_escape_string(db_connect(), $_POST['description']);
					$testi = mysqli_real_escape_string(db_connect(), $_POST['testimonial']);
					$link = mysqli_real_escape_string(db_connect(), $_POST['link']);
					$details = mysqli_real_escape_string(db_connect(), $_POST['details']);
					$image1 = mysqli_real_escape_string(db_connect(), $_POST['image1-select']);
					$image2 = mysqli_real_escape_string(db_connect(), $_POST['image2-select']);

					$insert = "INSERT INTO portfolio_tb (image, name, description, testimonial, link, details, image1, image2) VALUES ('". removeMedia($image)."', '".$company."', '".$description."', '".$testi."', '".$link."', '".$details."', '".$image1."', '". $image2 ."')";

					$insertQuery = mysqli_query(db_connect(), $insert);

					if($insertQuery){
						echo "<p class='alert alert-success'>Portfolio Item has Successfully Been Added </p>";
					}
				}
				//GET THE USER TO SELECT WHICH TABLE THEY WOULD LIKE TO EDIT
				echo "<div class='user-select'>";
					echo "<h2 class='text-center'> Which page would you like to edit? </h2>";
					echo "<form action='".htmlentities($_SERVER["PHP_SELF"])."' method='GET'>";
						echo "<select name='table-select'>";
							echo "<option value='portfolio_tb'>Portfolio Page </option>";
							echo "<option value='services_tb'> Service Page </option>";
						echo "</select>";
						echo "<select name='action-select'>";
							echo "<option value='update_existing'>Update Existing</option>";
							echo "<option value='new_post'>Create New </option>";
						echo "</select>";
						echo "<input class='btn btn-primary btn-block' type='submit' name='submit-which-table' value='Start'>";
					echo "</form>";
				echo "</div>";
				//IF USER PRESSES BUTTON TO CHANGE PASSWORD
				if(isset($_GET['changePassword'])){
					echo "<form action ='" . htmlentities($_SERVER["PHP_SELF"])."'; method='POST'>";

					echo "<div class='form-group'>";
						echo "<label class='control-label' for='current-password'>Current Password</label>";
						echo "<input class='form-control' type='password' id='current-password' name='current-password' placeholder='Enter Current Password' required>";
					echo "</div>";

					echo "<div class='form-group'>";
						echo "<label class='control-label' for='new-password1'>New Password</label>";
						echo "<input class='form-control' type='password' name='new-password1 id='new-password1' placeholder='Enter new password' required>";

					echo "<div class='form-group'>";
						echo "<label class='control-label' for='new-password2'>Confirm New Password</label>";
						echo "<input class='form-control' type='password' name='new-password2 id='new-password2' placeholder='Re-Enter new password' required>";
					echo "</div>";

					echo "<input type='submit' name='pw-change' value='change password' class='btn btn-block'>";
					echo "</form>";
				}

				if(isset($_POST['pw-change'])) {
					// if the current password matches the password that is in the tb
					$curPw = $_POST['current-password'];
					$selectQuery = "SELECT * FROM user_tb WHERE pWord = '".$curPw."'";
					$selectResult = mysqli_query(db_connect(), $selectQuery);

					if($selectResult){ 
						$pw = $_POST['new-password1'];
						$pw2 = $_POST['new-password2'];
						if ($pw === $pw2){
							$update = "UPDATE user_tb SET pWord = $pw2";
							echo "<p class='alert alert-success'>Your password has been successfully changed </p> ";
						}
					}

				    else {
					   echo "<p class='alert alert-warning'>Please try again </p>";
				    }
			     }

				if(isset($_GET['submit-which-table'])){
					//get the value of the select box
					$tableOpt = $_GET['table-select'];
					//does user want to update or create new
					$actionOpt = $_GET['action-select'];
					//echo out portfolio table if they select portfolio
					if($tableOpt === "portfolio_tb"){
						//IF USER DECIDES TO UPDATE EXISTING
						if ($actionOpt ==="update_existing"){
							echo "<h1> Update Portfolio Content </h1>";
							$query = "SELECT * FROM portfolio_tb";

							$queryResult = mysqli_query(db_connect(), $query);

							$numRows = mysqli_num_rows($queryResult);

							if ($numRows > 0) {
								echo "<table class='table'>";
								echo "<tr><th>ID </th><th>Image</th><th>Name</th><th>Description</th><th>Testimonial</th><th>Link</th><th>Details</th><th>Image1</th><th>Image2</th><th>Edit</th><th>Delete</th></tr>";

								while($rowArray = mysqli_fetch_assoc($queryResult)){

									$id = $rowArray['id'];
									$image = $rowArray['image'];
									$name = $rowArray['name'];
									$description = $rowArray['description'];
									$testimonial = $rowArray['testimonial'];
									$link = $rowArray['link'];
									$details = $rowArray['details'];
									$image1 = $rowArray['image1'];
									$image2 = $rowArray['image2'];

									echo "<tr>";
										echo "<td>" . $id . "</td>";
										echo "<td><img class='thumbnail' src='media/". $image  ."' alt='An image of " . $name ."'></td>";
										echo "<td>" . $name . "</td>";
										echo "<td>" . $description. "</td>";
										echo "<td>" . $testimonial ."</td>";
										echo "<td>" . $link ."</td>";
										echo "<td>" . $details ."</td>";
										echo "<td><img class='thumbnail' src='media/". $image1  ."' alt='An image of " . $name ."'></td>";
										echo "<td><img class='thumbnail' src='media/". $image2  ."' alt='An image of " . $name ."'></td>";
										echo "<td><a href='cms.php?id=".$id."&tb=portfolio_tb' class='btn btn-default'> Edit </a></td>";
										echo "<td><a id='btn-".$id."' data-link='_delete_process.php?id=".$id."&tb=portfolio_tb' class='btn btn-warning delete-btn'>Delete</a></td>";
										echo "<td></td>";
									echo "</tr>";
								}
								echo "</table><br>";
						}
					}
					else {
						echo "<h1> Create New Portfolio Content </h1>";
						echo "<form action='cms.php' method='POST'>";
						//USER WANTS TO ADD ANOTHER POST INTO PORTFOLIO
							echo "<img class='thumbnail' id='show-img' src='media/mighty-quinns.jpg'>";
							echo "<div class='form-group'>";
								echo "<label class='control-label' for='image-select'>Image Select</label>";
								echo "<select name='image-select' class='image-select' id='image-select'>";
									foreach(glob("media/*['.jpg, .png, .jpeg]") as $img){
										$imageName = ltrim($img, "media/");
										echo "<option value='".$img."' selected> ".$imageName." </option>";
									}
								echo "</select>";
							echo "</div>";
							//add jquery to show the image that is selected
							echo "<div class='form-group'>";
								echo "<label class='control-label' for='company-name'>Company Name</label>";
								echo "<input class='form-control' type='text' id='company-name' name='company-name' placeholder='Company Name' required>";
							echo "</div>";
							echo "<div class='form-group'>";
								echo "<label class='control-label' for='description'>Project Description</label>";
								echo "<input class='form-control' type='text' name='description' id='description' placeholder='Project Description' required>";
						echo "</div>";
						echo "<div class='form-group'>";
							echo "<label class='description' for='testimonial'>Testimonial</label>";
							echo "<textarea class='form-control' type='text' name='testimonial' id='testimonial' placeholder= 'Project Testimonials'></textarea>";
						echo "</div>";
						echo "<div class='form-group'>";
                            //wasn't sure how to make this so that it uses the id for get request
							echo "<label class='link' for='company-name'>Link</label>";
							echo "<input class='form-control' type='text' id='link' name='link' placeholder='Project Link' required>";
						echo "</div>";
					echo "<div class='form-group'>";
						echo "<label class='control-label' for='details'>Details</label>";
						echo "<input class='form-control' type='text' id='details' name='details' placeholder='Project Details'>";
					echo "</div>";
					//SELECT FOR THE IMAGES THAT WILL POPULATE PORTFOLIO - ITEM PAGE
					echo "<img class='thumbnail' id='show-img1' src='media/mighty-quinns.jpg'>";
					echo "<div class='form-group'>";
						echo "<label class='control-label' for='image1-select'>Image Select</label>";
						echo "<select name='image1-select' class='image-select' id='image1-select'>";
							foreach(glob("media/*['.jpg, .png, .jpeg]") as $img){
								$imageName = substr($img, 6);
								echo "<option value='".$imageName."' selected> ".$imageName." </option>";
							}
						echo "</select>";
					echo "</div>";
					echo "<img class='thumbnail' id='show-img2' src='media/mighty-quinns.jpg'>";
					echo "<div class='form-group'>";
						echo "<label class='control-label' for='image2-select'>Image Select</label>";
						echo "<select name='image2-select' class='image-select' id='image2-select'>";
							foreach(glob("media/*['.jpg, .png, .jpeg]") as $img){
								$imageName = substr($img, 6);
								echo "<option value='".$imageName."' selected> ".$imageName." </option>";
							}
						echo "</select>";
					echo "</div>";
					echo "<input class='btn btn-default' type='submit' name='create-portfolio' value='submit'>";
			echo "</form>";

					}
				}
					//IF USER SELECTS THE SERVICE TABLE
					else if($tableOpt === "services_tb"){

						if($actionOpt === "update_existing") {
							echo "<h1> Update Services Page </h1>";
							//create pagination for this eventually
							$query = "SELECT * FROM services_tb";
							$queryResult = mysqli_query(db_connect(), $query);

							$numRows = mysqli_num_rows($queryResult);

							if ($numRows > 0) {
								echo "<table class='table'>";
								echo "<tr><th>ID </th><th>Service</th><th>Cost</th><th>Category</th><th>Edit</th><th>Delete</th></tr>";

								while($rowArray = mysqli_fetch_assoc($queryResult)){

									$id = $rowArray['id'];
									$service = $rowArray['service_name'];
									$cost = $rowArray['cost'];
									$category = $rowArray['category'];

									echo "<tr>";
										echo "<td>" . $id . "</td>";
										echo "<td>" . $service . "</td>";
										echo "<td>" . number_format($cost). "</td>";
										echo "<td>" . $category . "</td>";
										echo "<td><a href='cms.php?id=".$id."&tb=services_tb' class='btn btn-default'> Edit </a></td>";
										echo "<td><a id='btn-".$id."' data-link='_delete_process.php?id=".$id."&tb=services_tb' class='btn btn-warning delete-btn'>Delete</a></td>";
										echo "<td></td>";
									echo "</tr>";
								}
								echo "</table><br>";
							}
						}
					else {
						//USER WANTS TO ENTER A NEW SERVICE
						echo "<form action='cms.php' method='POST'>";
						echo "<h1> Create New Service Entry </h1>";
						echo "<div class='form-group'>";
							echo "<label class='control-label' for='service'>Service</label>";
							echo "<input class='form-control' type='text' id='service' name='service' placeholder='Example Service' required>";
						echo "</div>";

						echo "<select name='category' class='category-select'>";
							echo "<option value='Graphic Design'>Graphic Design</option>";
							echo "<option value='Print Design'>Print Desing</option>";
							echo "<option value='Strategy'>Strategy</option>";
						echo "</select>";

						echo "<div class='form-group'>";
							echo "<label class='control-label' for='cost'>Cost -numbers only-</label>";
							echo "<input class='form-control' type='text' name='cost' id='cost' required placeholder='100000'>";
						echo "</div>";

						echo "<input class='btn btn-default' type='submit' name='create-service' value='submit'>";
					}
				}
			}
			echo "</form>";
		}
			//IF USER CLICKS ON THE UPDATE BUTTON
			if (isset($_GET['id']) && isset($_GET['tb'])){
		    $table = $_GET['tb'];
		    $id = $_GET['id'];
		    //create a form which will be populated with table information
		    echo "<form action='_edit_process.php' method='POST' class='form-horizontal'>";
		    //-----------PORTFOLIO UPDATE FORM ------------------*/
		    if($table === "portfolio_tb"){
					echo "<h1> Update Portfolio Item #" . $id . "</h1>";
		      $query = "SELECT * FROM portfolio_tb WHERE id='" . $id ."'";
		      $queryResult = mysqli_query(db_connect(), $query);
		      $numOfRows = mysqli_num_rows($queryResult);

		      if($numOfRows > 0){
		        while($rowArray = mysqli_fetch_assoc($queryResult)){
		          $id = $rowArray['id'];
		          $image = $rowArray['image'];
		          $name = $rowArray['name'];
		          $description = $rowArray['description'];
		          $testimonial = $rowArray['testimonial'];
		          $link = $rowArray['link'];
							$details = $rowArray['details'];
							$image1 = $rowArray['image1'];
							$image2 = $rowArray['image2'];
		          echo "<input type='hidden' name='postId' value='".$id."'>";
							echo "<img id='show-img' src='media/".$image."'>";
							echo "<div class='form-group'>";
								echo "<label class='control-label' for='image-select'>Image Select</label>";
			          echo "<select name='image-select' class='image-select' id='image-select'>";


			            foreach(glob("media/*['.jpg, .png, .jpeg]") as $img){
										$imageName = substr($img, 6);
			                if($imageName === $image){
                                      echo "<option value='".$imageName."' selected>".$imageName."</option>";
                                    }
                                    else {
									  echo "<option value='".$imageName."'>".$imageName. "</option>";
                                    }
			            }
			          echo "</select>";
							echo "</div>";
							echo "<div class='form-group'>";
								echo "<label class='control-label' for='company-name'>Company Name</label>";
			          echo "<input class='form-control' type='text' id='company-name' name='company-name' value='".$name."'>";
							echo "</div>";
							echo "<div class='form-group'>";
								echo "<label class='control-label' for='description'>Project Description</label>";
								echo "<input class='form-control' type='text' name='description' id='description' value='".$description."'>";
						echo "</div>";
						echo "<div class='form-group'>";
							echo "<label class='description' for='testimonial'>Testimonial</label>";
						  echo "<textarea class='form-control' type='text' name='testimonial' id='testimonial'>".$testimonial."</textarea>";
						echo "</div>";
						echo "<div class='form-group'>";
							echo "<label class='control-label' for='link'>Link</label>";
							echo "<input class='form-control' type='text' id='link' name='link' value='".$link."'>";
						echo "</div>";
						//DESCRIPTION JUST FOR PORTFOLIO - ITEM PAGE
						echo "<div class='form-group'>";
							echo "<label class='control-label' for='details'>Details</label>";
							echo "<input class='form-control' type='text' id='details' name='details' value='".$details."'>";
						echo "</div>";
						//SELECT FOR THE IMAGES THAT WILL POPULATE PORTFOLIO - ITEM PAGE
						echo "<img id='show-img1' src='media/".$image1."'>";
						echo "<div class='form-group'>";
							echo "<label class='control-label' for='image1-select'>Image Select</label>";
							echo "<select name='image1-select' class='image-select' id='image1-select'>";

								foreach(glob("media/*['.jpg, .png, .jpeg]") as $img){
									$imageName = substr($img, 6);
									  if($imageName === $image1){
                                      echo "<option value='".$imageName."' selected>".$imageName."</option>";
                                    }
                                    else {
									  echo "<option value='".$imageName."'>".$imageName. "</option>";
                                    }
                                    
								}
							echo "</select>";
						echo "</div>";
						echo "<img id='show-img2' src='media/".$image2."'>";
						echo "<div class='form-group'>";
							echo "<label class='control-label' for='image2-select'>Image Select</label>";
							echo "<select name='image2-select' class='image-select' id='image2-select'>";

								foreach(glob("media/*['.jpg, .png, .jpeg]") as $img){
									$imageName = substr($img, 6);
                                    
                                    if($imageName === $image2){
                                      echo "<option value='".$imageName."' selected>".$imageName."</option>";
                                    }
                                    else {
									  echo "<option value='".$imageName."'>".$imageName. "</option>";
                                    }
								}
							echo "</select>";
						echo "</div>";
		         	echo "<input class='btn btn-default' type='submit' name='update-portfolio' value='submit'>";
		        }
		      }
		    }
				/* ------------------------SERVICE UPDATE FORM ------------*/
				if($table === "services_tb"){
		      $query = "SELECT * FROM services_tb WHERE id='" . $id ."'";
		      $queryResult = mysqli_query(db_connect(), $query);
		      $numOfRows = mysqli_num_rows($queryResult);

		      if($numOfRows > 0){
		        while($rowArray = mysqli_fetch_assoc($queryResult)){
		          $id = $rowArray['id'];
		          $service = $rowArray['service_name'];
		          $cost = $rowArray['cost'];
                  $category = $rowArray['category'];

		          echo "<input type='hidden' name='postId' value='".$id."'>";

							echo "<div class='form-group'>";
								echo "<label class='control-label' for='service'>Service</label>";
			          echo "<input class='form-control' type='text' id='service' name='service' value='".$service."'>";
							echo "</div>";

							echo "<select name='category' class='category-select'>";
								echo "<option value='Graphic Design'>Graphic Design</option>";
								echo "<option value='Print Design'>Print Design</option>";
								echo "<option value='Strategy'>Business Strategy</option>";
							echo "</select>";

							echo "<div class='form-group'>";
								echo "<label class='control-label' for='cost'>Cost</label>";
								echo "<input class='form-control' type='text' name='cost' id='cost' value='".$cost."'>";
							echo "</div>";

		         	echo "<input class='btn btn-default' type='submit' name='update-services' value='submit'>";
		        }
		      }
		    }
				echo "</form>";
			}
			if(isset($_GET['success']) && isset($_GET['id'])){
				$success = $_GET['success'];
				$id = $_GET['id'];

				//if portfolio successfully updated
				if($success == "portfolio_tb"){
					echo "<p class='alert alert-success'> Portfolio has been successfully updated </p>";
					$select = "SELECT * FROM " .$success." WHERE id = '".$id."'";
					echo "<table class='table'>";
					$selectQueryResult = mysqli_query(db_connect(), $select);
					if($selectQueryResult){
						echo "<tr><th>ID </th><th>Image</th><th>Name</th><th>Description</th><th>Testimonial</th><th>Link</th><th>Details</th><th>Image1</th><th>Image2</th></tr>";
						echo "<tr>";
						while($rowArray = mysqli_fetch_assoc($selectQueryResult)){
							foreach($rowArray as $key => $val){
								echo "<td>" . $val . "</td>";
							}
						}
						echo "</tr>";
						echo "</table>";
					}
				}
				//if services successfully updated
				else if ($success == "services_tb") {
					echo "<p class='alert alert-success'> Services page has been successfully updated </p>";
					$select = "SELECT * FROM " .$success." WHERE id = '".$id."'";
					echo "<table class='table'>";
					$selectQueryResult = mysqli_query(db_connect(), $select);
					echo "<tr><th>ID</th><th>Service</th><th>Cost</th><th>Category</th></tr>";
					echo "<tr>";
					while($rowArray = mysqli_fetch_assoc($selectQueryResult)){
						foreach($rowArray as $key => $val){
							echo "<td>" . $val . "</td>";
						}
					echo "</tr>";
					}
					echo "</table>";
				}
			}
			db_close(db_connect());
		?>
	<?php include "partials/footer.php"?>
