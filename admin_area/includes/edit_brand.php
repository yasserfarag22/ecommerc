<?php
$edit_brand = mysqli_query($con, "select * from brands where brand_id='$_GET[brand_id]'");

$fetch_brand = mysqli_fetch_array($edit_brand);

?>


<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h2>Edit Brand</h2>
					<hr>
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="product_brand">Edit Category:</label>
							<input type="text" class="form-control" name="product_brand" value="<?php echo $fetch_brand['brand_title']; ?>" required />
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="edit_brand" value="Save" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

</div><!-- /.form_box -->

<?php

if (isset($_POST['edit_brand'])) {

	$brand_title = mysqli_real_escape_string($con, $_POST['product_brand']);

	$edit_brand = mysqli_query($con, "update brands set brand_title='$brand_title' where brand_id='$_GET[brand_id]'");

	if ($edit_brand) {
		echo "<script>alert('Product brand was updated successfully!')</script>";

		echo "<script>window.open(window.location.href,'_self')</script>";
	}
}
?>