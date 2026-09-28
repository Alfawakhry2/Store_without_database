<?php
include 'inc/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $quantity = $_GET['quantity'] ?? 1;
    if (isset($_SESSION['products'][$id])) {
        $product = $_SESSION['products'][$id];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }


        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'title' => $product['title'],
                'price' => $product['price'],
                'image' => $product['image'],
                'cart_quantity' => $_GET['quantity'],
            ];
            header('location:shop.php');
            exit();
        } else {
            $_SESSION['cart'][$id]['cart_quantity'] += $quantity;
        }

        $_SESSION['success'][] = 'Product added to cart successfully';
    }
}

?>
<!-- Start Hero -->
<?php 
 echo "<pre>";
    print_r($_SESSION['order']);
    echo "</pre>";
?>
<section id="page-header">
    <h2>Super value deals</h2>
    <p>Save more woth coupons & up to 70% off!</p>
</section>

<!-- End Hero -->



<!-- Start New Arrival or productCard Features -->
<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modren Desgin</p>
    <?php include 'inc/success.php' ?>
    <div class="pro-container">
        <?php if (isset($_SESSION['products'])): ?>
            <?php foreach ($_SESSION['products'] as $index => $product): ?>
                <div class="pro">
                    <img src="admin/upload/<?= $product['image'] ?>" alt="proudcts">
                    <div class="des">
                        <span><?= $product['category'] ?></span>
                        <h5><?= $product['title'] ?></h5>
                        <div class="star ">
                            <i class="fas fa-star "></i>
                            <i class="fas fa-star "></i>
                            <i class="fas fa-star "></i>
                            <i class="fas fa-star "></i>
                            <i class="fas fa-star "></i>
                        </div>
                        <h4></h4>
                        <!-- <a href="shop.php?id=" class="cart "><i class="fas fa-shopping-cart "></i></a> -->
                        <form action="shop.php" method="get">
                            <!-- id , quantity -->
                            <!-- id -->
                            <input type="hidden" name="id" value="<?= $index ?>">
                            <!-- quantity -->
                            <input type="number" name="quantity" value="1" min="1">

                            <button type="submit" class="cart">
                                <i class="fas fa-shopping-cart "></i>
                            </button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>

<section id="pagenation" class="section-p1">

    <a href="# ">1</a>
    <a href="# ">2</a>
    <a href="# "><i class="fas fa-long-arrow-alt-right "></i></a>

</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext ">
        <h4>Sign Up For Newletters</h4>
        <p>Get E-mail Updates about our latest shop and <span class="text-warning ">Special Offers.</span></p>
    </div>
    <div class="form ">
        <input type="text " placeholder="Enter Your E-mail... ">
        <button class="normal ">Sign Up</button>
    </div>
</section>

<?php include 'inc/footer.php' ?>