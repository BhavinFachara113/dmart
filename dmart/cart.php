<?php
include("navigationbar.php");
include("config.php");

$cart_totel = 0;
$saving = 0;

// If the remove all button is pressed, unset the cart session variable
if (isset($_POST['remove_all'])) {
    unset($_SESSION['cart']);
}

// If a specific product is removed
if (isset($_POST['remove_item'])) {
    $product_key = $_POST['product_key']; // Get the product key sent via POST
    unset($_SESSION['cart'][$product_key]); // Remove the specific item from the cart

    // If the cart is empty after removal, unset the session
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="./css/cart1.css">
    <script>
        function product_count(action, id) {
            var inputField = document.getElementById('quantity_' + id);
            var hiddenField = document.getElementById('hidden_quantity_' + id);
            var currentQuantity = parseInt(inputField.value) || 1;

            if (action === 'add') {
                currentQuantity++;
            } else if (action === 'remove' && currentQuantity > 1) {
                currentQuantity--;
            }

            inputField.value = currentQuantity;
            hiddenField.value = currentQuantity;

            updateCartTotal();
        }

        function updateCartTotal() {
            var total = 0;
            var savings = 0;
            var cartItems = document.querySelectorAll('#display_product_cart');

            cartItems.forEach(function(item) {
                var price = parseFloat(item.querySelector('#cart_product_pay').innerText.replace('₹', ''));
                var save = parseFloat(item.querySelector('#cart_product_save').innerText.replace('₹', ''));
                var quantity = parseInt(item.querySelector('.cart_number_display').value);

                total += price * quantity;
                savings += save * quantity;
            });

            document.getElementById('cart_sidebar_total_pay1').innerText = '₹ ' + total;
            document.getElementById('cart_sidebar_total_pay3').innerText = '₹ ' + savings;
        }
    </script>

</head>

<body>
    <div id="mycart">
        <div id="cart_item">
            <p id="cart_item_my_cart">My Cart___________________________________________________________________________________________________________________</p>
            <div id="index">
                <p id="index1">Product</p>
                <p id="index2">You Pay</p>
                <p id="index3">You Save</p>
                <p id="index4">No.of items</p>
                <p id="index5">Remove</p>
            </div>
            <div id="sub_index">
                <p id="sub_index1">(Single Product Price)</p>
                <p id="sub_index2">(Save On Single Product)</p>
                <p id="sub_index3">(Single product)</p>
            </div>
            <?php
            // Check if the cart is set and not empty
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $values) {
            ?>

                    <div id="display_product_cart">
                        <img id="cart_product_img" src="<?php echo $values['product_image']; ?>" alt="">
                        <div id="cart_product_name">
                            <?php echo $values['product_name']; ?>
                            Variant: 1kg
                        </div>
                        <p id="cart_product_pay"> ₹<?php echo $values['product_dmart']; ?></p>
                        <p id="cart_product_save"> ₹<?php echo $values['product_save']; ?></p>
                        <div id="cart_product_no_of_items">
                            <input type="button" id="cart_number_add" value="+" onclick="product_count('add', '<?php echo $key; ?>')" />
                            <input type="text" class="cart_number_display" id="quantity_<?php echo $key; ?>" value="1" readonly />
                            <input type="button" id="cart_number_remove" value="-" onclick="product_count('remove', '<?php echo $key; ?>')" />
                            <input type="hidden" id="hidden_quantity_<?php echo $key; ?>" value="1" /> <!-- Hidden input to store the current quantity -->
                        </div>

                        <!-- Form to handle deleting individual items -->
                        <form method="POST" action="">
                            <input type="hidden" name="product_key" value="<?php echo $key; ?>" />
                            <button type="submit" name="remove_item" style="background: none; border: none;">
                                <img id="cart_product_delete" src="./img/product/delete.jpg" alt="Delete">
                            </button>
                        </form>
                    </div>

                <?php
                    $cart_totel += $values['product_dmart'];
                    $saving += $values['product_save']; 
                }
            } else {
                ?>
                <!-- Message when the cart is empty -->
                <div>
                    <img src="./img/empty_cart.jpg" alt="" style="width: 80px; height: 80px; margin-left: 350px; display: inline; margin-top: 40px;">
                    <h1 style="margin-top: 40px; color: green; display: inline; margin-left: 10px;">Your Cart Is Empty</h1>
                    <h3 style="margin-top: 10px; color: green; margin-left: 490px;">Please Add Some Items</h3>
                </div>
            <?php
            }
            ?>

            <!-- Form to handle the "Remove All" button -->
            <div id="cart_remove_all_items">
                <form method="POST" action="">
                    <?php
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    ?>
                        <button type="submit" name="remove_all" id="cart_remove_all_items_button">
                            <img id="cart_remove_all_items_img" src="./img/delete2.jpg" alt="">
                            <p id="cart_remove_all_items_mesg">Remove All</p>
                        </button>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
        <div id="cart_summary">
            <p id="cart_sidebar_msg">Price Summary</p>
            <p>_______________________________________________</p>
            <div id="cart_sidebar_info">
                <p>Cart Total</p>
                <p id="cart_sidebar_total_pay1">₹ <?php echo $cart_totel; ?></p>
            </div>
            <p>_______________________________________________</p>

            <div id="cart_sidebar_info">
                <p>Delivery Charge</p>
                <p id="cart_sidebar_total_pay2">+ 50</p>
            </div>
            <p>_______________________________________________</p>

            <div id="cart_sidebar_info">
                <p>Savings</p>
                <p id="cart_sidebar_total_pay3">₹ <?php echo $saving; ?></p>
            </div>
            <div id="cart_sidebar_proceed_to_checkout">
                <form method="POST" action="./bill.php">
                    <input type="hidden" name="cart_total" value="<?php echo $cart_totel+50; ?>">
                    <input type="hidden" name="savings" value="<?php echo $saving; ?>">
                    <input type="hidden" name="product_names" value="<?php echo isset($_SESSION['cart']) ? implode(',', array_column($_SESSION['cart'], 'product_name')) : ''; ?>">
                    <button type="submit" id="cart_sidebar_proceed_to_checkout_text" name="Proceed_To_Checkout">Proceed To Checkout</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>