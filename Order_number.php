<?php
session_start();

$orderNumber = isset($_SESSION['orderNumber']) ? $_SESSION['orderNumber'] : 'Unknown';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Number</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="order-number-container">
        <h1>Thank You for Your Order!</h1>
        <p>Your order number is: <?php echo $orderNumber; ?></p>
    </div>
</body>
</html>

