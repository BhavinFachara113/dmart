<?php
include("navigationbar.php");
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['ADD_TO_CART'])) {

        // Check if the cart already exists in the session
        if (isset($_SESSION['cart'])) {

            // Check if the product is already in the cart
            $product_found = false;
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['product_name'] == $_POST['product_name']) {
                    // Product exists in cart, update the quantity
                    $_SESSION['cart'][$key]['product_quantity'] += $_POST['product_quantity'];
                    $product_found = true;
                    break;
                }
            }

            // If the product is not in the cart, add it
            if (!$product_found) {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array(
                    "product_name" => $_POST['product_name'],
                    "product_image" => $_POST['product_image'],
                    "product_dmart" => $_POST['product_dmart'],
                    "product_save" => $_POST['product_save'],
                    "product_quantity" => $_POST['product_quantity']
                );
            }

            echo "<script> alert('Product Added to Cart'); window.location.href='index.php'; </script>";
        } else {
            // If no cart exists, create a new cart
            $_SESSION['cart'][0] = array(
                "product_name" => $_POST['product_name'],
                "product_image" => $_POST['product_image'],
                "product_dmart" => $_POST['product_dmart'],
                "product_save" => $_POST['product_save'],
                "product_quantity" => $_POST['product_quantity']
            );
            echo "<script> alert('Product Added to Cart'); window.location.href='index.php'; </script>";
        }
    }
}
?>
