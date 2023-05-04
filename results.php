<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>My Online Shop</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

	<!-- Header starts -->
	<?php include('includes/header.php'); ?>
	<!-- Header ends -->

	<!-- Navigation Bar starts -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php">My Online Shop</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="all_products.php">All Products</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="customer/my_account.php">My Account</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="cart.php">Shopping Cart</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact Us</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navigation Bar ends -->

	<!-- Content wrapper starts -->
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-3">
				<h3>Categories</h3>
				<ul class="list-group">
					<?php getCats(); ?>
				</ul>

				<h3 class="mt-3">Brands</h3>
				<ul class="list-group">
					<?php getBrands(); ?>
				</ul>
			</div>
			<div class="col-md-9">
				<div class="row">
					<?php
					if (isset($_GET['search'])) {
						$search_query = $_GET['user_query'];
						$run_query_by_pro_id = mysqli_query($con, "select * from products where product_keywords like '%$search_query%' ");
						while ($row_pro = mysqli_fetch_array($run_query_by_pro_id)) {
							$pro_id = $row_pro['product_id'];
							$pro_title = $row_pro['product_title'];
							$pro_price = $row_pro['product_price'];
							$pro_image = $row_pro['product_image'];
							echo "
							<div class='col-md-4 mb-4'>
								<div class='card'>
									<img src='admin_area/product_images/$pro_image' class='card-img-top' />
									<div class='card-body'>
										<h5 class='card-title'>$pro_title</h5>
										<p class='card-text'><b>Price: $ $pro_price</b></p>
										<a href='details.php?pro_id=$pro_id' class='btn btn-outline-secondary btn-sm'>Details</a>
										<a href='index.php?add_cart=$pro_id' class='btn btn-primary btn-sm'>Add to Cart</a>
									</div>
								</div>
							</div>
							";
						}
					}
					get_pro_by_cat_id();
					get_pro_by_brand_id();
					?>
				</div><!-- /row -->
			</div><!-- /col-md-9 -->
		</div><!-- /row -->
	</div><!-- /.content_wrapper-->
	<!-- Content wrapper ends -->

	<?php include('includes/footer.php'); ?>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>