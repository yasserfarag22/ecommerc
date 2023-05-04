<?php include('includes/header.php'); ?>

<div class="container mt-4">

	<?php if (!isset($_GET['action'])) { ?>

		<div class="row">

			<div class="col-md-3">
				<h3>Categories</h3>
				<ul class="list-group">
					<?php
					getCats();
					?>
				</ul>

				<h3>Brands</h3>
				<ul class="list-group">
					<?php
					getBrands();
					?>
				</ul>

			</div><!-- /#sidebar -->

			<div class="col-md-9">
				<?php cart(); ?>

				<div class="row mt-4">
					<?php getPro(); ?>
					<?php get_pro_by_cat_id(); ?>
					<?php get_pro_by_brand_id(); ?>
				</div>


			</div>

		</div><!-- /.row -->

	<?php } else { ?>

		<?php include('login.php'); ?>

	<?php } ?>

</div><!-- /.content_wrapper -->

<?php include('includes/footer.php'); ?>

<!-- Bootstrap core JavaScript -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->