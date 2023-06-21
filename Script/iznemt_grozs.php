<?php
// iznemt_grozs.php handles removing items from the basket

session_start();

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Check if the product ID exists in the session basket
    if (isset($_SESSION['produkts'][$productId])) {
        // Remove the product from the basket
        unset($_SESSION['produkts'][$productId]);
    }
}
exit;
?>
