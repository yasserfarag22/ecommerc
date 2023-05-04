<div class="container bg-white">
	<!------------ Header starts --------------------->
	<?php include('includes/header.php'); ?>

	<!------------ Content wrapper starts -------------->
	<div class="row">
		<div class="col-md-3">
			<h3>Categories</h3>
			<ul>
				<?php
				getCats();
				?>
			</ul>

			<h3>Brands</h3>
			<ul>
				<?php
				getBrands();
				?>
			</ul>

		</div><!-- /#sidebar -->

		<div class="col-md-9">
			<div class="row">

				<?php

				$get_pro = " select * from products ";

				$run_pro = mysqli_query($con, $get_pro);

				while ($row_pro = mysqli_fetch_array($run_pro)) {
					$pro_id = $row_pro['product_id'];
					$pro_cat = $row_pro['product_cat'];
					$pro_brand = $row_pro['product_brand'];
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
                <a href='index.php?add_cart=$pro_id' class='btn btn-primary btn-sm'>
                  Add to Cart
                </a>
              </div>
            </div>
          </div>
        ";
				}
				?>

				<?php get_pro_by_cat_id(); ?>

				<?php get_pro_by_brand_id(); ?>

			</div><!-- /#products_box -->
		</div><!-- /#content_area -->
	</div><!-- /.row content_wrapper-->
	<!------------ Content wrapper ends -------------->
	<?php include('includes/footer.php'); ?>
</div><!-- /.container -->