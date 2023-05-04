<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form method="post" action="" class="mt-4">

				<div class="mb-5 text-center">
					<h1 class="mb-3 font-weight-bold">Login</h1>
					<p class="mb-0">Don't have an account? <a href="register.php" class="text-primary font-weight-bold">Register here</a></p>
				</div>

				<div class="form-group">
					<label for="email" class="font-weight-bold">Email:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" name="email" required placeholder="Email" />
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="font-weight-bold">Password:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-lock"></i></span>
						</div>
						<input type="password" class="form-control" name="password" required placeholder="Password" />
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="d-flex justify-content-between align-items-center">
						<a href="checkout.php?forgot_pass" class="text-decoration-none font-weight-bold text-primary"><i class="fas fa-question-circle mr-2"></i>Forgot Password?</a>
					</div>
				</div>

				<div class="mb-3">
					<input type="submit" class="btn btn-primary" name="login" value="Login" />
				</div>

			</form>

		</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div><!-- /.container -->

<?php
if (isset($_POST['login'])) {
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$password = md5($password);
	$run_login = mysqli_query($con, "select * from users where password='$password' AND email='$email' ");
	$check_login = mysqli_num_rows($run_login);
	$row_login = mysqli_fetch_array($run_login);
	if ($check_login == 0) {
		echo "<script>alert('Password or email is incorrect, please try again!')</script>";
		exit();
	}
	$ip = get_ip();
	$run_cart = mysqli_query($con, "select * from cart where ip_address='$ip'");
	$check_cart = mysqli_num_rows($run_cart);
	if ($check_login > 0 and $check_cart == 0) {
		$_SESSION['user_id'] = $row_login['id'];
		$_SESSION['role'] = $row_login['role'];
		$_SESSION['email'] = $email;
		echo "<script>alert('You have logged in successfully !')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
	} else {
		$_SESSION['user_id'] = $row_login['id'];
		$_SESSION['role'] = $row_login['role'];
		$_SESSION['email'] = $email;
		echo "<script>alert('You have logged in successfully !')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
}
?>