<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h2>View Products</h2>
          <hr>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" id="search" placeholder="Type to search..." class="form-control" />
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="checkAll" />Check</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Views</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $all_products = mysqli_query($con, "select * from products order by product_id DESC ");
                  $i = 1;
                  while ($row = mysqli_fetch_array($all_products)) {
                  ?>
                    <tr>
                      <td><input type="checkbox" name="deleteAll[]" value="<?php echo $row['product_id']; ?>" /></td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['product_title']; ?></td>
                      <td><?php echo $row['product_price']; ?></td>
                      <td><img src="product_images/<?php echo $row['product_image']; ?>" width="70" height="50" /></td>
                      <td><?php echo $row['views']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                      <td>
                        <?php
                        if ($row['visible'] == 1) {
                          echo "Approved";
                        } else {
                          echo "Pending";
                        }
                        ?>
                      </td>
                      <td><a href="index.php?action=view_pro&delete_product=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                      <td><a href="index.php?action=edit_pro&product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                    </tr>
                  <?php $i++;
                  } // End while loop 
                  ?>
                </tbody>
              </table>
            </div>
            <div class="form-group">
              <input type="submit" name="delete_all" value="Remove" class="btn btn-danger" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// Delete Product
if (isset($_GET['delete_product'])) {
  $delete_product = mysqli_query($con, "delete from products where product_id='$_GET[delete_product]' ");
  if ($delete_product) {
    echo "<script>alert('Product has been deleted successfully!')</script>";
    echo "<script>window.open('index.php?action=view_pro','_self')</script>";
  }
}

// Remove items selected using foreach loop
if (isset($_POST['deleteAll'])) {
  $remove = $_POST['deleteAll'];
  foreach ($remove as $key) {
    $run_remove = mysqli_query($con, "delete from products where product_id='$key'");
    if ($run_remove) {
      echo "<script>alert('Items selected have been removed successfully!')</script>";
      echo "<script>window.open('index.php?action=view_pro','_self')</script>";
    } else {
      echo "<script>alert('Mysqli Failed: mysqli_error($con)!')</script>";
    }
  }
}
?>