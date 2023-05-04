<?php

$select_user = mysqli_query($con, "select * from users where id='$_SESSION[user_id]' ");

$fetch_user = mysqli_fetch_array($select_user);
?>

<div class="container">
  <form method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
      <label class="col-sm-3 col-form-label" for="image">Image:</label>
      <div class="col-sm-9">
        <div class="custom-file">
          <input type="file" name="image" class="custom-file-input" />
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <div class="mt-2">
          <img src="upload-files/<?php echo $fetch_user['image']; ?>" class="img-thumbnail" width="100" height="70" />
        </div>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-9 offset-sm-3">
        <input type="submit" name="user_profile_picture" value="Save" class="btn btn-primary" />
      </div>
    </div>

  </form>
</div>

<?php
if (isset($_POST['user_profile_picture'])) {

  // Check if file not empty 
  if (!empty($_FILES['image']['name'])) {

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $target_file = "upload-files/" . $image;
    $uploadOk = 1;
    $message = '';


    // Check if the file size more than 5 MB.
    if ($_FILES["image"]["size"] < 5098888) {

      // Check if file already exists
      if (file_exists($target_file)) {

        $uploadOk = 0;
        $message .= " Sorry, file already exists. ";
      }
      if ($uploadOk == 0) { // Check if uploadOk is set to 0 by an error

        $message .= "Sorry, your file was not uploaded . ";
      } else {
        if (move_uploaded_file($image_tmp, $target_file)) {

          $update_image = mysqli_query($con, "update users set image='$image' where id='$_SESSION[user_id]'");

          $message .= "The file" . basename($image) . " has been uploaded. ";
        } else {
          $message .= "Sorry, there was an error uploading your file. ";
        }
      }
    } // End if the file size more than 5 MB.
    else {
      $message .= "File size max 5 MB. ";
    }
  }
}

?>

<p style="color:green;margin-left:15px">
  <?php if (isset($message)) {
    echo $message;
  } ?>
</p>