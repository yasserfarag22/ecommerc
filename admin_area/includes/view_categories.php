<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h2>View Categories</h2>
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
                    <th>Category Title</th>
                    <th>Status</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $all_categories = mysqli_query($con, "select * from categories order by cat_id DESC ");
                  $i = 1;
                  while ($row = mysqli_fetch_array($all_categories)) {
                  ?>
                    <tr>
                      <td><input type="checkbox" name="deleteAll[]" value="<?php echo $row['cat_id']; ?>" /></td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['cat_title']; ?></td>
                      <td>
                        <?php
                        if ($row['visible'] == 1) {
                          echo "Approved";
                        } else {
                          echo "Pending";
                        }
                        ?>
                      </td>
                      <td><a href="index.php?action=view_cat&delete_cat=<?php echo $row['cat_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                      <td><a href="index.php?action=edit_cat&cat_id=<?php echo $row['cat_id']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
// Delete Category
if (isset($_GET['delete_cat'])) {
  $delete_cat = mysqli_query($con, "delete from categories where cat_id='$_GET[delete_cat]' ");
  if ($delete_cat) {
    echo "<script>alert('Product category has been deleted successfully!')</script>";
    echo "<script>window.open('index.php?action=view_cat','_self')</script>";
  }
}

// Remove items selected using foreach loop
if (isset($_POST['deleteAll'])) {
  $remove = $_POST['deleteAll'];
  foreach ($remove as $key) {
    $run_remove = mysqli_query($con, "delete from categories where cat_id='$key'");
    if ($run_remove) {
      echo "<script>alert('Items selected have been removed successfully!')</script>";
      echo "<script>window.open('index.php?action=view_cat','_self')</script>";
    } else {
      echo "<script>alert('Mysqli Failed: mysqli_error($con)!')</script>";
    }
  }
}
?>