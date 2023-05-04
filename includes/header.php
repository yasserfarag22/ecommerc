<?php

session_start();

include("functions/functions.php");

include("includes/db.php");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Online shopping</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="styles/style.css" media="all" />
  <script src="js/jquery-3.4.1.js"></script>
</head>

<body> <!-- Main container starts here -->
  <div class="container-fluid">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
      </a>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search a Product" aria-label="Search">
      </form>

      <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            <span class="fa-stack fa-lg has-badge" data-count="<?php echo total_items(); ?>">
              <i class="fas fa-circle fa-stack-2x"></i>
              <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
            </span>
          </a>
        </li>

        <?php if (!isset($_SESSION['user_id'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        <?php } else { ?>
          <?php
          $select_user = mysqli_query($con, "select * from users where id='$_SESSION[user_id]'");
          $data_user = mysqli_fetch_array($select_user);
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php if ($data_user['image'] != '') { ?>
                <img src="upload-files/<?php echo $data_user['image']; ?>" alt="Profile Picture" class="rounded-circle" width="32" height="32">
              <?php } else { ?>
                <i class="fas fa-user-circle fa-lg me-2"></i>
              <?php } ?>
              <?php echo $data_user['name']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="my_account.php">Account Settings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php } ?>

      </ul>

    </header>

    <!-- Navigation Bar starts here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="all_products.php">All Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="my_account.php">My Account</a>
            </li>
            <li class="nav-item"> <a class="nav-link" href="cart.php">Shopping Cart</a> </li>
            </li> <?php if (isset($_SESSION['user_id'])) { ?> <li class="nav-item"> <a class="nav-link" href="logout.php">Logout</a> </li> <?php } ?>
          </ul>
        </div>
      </div>
    </nav><?php include('js/drop_down_menu.php'); ?>