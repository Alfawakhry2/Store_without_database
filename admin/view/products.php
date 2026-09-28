<?php
session_start();

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";


?>



<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
        <div class="">
            <div class="">

                <div class="card-body px-5 py-5">
                    <?php include '../../inc/errors.php' ?>
                    <?php include '../../inc/success.php' ?>
                    <h3 class="card-title text-left mb-3">All Products</h3>

                    <table class="table table-striped table-hover table-bordered w-50">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Category</th>
                                <th scope="col">Title</th>
                                <th scope="col">Desc</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (isset($_SESSION['products'])): ?>
                                <?php foreach ($_SESSION['products'] as $index => $product): ?>

                                    <tr>
                                        <th scope="row"><?= $index + 1  ?></th>

                                        <td><?= $product['category'] ?></td>
                                        <td><?= $product['title'] ?></td>
                                        <td><?= $product['desc'] ?></td>
                                        <td><?= $product['qty'] ?></td>
                                        <td><?= $product['price'] ?></td>
                                        <td><img src="../upload/<?= $product['image'] ?>"> </td>
                                        <td class="text-end">
                                            <a
                                                class="btn btn-sm btn-outline-primary me-2"
                                                href="editProduct.php?id=<?= $index ?>">
                                                Edit
                                            </a>
                                            <a
                                                class="btn btn-sm btn-outline-danger me-2"
                                                href="deleteProduct.php?id=<?= $index ?>">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>


                                <?php endforeach; ?>
                            <?php endif; ?>

                           

                            <?php ?>
                        </tbody>
                    </table>

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