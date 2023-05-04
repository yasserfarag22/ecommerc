<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h2>Add Product</h2>
					<hr>
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="product_title">Product Title:</label>
							<input type="text" class="form-control" name="product_title" size="60" required />
						</div>
						<div class="form-group">
							<label for="product_cat">Product Category:</label>
							<select name="product_cat" class="form-control">
								<option>Select a Category</option>
								<?php
								$get_cats = "select * from categories";
								$run_cats = mysqli_query($con, $get_cats);
								while ($row_cats = mysqli_fetch_array($run_cats)) {
									$cat_id = $row_cats['cat_id'];
									$cat_title = $row_cats['cat_title'];
									echo "<option value='$cat_id'>$cat_title</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="product_brand">Product Brand:</label>
							<select name="product_brand" class="form-control">
								<option>Select a Brand</option>
								<?php
								$get_brands = "select * from brands";
								$run_brands = mysqli_query($con, $get_brands);
								while ($row_brands = mysqli_fetch_array($run_brands)) {
									$brand_id = $row_brands['brand_id'];
									$brand_title = $row_brands['brand_title'];
									echo "<option value='$brand_id'>$brand_title</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="product_image">Product Image:</label>
							<input type="file" class="form-control-file" name="product_image" />
						</div>
						<div class="form-group">
							<label for="product_price">Product Price:</label>
							<input type="text" class="form-control" name="product_price" required />
						</div>
						<div class="form-group">
							<label for="product_desc">Product Description:</label>
							<textarea name="product_desc" rows="10" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="product_keywords">Product Keywords:</label>
							<input type="text" class="form-control" name="product_keywords" required />
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="insert_post" value="Add Product" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

if (isset($_POST['insert_post'])) {
	$product_title = $_POST['product_title'];
	$product_cat = $_POST['product_cat'];
	$product_brand = $_POST['product_brand'];
	$product_price = $_POST['product_price'];
	$product_desc = trim(mysqli_real_escape_string($con, $_POST['product_desc']));
	$product_keywords = $_POST['product_keywords'];


	// Getting the image from the field
	$product_image  = $_FILES['product_image']['name'];
	$product_image_tmp = $_FILES['product_image']['tmp_name'];

	move_uploaded_file($product_image_tmp, "product_images/$product_image");

	$insert_product = " insert into products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) 
   values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords') ";

	$insert_pro = mysqli_query($con, $insert_product);

	if ($insert_pro) {
		echo "<script>alert('Product Has Been inserted successfully!')</script>";

		//echo "<script>window.open('index.php?insert_product','_self')</script>";
	}
}
?>