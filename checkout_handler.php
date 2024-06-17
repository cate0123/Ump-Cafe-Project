<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'Not selected';

    if ($paymentMethod == 'Not selected') {
        echo "<h1>Error</h1>";
        echo "<p>You must select a payment method.</p>";
        echo '<a href="checkout.php">Go back to Checkout</a>';
    } elseif ($paymentMethod == 'Pay on Collection') {
        // Directly go to order_number.php
        header("Location: order_number.php");
        exit();
    } else {
        // Proceed to payment details
        $_SESSION['payment_method'] = $paymentMethod;
        header("Location: payment_details.php");
        exit();
    }
} else {
    echo "Invalid request.";
}
?>
