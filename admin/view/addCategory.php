<?php
session_start();

include '../inc/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCategory'])) {

  // fetch data 
  $name = trim(htmlspecialchars($_POST['name']));

  // validation 
  $errors = [];
  if (empty($name)) {
    $errors[] = 'name is required';
  } elseif (strlen($name) < 4) {
    $errors[] = "name must be at least 4 chars";
  }

  // check database (session already exist)
  if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = [];
  }

  //check errors 
  if (empty($errors)) {
  $_SESSION['categories'][] = [
      'name' => $name
    ];


    $_SESSION['success'] = ['Category Added successfully'];
    header('location:addCategory.php');
    exit();
  } else {
    $_SESSION['errors'] = $errors;
    header('location:addCategory.php');
    exit();
  }
}



include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";

?>


<div class="container-fluid page-body-wrapper full-page-wrapper">
  <div class="row w-100 m-0">
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
      <div class="card col-lg-4 mx-auto">

        <div class="card-body px-5 py-5">
          <?php 
            // print_r($_SESSION['categories']);
          ?>
          <h3 class="card-title text-left mb-3">Add Category</h3>
          <?php include '../../inc/errors.php' ?>
          <?php include '../../inc/success.php' ?>

          <form method="POST" action="addCategory.php">
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="name" class="form-control p_input">
            </div>
            <div class="text-center">
              <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- row ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<?php
include "../view/footer.php";
?>