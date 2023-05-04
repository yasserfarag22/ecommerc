<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h2>Add Category</h2>
					<hr>
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="product_cat">Add New Category:</label>
							<input type="text" class="form-control" name="product_cat" size="60" required />
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="insert_cat" value="Add Category" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

if (isset($_POST['insert_cat'])) {

	$product_cat = mysqli_real_escape_string($con, $_POST['product_cat']);

	$insert_cat = mysqli_query($con, "insert into categories (cat_title) values ('$product_cat') ");

	if ($insert_cat) {
		echo "<script>alert('Product category has been inserted successfully!')</script>";

		echo "<script>window.open(window.location.href,'_self')</script>";
	}
}
?>