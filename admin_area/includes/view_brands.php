<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h2>View Brands</h2>
          <hr>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data" />
          <div class="form-group">
            <input type="text" id="search" placeholder="Type to search..." class="form-control" />
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAll" />Check</th>
                  <th>ID</th>
                  <th>Brand Title</th>
                  <th>Status</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $all_brands = mysqli_query($con, "select * from brands order by brand_id DESC ");
                $i = 1;
                while ($row = mysqli_fetch_array($all_brands)) {
                ?>
                  <tr>
                    <td><input type="checkbox" name="deleteAll[]" value="<?php echo $row['brand_id']; ?>" /></td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['brand_title']; ?></td>
                    <td>
                      <?php
                      if ($row['visible'] == 1) {
                        echo "Approved";
                      } else {
                        echo "Pending";
                      }
                      ?>
                    </td>
                    <td><a href="index.php?action=view_brands&delete_brand=<?php echo $row['brand_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                    <td><a href="index.php?action=edit_brand&brand_id=<?php echo $row['brand_id']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
// Delete Brand
if (isset($_GET['delete_brand'])) {
  $delete_brand = mysqli_query($con, "delete from brands where brand_id='$_GET[delete_brand]' ");
  if ($delete_brand) {
    echo "<script>alert('Product brand has been deleted successfully!')</script>";
    echo "<script>window.open('index.php?action=view_brands','_self')</script>";
  }
}

// Remove items selected using foreach loop
if (isset($_POST['deleteAll'])) {
  $remove = $_POST['deleteAll'];
  foreach ($remove as $key) {
    $run_remove = mysqli_query($con, "delete from brands where brand_id='$key'");
    if ($run_remove) {
      echo "<script>alert('Items selected have been removed successfully!')</script>";
      echo "<script>window.open('index.php?action=view_brands','_self')</script>";
    } else {
      echo "<script>alert('Mysqli Failed: mysqli_error($con)!')</script>";
    }
  }
}
?>