<?php

include 'inc/header.php';
if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    if(isset($_SESSION['cart'][$id])){
        unset($_SESSION['cart'][$id]);
    }

    header('location:cart.php');
    exit();

}

$subTotal = 0 ;
?>

<section id="cart" class="section-p1">

    <table width="100%">

        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>


        <tbody>



            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $index => $item) : ?>

                    <?php 
                    $itemTotal = $item['price'] * $item['cart_quantity'];
                    $subTotal +=$itemTotal ; 
                    ?>
                    <tr>
                        <td>
                            <a href="cart.php?remove=<?= $index ?>">
                                <i class="far fa-times-circle"></i>
                            </a>
                        </td>

                        <td>
                            <img
                                src="admin/upload/<?= $item['image'] ?>"
                                width="80">
                        </td>


                        <td>
                            <?= $item['title'] ?>
                        </td>


                        <td>
                              <?= $item['price'] ?>
                        </td>


                        <td>

                           <?= $item['cart_quantity'] ?>

                        </td>

                        <td>
                            <?= $itemTotal ?>
                        </td>


                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- <tr>
                    <td colspan="6">
                        Cart Is Empty
                    </td>
                </tr> -->
            <?php endif; ?>


        </tbody>


    </table>

</section>


<section id="cart-add" class="section-p1">

    <div id="coupon">

        <h3>Coupon</h3>

        <input type="text" placeholder="Enter coupon code">

        <button class="normal">
            Apply
        </button>

    </div>


    <div id="subTotal">

        <h3>Cart totals</h3>

        <table>

            <tr>
                <td>Subtotal</td>
                <td><?= $subTotal ?></td>
            </tr>


            <tr>
                <td>Shipping</td>
                <td>$0.00</td>
            </tr>


            <tr>
                <td>Tax</td>
                <td>$0.00</td>
            </tr>


            <tr>
                <td>
                    <strong>Total</strong>
                </td>

                <td>
                    <strong>
                       <?= $subTotal ?>
                    </strong>
                </td>
            </tr>

        </table>


        <a href="confirmOrder.php" class="btn btn-primary normal">proceed to checkout</a>
        

    </div>

</section>


<?php include 'inc/footer.php' ?>