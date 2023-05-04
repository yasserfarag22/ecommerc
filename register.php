 <?php include('includes/header.php'); ?>

 <div class="">
 	<script>
 		$(document).ready(function() {

 			$("#password_confirm2").on('keyup', function() {

 				var password_confirm1 = $("#password_confirm1").val();

 				var password_confirm2 = $("#password_confirm2").val();

 				if (password_confirm1 == password_confirm2) {
 					$("#status_for_confirm_password").html('<span class="text-success">Password match</span>');
 				} else {
 					$("#status_for_confirm_password").html('<span class="text-danger">Password do not match</span>');
 				}

 			});

 		});
 	</script>

 	<div class="container">
 		<form method="post" action="" enctype="multipart/form-data">

 			<div class="jumbotron jumbotron-fluid">
 				<div class="container">
 					<h1 class="display-4 text-center">Register</h1>
 					<p class="lead text-center">Already have an account? <a href="index.php?action=login">Login Now.</a></p>
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="name" class="font-weight-bold">Name:</label>
 				<div class="input-group">
 					<div class="input-group-prepend">
 						<span class="input-group-text"><i class="fas fa-user"></i></span>
 					</div>
 					<input type="text" name="name" required class="form-control" placeholder="Name">
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="email" class="font-weight-bold">Email:</label>
 				<div class="input-group">
 					<div class="input-group-prepend">
 						<span class="input-group-text"><i class="fas fa-envelope"></i></span>
 					</div>
 					<input type="email" name="email" required class="form-control" placeholder="Email">
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="password_confirm1" class="font-weight-bold">Password:</label>
 				<div class="input-group">
 					<div class="input-group-prepend">
 						<span class="input-group-text"><i class="fas fa-lock"></i></span>
 					</div>
 					<input type="password" id="password_confirm1" name="password" required class="form-control" placeholder="Password">
 					<div class="input-group-append">
 						<button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
 					</div>
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="password_confirm2" class="font-weight-bold">Confirm Password:</label>
 				<div class="input-group">
 					<div class="input-group-prepend">
 						<span class="input-group-text"><i class="fas fa-lock"></i></span>
 					</div>
 					<input type="password" id="password_confirm2" name="confirm_password" required class="form-control" placeholder="Confirm Password">
 				</div>
 				<p id="status_for_confirm_password" class="text-danger"></p><!-- Showing validate password here -->
 			</div>

 			<div class="form-group">
 				<label for="image" class="font-weight-bold">Image:</label>
 				<div class="custom-file">
 					<input type="file" name="image" class="custom-file-input" id="customFile" />
 					<label class="custom-file-label" for="customFile">Choose file</label>
 				</div>
 				<small class="form-text text-muted">Max file size: 2MB</small>
 			</div>

 			<div class="form-group">
 				<label for="country" class="font-weight-bold">Country:</label>
 				<div class="input-group">
 					<?php include('includes/country_list.php'); ?>
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="city" class="font-weight-bold">City:</label>
 				<div class="input-group">
 					<div class="input-group-prepend">
 						<span class="input-group-text"><i class="fas fa-city"></i></span>
 					</div>
 					<input type="text" name="city" required class="form-control" placeholder="City">
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="contact" class="font-weight-bold">Contact:</label>
 				<div class="input-group">
 					<div class="input-group-prepend">
 						<span class="input-group-text"><i class="fas fa-phone"></i></span>
 					</div>
 					<input type="text" name="contact" required class="form-control" placeholder="Contact">
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="address" class="font-weight-bold">Address:</label>
 				<div class="input-group">
 					<div class="input-group-prepend">
 						<span class="input-group-text"><i class="fas fa-map-marker"></i></span>
 					</div>
 					<input type="text" name="address" required class="form-control" placeholder="Address">
 				</div>
 			</div>

 			<div class="form-group text-center">
 				<button type="submit" name="register" class="btn btn-primary btn-lg">
 					Register <i class="fas fa-user-plus"></i>
 				</button>
 			</div>

 		</form>
 	</div>

 	<?php
		if (isset($_POST['register'])) {
			if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['name'])) {
				$ip = get_ip();
				$name = $_POST['name'];
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);
				$hash_password = md5($password);
				$confirm_password = trim($_POST['confirm_password']);

				$image = $_FILES['image']['name'];
				$image_tmp = $_FILES['image']['tmp_name'];
				$country = $_POST['country'];
				$city = $_POST['city'];
				$contact = $_POST['contact'];
				$address = $_POST['address'];

				$check_exist = mysqli_query($con, "select * from users where email = '$email'");
				$email_count = mysqli_num_rows($check_exist);
				$row_register = mysqli_fetch_array($check_exist);

				if ($email_count > 0) {
					echo "<script>alert('Sorry, your email $email address already exist in our database !')</script>";
				} elseif ($row_register['email'] != $email) {
					// Validating password match
					if ($password == $confirm_password) {
						move_uploaded_file($image_tmp, "user_images/$image");
						$insert_user = "insert into users (ip_address, name, email, password, image, country, city, contact, address) values ('$ip', '$name', '$email', '$hash_password', '$image', '$country', '$city', '$contact', '$address')";
						$run_user = mysqli_query($con, $insert_user);

						if ($run_user) {
							echo "<script>alert('Registration Successful')</script>";
							echo "<script>window.open('index.php', '_self')</script>";
						}
					} else {
						echo "<script>alert('Sorry, your passwords do not match')</script>";
					}
				} else {
					echo "<script>alert('Sorry, an error occurred while processing your request. Please try again later.')</script>";
				}
			} else {
				echo "<script>alert('All fields are required')</script>";
			}
		}
		?>
 </div> <!------------ Content wrapper ends ----------------> <!------------ Footer starts --------------------->
 <?php include './includes/footer.php'; ?> <!------------ Footer ends ----------------------->