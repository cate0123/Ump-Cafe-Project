<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentMethod = $_POST['payment_method'];
    $cardHolder = $_POST['card_holder'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Normally, you would process the payment here.
    // For demonstration, we will just proceed to the order number page.

    // Generate a mock order number
    $orderNumber = rand(100000, 999999);
    $_SESSION['orderNumber'] = $orderNumber;

    header("Location: order_number.php");
    exit();
} else {
    echo "Invalid request.";
}

