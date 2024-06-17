<?php
session_start();

$totalItems = isset($_SESSION['totalItems']) ? $_SESSION['totalItems'] : 0;
$totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0.0;
$paymentMethod = isset($_SESSION['payment_method']) ? $_SESSION['payment_method'] : 'Not selected';

if ($paymentMethod == 'Not selected') {
    echo "<h1>Error</h1>";
    echo "<p>You must select a payment method.</p>";
    echo '<a href="checkout.php">Go back to Checkout</a>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="payment-details-container">
        <h1>Payment Details</h1>
        <p>Payment Method: <?php echo $paymentMethod; ?></p>
        <p>Total price: R<?php echo number_format($totalPrice, 2); ?></p>
        <form method="POST" action="process_payment.php">
            <input type="hidden" name="payment_method" value="<?php echo $paymentMethod; ?>">
            <label for="card_holder">Card Holder:</label><br>
            <input type="text" id="card_holder" name="card_holder" required><br>
            <label for="card_number">Card Number:</label><br>
            <input type="text" id="card_number" name="card_number" required><br>
            <label for="expiry_date">Expiry Date:</label><br>
            <input type="text" id="expiry_date" name="expiry_date" required><br>
            <label for="cvv">CVV:</label><br>
            <input type="text" id="cvv" name="cvv" required><br><br>
            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>
