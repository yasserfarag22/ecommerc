<?php include('includes/header.php'); ?>

<div class="container">
  <?php if (isset($_SESSION['user_id'])) { ?>
    <div class="d-flex user_container">
      <div class="flex-grow-1">
        <?php
        if (isset($_GET['action'])) {
          $action = $_GET['action'];
        } else {
          $action = '';
        }

        switch ($action) {
          case "edit_account":
            include('users/edit_account.php');
            break;
          case "edit_profile":
            include('users/edit_profile.php');
            break;
          case "user_profile_picture":
            include('users/user_profile_picture.php');
            break;
          case "change_password":
            include('users/change_password.php');
            break;
          case "delete_account":
            include('users/delete_account.php');
            break;
          default:
            echo "Do something";
            break;
        }
        ?>
      </div><!-- /.flex-grow-1 -->

      <div class="text-center">
        <?php
        $run_image = mysqli_query($con, "select * from users where id='$_SESSION[user_id]'");
        $row_image = mysqli_fetch_array($run_image);

        if ($row_image['image'] != '') {
        ?>
          <div class="mb-3">
            <img src="upload-files/<?php echo $row_image['image']; ?>" class="img-thumbnail user-image" />
          </div>
        <?php } else { ?>
          <div class="mb-3">
            <img src="images/profile-icon.png" class="img-thumbnail user-image" />
          </div>
        <?php } ?>

        <ul class="list-group">
          <li class="list-group-item"><a href="my_account.php?action=my_order" class="text-decoration-none">My Order</a></li>
          <li class="list-group-item"><a href="my_account.php?action=edit_account" class="text-decoration-none">Edit Account</a></li>
          <li class="list-group-item"><a href="my_account.php?action=edit_profile" class="text-decoration-none">Edit Profile</a></li>
          <li class="list-group-item"><a href="my_account.php?action=user_profile_picture" class="text-decoration-none">User Profile Picture</a></li>
          <li class="list-group-item"><a href="my_account.php?action=change_password" class="text-decoration-none">Change Password</a></li>
          <li class="list-group-item"><a href="my_account.php?action=delete_account" class="text-decoration-none">Delete Account</a></li>
          <li class="list-group-item"><a href="logout.php" class="text-decoration-none">Logout</a></li>
        </ul>
      </div><!-- /.text-center -->
    </div><!-- /.d-flex user_container -->
  <?php } else { ?>
    <h1 class="mt-4">Account Setting Page</h1>
    <h5 class="mt-4">Please <a href="index.php?action=login" class="text-decoration-none">Log In</a> to Your Account!</h5>
  <?php } ?>
</div><!-- /.container -->

<?php include('includes/footer.php'); ?>

<style>
  .user-image {
    max-width: 300px;
    max-height: 300px;
  }
</style>