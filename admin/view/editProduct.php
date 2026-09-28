<?php
include '../inc/auth.php';
session_start();
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  if (array_key_exists($id, $_SESSION['products'])) {
    $product = $_SESSION['products'][$id];
  } else {
    header('location:products.php');
    exit();
  }
} else {
  header('location:products.php');
  exit();
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
          <?php include '../../inc/errors.php' ?>
          <?php include '../../inc/success.php' ?>

          <?php


          // if(isset($_SESSION['products'])){
          //   print_r($_SESSION['products']);
          // }


          ?>
          <h3 class="card-title text-left mb-3">Edit Product</h3>
          <form method="POST" action="../handle/handleEditProduct.php?id=<?= $id ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label>Category</label>
              <!-- <input type="text" name="cat" class="form-control p_input"> -->
              <select name="cat" class="form-group">
                <!-- <option>Select Category</option> -->
                <?php foreach ($_SESSION['categories'] as $cat) : ?> 
                  <option value="<?= $cat['name'] ?>" <?php if($cat['name'] == $product['category']) echo  'selected' ?> ><?= $cat['name'] ?> </option>
                <?php endforeach ?>

              </select>
            </div>
            <div class="form-group">
              <label>Title</label>
              <input type="text" value="<?= $product['title'] ?>" name="title" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" value="<?= $product['desc'] ?>" name="desc" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="number" value="<?= $product['price'] ?>" name="price" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="number" value="<?= $product['qty'] ?>" name="quantity" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="img" class="form-control p_input">
              <img src="../upload/<?= $product['image'] ?>" width="100px" height="100px">
            </div>
            <div class="text-center">
              <button type="submit" name="editProduct" class="btn btn-primary btn-block enter-btn">Edit</button>
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