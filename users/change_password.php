<div class="container">
	<form method="post" action="" enctype="multipart/form-data">

		<div class="form-group row">
			<label class="col-sm-3 col-form-label" for="current_password">Current Password:</label>
			<div class="col-sm-9">
				<input type="password" name="current_password" id="current_password" class="form-control" required placeholder="Current Password" />
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label" for="new_password">New Password:</label>
			<div class="col-sm-9">
				<input type="password" name="new_password" id="new_password" class="form-control" required placeholder="New Password" />
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label" for="confirm_new_password">Confirm New Password:</label>
			<div class="col-sm-9">
				<input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" required placeholder="Confirm New Password" />
				<p id="status_for_confirm_password"></p><!-- Showing validate password here -->
			</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-9 offset-sm-3">
				<input type="submit" name="change_password" value="Save" class="btn btn-primary" />
			</div>
		</div>

	</form>
</div>