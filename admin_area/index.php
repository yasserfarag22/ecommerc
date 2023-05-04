<?php
session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {

	echo "<script>window.open('login.php','_self')</script>";
} else {

?>

	<?php include '../includes/db.php'; ?>

	<!DOCTYPE html><!-- HTML5 Declaration -->

	<html>

	<head>
		<title>Web Developer</title>

		<link href="styles/desktop.css" type="text/css" rel="stylesheet">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<script src="../js/jquery-3.4.1.js"></script>

		<head>

		<body>
			<div class="container-fluid">
				<div class="header">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="navbar-brand">Admin Area - <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?></a>

						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav ml-auto">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-user"></i>
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">User Account</a>
										<a class="dropdown-item" href="logout.php">Logout</a>
									</div>
								</li>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-bell"></i>
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">Notification</a>
									</div>
								</li>
							</ul>
						</div>
					</nav>

				</div><!-- /.header -->

				<div class="row">
					<div class="col-md-3 left_sidebar">
						<div class="left_sidebar_box">

							<ul class="nav flex-column">
								<li class="nav-item">
									<a class="nav-link" href="../index.php" target="_blank"><i class="fa fa-dashboard"></i> My Site</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#" data-toggle="collapse" data-target="#productsSubMenu" aria-expanded="false" aria-controls="productsSubMenu"><i class="fa fa-th-large"></i> Products <i class="arrow fa fa-angle-left"></i></a>
									<div class="collapse" id="productsSubMenu">
										<ul class="nav flex-column pl-3">
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=add_pro">Add Product</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=view_pro">View Products</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#" data-toggle="collapse" data-target="#categoriesSubMenu" aria-expanded="false" aria-controls="categoriesSubMenu"><i class="fa fa-plus"></i> Categories <i class="arrow fa fa-angle-left"></i></a>
									<div class="collapse" id="categoriesSubMenu">
										<ul class="nav flex-column pl-3">
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=add_cat">Add Category</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=view_cat">View Categories</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#" data-toggle="collapse" data-target="#brandsSubMenu" aria-expanded="false" aria-controls="brandsSubMenu"><i class="fa fa-gift"></i> Brands <i class="arrow fa fa-angle-left"></i></a>
									<div class="collapse" id="brandsSubMenu">
										<ul class="nav flex-column pl-3">
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=add_brand">Add Brand</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=view_brand">View Brands</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="index.php?action=view_users"><i class="fa fa-users"></i> Users</a>
								</li>
								<!-- <li class="nav-item">
									<a class="nav-link" href="#" data-toggle="collapse" data-target="#ordersSubMenu" aria-expanded="false" aria-controls="ordersSubMenu"><i class="fa fa-first-order"></i> Orders <i class="arrow fa fa-angle-left"></i></a>
									<div class="collapse" id="ordersSubMenu">
										<ul class="nav flex-column pl-3">
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=view_orders">View Orders</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=confirm_payment">Confirm Payment</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="index.php?action=deliver_order">Deliver Order</a>
											</li>
										</ul>
									</div>
								</li> -->
							</ul>

						</div><!-- /.left_sidebar_box -->
					</div><!-- /.left_sidebar -->

					<div class="col-md-9">
						<div class="right_content">
							<?php
							if (isset($_GET['action'])) {
								$action = $_GET['action'];
							} else {
								$action = '';
							}

							switch ($action) {
								case 'add_pro':
									include('includes/insert_product.php');
									break;
								case 'view_pro':
									include('includes/view_products.php');
									break;
								case 'edit_pro':
									include('includes/edit_product.php');
									break;
								case 'add_cat':
									include('includes/insert_category.php');
									break;
								case 'view_cat':
									include('includes/view_categories.php');
									break;
								case 'edit_cat':
									include('./includes/edit_category.php');
									break;
								case 'add_brand':
									include('./includes/insert_brand.php');
									break;
								case 'view_brand':
									include 'includes/view_brands.php';
									break;
								case 'edit_brand':
									include 'includes/edit_brand.php';
									break;
								case 'view_users':
									include 'includes/view_users.php';
									break;
									// case 'view_orders':
									// 	include('view_orders.php');
									// 	break;
									// case 'confirm_payment':
									// 	include('confirm_payment.php');
									// 	break;
								default:
									include('includes/view_categories.php');

									break;
							}
							?>
						</div><!-- /.right_content -->
					</div><!-- /.col-md-9 -->

				</div><!-- /.row -->



			</div><!-- /.container-fluid -->

			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		</body>

	</html>

<?php

}

?>

<script>
	$(document).ready(function() {

		// Drop Down Menu Right
		$(".dropdown-navbar-right").on('click', function() {
			$(this).find(".subnavbar-right").slideToggle('fast');
		});

		// Collapse Left Sidebar
		$(".left_sidebar_first_level li").on('click', this, function() {
			$(this).find(".left_sidebar_second_level").slideToggle('fast');
		});

	});
</script>