<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h2>Add Brand</h2>
					<hr>
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="product_brand">Add New Brand:</label>
							<input type="text" class="form-control" name="product_brand" size="60" required />
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="insert_brand" value="Add Brand" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

if (isset($_POST['insert_brand'])) {

	$product_brand = mysqli_real_escape_string($con, $_POST['product_brand']);

	$insert_brand = mysqli_query($con, "insert into brands (brand_title) values ('$product_brand') ");

	if ($insert_brand) {
		echo "<script>alert('Product brand has been inserted successfully!')</script>";

		echo "<script>window.open(window.location.href,'_self')</script>";
	}
}
?>