<script>
	$(document).ready(function() {

		$("#password_confirm2").on('keyup', function() {

			var password_confirm1 = $("#password_confirm1").val();

			var password_confirm2 = $("#password_confirm2").val();

			//alert(password_confirm2);

			if (password_confirm1 == password_confirm2) {

				$("#status_for_confirm_password").html('<strong style="color:green">Password match</strong>');

			} else {
				$("#status_for_confirm_password").html('<strong style="color:red">Password do not match</strong>');

			}

		});

	});
</script>





<?php

$select_user = mysqli_query($con, "select * from users where id='$_SESSION[user_id]' ");

$fetch_user = mysqli_fetch_array($select_user);
?>

<div>

	<div class="container">
		<form method="post" action="" enctype="multipart/form-data">

			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="email">Change Email:</label>
				<div class="col-sm-9">
					<input type="email" name="email" id="email" class="form-control" value="<?php echo $fetch_user['email']; ?>" required placeholder="Email" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="current_password">Current Password:</label>
				<div class="col-sm-9">
					<input type="password" name="current_password" id="current_password" class="form-control" required placeholder="Current Password" />
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-9 offset-sm-3">
					<input type="submit" name="edit_account" value="Save" class="btn btn-primary" />
				</div>
			</div>

		</form>
	</div>

	<?php
	if (isset($_POST['edit_account'])) {

		$email = trim($_POST['email']);
		$current_password = trim($_POST['current_password']);
		$hash_password = md5($current_password);

		$check_exist = mysqli_query($con, "select * from users where email = '$email'");

		$email_count = mysqli_num_rows($check_exist);

		$row_register = mysqli_fetch_array($check_exist);

		if ($email_count > 0) {

			echo "<script>alert('Sorry, your email $email address already exist in our database !')</script>";
		} elseif ($fetch_user['password'] != $hash_password) {

			echo "<script>alert('Your Current Password is Wrong!')</script>";
		} else {
			$update_email = mysqli_query($con, "update users set email='$email' where id='$_SESSION[user_id]'");

			if ($update_email) {
				echo "<script>alert('Your Email was updated successfully!')</script>";

				echo "<script>window.open(window.location.href,'_self')</script>";
			}
		}
	}

	?>