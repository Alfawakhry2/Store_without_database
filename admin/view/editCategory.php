<?php
session_start();

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // if id not exist in session of categories 
  if (array_key_exists($id, $_SESSION['categories'])) {
    $category = $_SESSION['categories'][$id];
  } else {
    header('location:listCategory.php');
    exit();
  }
} else {
  header('location:listCategory.php');
  exit();
}



if (isset($_POST['editCategory'])) {
  // fetch data 
  $name = trim(htmlspecialchars($_POST['name']));

  // validation 
  $errors = [];
  if (empty($name)) {
    $errors[] = 'name is required';
  } elseif (strlen($name) < 4) {
    $errors[] = "name must be at least 4 chars";
  }


  //check errors 
  if (empty($errors)) {
    //valid ??? 

    // []
    $_SESSION['categories'][$id]['name'] = $name ; 
    // $id['name']; 

    $_SESSION['success'] = ['Category updated successfully'];
    header('location:editCategory.php?id='.$id);
    exit();
  } else {
    $_SESSION['errors'] = $errors;
    header('location:editCategory.php?id='.$id);
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
          <h3 class="card-title text-left mb-3">Edit Category</h3>
          <?php include '../../inc/errors.php' ?>
          <?php include '../../inc/success.php' ?>

          <form method="POST" action="editCategory.php?id=<?= $id ?>">
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="name" value="<?= $category['name'] ?>" class="form-control p_input">
            </div>
            <div class="text-center">
              <button type="submit" name="editCategory" class="btn btn-primary btn-block enter-btn">Update</button>
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