 <?php include('includes/header.php'); ?>
 <!-- <div class="row">
 	<div class="col-md-3">
 		<h3>Categories</h3>
 		<ul>
 			<?php
				// getCats();
				?>
 		</ul>

 		<h3>Brands</h3>
 		<ul>
 			<?php
				// getBrands();
				?>
 		</ul>

 	</div>/#sidebar -->
 <div class="col-md-9">
 	<div class="card">
 		<div class="card-header">
 			<div class="row">
 				<div class="col-md-6">
 					<?php
						if (isset($_SESSION['customer_email'])) {
							echo "<b>Your Email:</b> " . $_SESSION['customer_email'];
						} else {
							echo "";
						}
						?>
 				</div>
 				<div class="col-md-6 text-center">
 					<h4 class="mb-3">Your Cart</h4>
 					<span>Total Items: <?php total_items(); ?></span>
 					<span class="mx-3">|</span>
 					<span>Total Price: <?php total_price(); ?></span>
 				</div>
 			</div>
 		</div>
 		<div class="card-body">
 			<form action="" method="post" enctype="multipart/form-data">
 				<table class="table table-striped">
 					<thead>
 						<tr>
 							<th scope="col">Remove</th>
 							<th scope="col">Product</th>
 							<th scope="col">Quantity</th>
 							<th scope="col">Price</th>
 						</tr>
 					</thead>
 					<tbody>
 						<?php
							$total = 0;
							$ip = get_ip();
							$run_cart = mysqli_query($con, "select * from cart where ip_address='$ip' ");
							while ($fetch_cart = mysqli_fetch_array($run_cart)) {
								$product_id = $fetch_cart['product_id'];
								$result_product = mysqli_query($con, "select * from products where product_id = '$product_id'");
								while ($fetch_product = mysqli_fetch_array($result_product)) {
									$product_price = array($fetch_product['product_price']);
									$product_title = $fetch_product['product_title'];
									$product_image = $fetch_product['product_image'];
									$sing_price = $fetch_product['product_price'];
									$values = array_sum($product_price);
									$run_qty = mysqli_query($con, "select * from cart where product_id = '$product_id'");
									$row_qty = mysqli_fetch_array($run_qty);
									$qty = $row_qty['quality'];
									$values_qty = $values * $qty;
									$total += $values_qty;
							?>
 								<tr>
 									<td><input type="checkbox" name="remove[]" value="<?php echo $product_id; ?>" /></td>
 									<td>
 										<div class="row">
 											<div class="col-md-3">
 												<img src="admin_area/product_images/<?php echo $product_image; ?> " width="80" height="80" />
 											</div>
 											<div class="col-md-9">
 												<?php echo $product_title; ?>
 											</div>
 										</div>
 									</td>
 									<td>
 										<input type="text" class="form-control" size="4" name="qty" value="<?php echo $qty; ?>" />
 									</td>
 									<td>
 										<?php echo "$" . $sing_price; ?>
 									</td>
 								</tr>
 						<?php
								}
							}
							?>
 						<tr>
 							<td colspan="3" align="right"><b>Sub Total:</b></td>
 							<td><?php echo  total_price(); ?> </td>
 						</tr>
 					</tbody>
 				</table>
 				<div class="text-center mt-3">
 					<button type="submit" name="update_cart" class="btn btn-outline-secondary mr-3">Update Cart</button>
 					<button type="submit" name="continue" class="btn btn-outline-secondary mr-3">Continue Shopping</button>
 					<a href="checkout.php" class="btn btn-primary">Checkout</a>
 				</div>
 			</form>

 			<?php
				if (isset($_POST['remove'])) {
					foreach ($_POST['remove'] as $remove_id) {
						$run_delete = mysqli_query($con, "delete from cart where product_id = '$remove_id' AND ip_address='$ip' ");
						if ($run_delete) {
							echo "<script>window.open('cart.php','_self')</script>";
						}
					}
				}
				if (isset($_POST['continue'])) {
					echo "<script>window.open('index.php','_self')</script>";
				}
				?>

 		</div>
 	</div>
 </div>
 <?php include('includes/footer.php'); ?>