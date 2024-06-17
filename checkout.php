<?php
session_start();

// Assuming totalItems and totalPrice are set in the session by cart.php
$totalItems = isset($_SESSION['totalItems']) ? $_SESSION['totalItems'] : 0;
$totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0.0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <p>Total items: <?php echo $totalItems; ?></p>
        <p>Total price: R<?php echo number_format($totalPrice, 2); ?></p>

        <form action="checkout_handler.php" method="POST">
            <h3>Choose your payment method:</h3>
            <div class="payment-method">
                <input type="radio" id="mastercard" name="payment_method" value="Mastercard" required>
                <label for="mastercard">
                    <img src="images/mastercard.png" alt="Mastercard">
                </label>
            </div>
            <div class="payment-method">
                <input type="radio" id="paypal" name="payment_method" value="Paypal" required>
                <label for="paypal">
                    <img src="images/paypal.png" alt="Paypal">
                </label>
            </div>
            <div class="payment-method">
                <input type="radio" id="applepay" name="payment_method" value="ApplePay" required>
                <label for="applepay">
                    <img src="images/applepay.png" alt="ApplePay">
                </label>
            </div>
            <div class="additional-option">
                <input type="radio" id="pay_on_collection" name="payment_method" value="Pay on Collection" required>
                <label for="pay_on_collection">Pay on Collection Point</label>
            </div>

            <button type="submit">Proceed</button>
        </form>
    </div>
</body>
</html>
