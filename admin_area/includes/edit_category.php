<?php
$edit_cat = mysqli_query($con, "select * from categories where cat_id='$_GET[cat_id]'");

$fetch_cat = mysqli_fetch_array($edit_cat);

?>


<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h2>Edit Category</h2>
					<hr>
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="product_cat">Edit Category:</label>
							<input type="text" class="form-control" name="product_cat" value="<?php echo $fetch_cat['cat_title']; ?>" required />
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="edit_cat" value="Save" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

if (isset($_POST['edit_cat'])) {

	$cat_title = mysqli_real_escape_string($con, $_POST['product_cat']);

	$edit_cat = mysqli_query($con, "update categories set cat_title='$cat_title' where cat_id='$_GET[cat_id]'");

	if ($edit_cat) {
		echo "<script>alert('Product category was updated successfully!')</script>";

		echo "<script>window.open(window.location.href,'_self')</script>";
	}
}
?>