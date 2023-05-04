 <?php include('includes/header.php'); ?>

 <div>
 	<div class="row">
 		<div class="col-md-3">
 			<div>
 				<div>Categories</div>
 				<ul>
 					<?php getCats(); ?>
 				</ul>

 				<div>Brands</div>
 				<ul>
 					<?php getBrands(); ?>
 				</ul>
 			</div><!-- /#sidebar -->
 		</div>

 		<div class="col-md-9">
 			<div>
 				<div>
 					<?php
						if (isset($_GET['pro_id'])) {
							$product_id = $_GET['pro_id'];

							$run_query_by_pro_id = mysqli_query($con, "select * from products where product_id='$product_id' ");

							while ($row_pro = mysqli_fetch_array($run_query_by_pro_id)) {

								$pro_id = $row_pro['product_id'];
								$pro_cat = $row_pro['product_cat'];
								$pro_brand = $row_pro['product_brand'];
								$pro_title = $row_pro['product_title'];
								$pro_price = $row_pro['product_price'];
								$pro_image = $row_pro['product_image'];

								echo "
								<div class='col-lg-4 col-md-6 mb-4'>
								<div class='card h-100'>
									<a href='details.php?pro_id=$pro_id'><img class='card-img-top' src='admin_area/product_images/$pro_image' alt='$pro_title'></a>
									<div class='card-body'>
										<h5 class='card-title'><a href='details.php?pro_id=$pro_id'>$pro_title</a></h5>
										<p class='card-text'>$ $pro_price</p>
									</div>
									<div class='card-footer'>
										<a href='index.php?add_cart=$pro_id' class='btn btn-primary btn-block'>Add to Cart</a>
									</div>
								</div>
							</div>";
							}
						}
						?>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <?php include('includes/footer.php'); ?>