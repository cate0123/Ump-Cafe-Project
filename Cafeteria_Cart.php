<?php
session_start();

$foodItems = [
    1 => ['name' => 'Budget plate english breakfast', 'price' => 45.00, 'image' => 'budget_plate_english_breakfast.jpg'],
    2 => ['name' => 'Budget plate rice and stew', 'price' => 45.00, 'image' => 'budget_plate_rice_and_stew.jpg'],
    3 => ['name' => 'Sandwich chicken', 'price' => 45.00, 'image' => 'sandwich_chicken.jpg'],
    4 => ['name' => 'Coca-cola', 'price' => 25.00, 'image' => 'coca_cola.jpg'],
    5 => ['name' => 'Orange Juice', 'price' => 20.00, 'image' => 'orange_juice.jpg'],
    6 => ['name' => 'Lays', 'price' => 20.00, 'image' => 'lays.jpg'],
    7 => ['name' => 'Doritos', 'price' => 20.00, 'image' => 'doritos.jpg'],
    8 => ['name' => 'Standard plate english breakfast', 'price' => 55.00, 'image' => 'standard_plate_english_breakfast.jpg'],
    9 => ['name' => 'Standard plate rice and stew', 'price' => 55.00, 'image' => 'standard_plate_rice_and_stew.jpg'],
    10 => ['name' => 'Cookies', 'price' => 45.00, 'image' => 'cookies.jpg'],
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $id = $_POST['add_to_cart'];
        if (isset($foodItems[$id])) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$id] = $foodItems[$id];
                $_SESSION['cart'][$id]['quantity'] = 1;
            }
        }
    }

    if (isset($_POST['remove'])) {
        $id = $_POST['remove'];
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }
}

// Calculating total items and total price
$totalItems = 0;
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
    $totalPrice += $item['quantity'] * $item['price'];
}

// Set total items and total price in session
$_SESSION['totalItems'] = $totalItems;
$_SESSION['totalPrice'] = $totalPrice;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu and Cart</title>
    <style>
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            justify-items: center;
            margin: 20px;
        }
        .menu-item, .cart-item {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .menu-item img, .cart-item img {
            width: 100px;
            height: 100px;
        }
        .menu-item button, .cart-item button {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 10px;
        }
        .cart-item .remove-btn {
            background-color: red;
        }
        .cart-summary {
            text-align: center;
            margin-top: 20px;
        }
        .proceed-btn {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<h1>Food Menu</h1>
<div class="menu">
    <?php foreach ($foodItems as $id => $item): ?>
        <div class="menu-item">
            <img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
            <p><?php echo $item['name']; ?></p>
            <p>R<?php echo number_format($item['price'], 2); ?></p>
            <form method="post">
                <button type="submit" name="add_to_cart" value="<?php echo $id; ?>">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<h1>My Cart</h1>
<?php if (!empty($_SESSION['cart'])): ?>
    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <div class="cart-item">
            <img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
            <div class="info">
                <p><?php echo $item['name']; ?> - R<?php echo number_format($item['price'], 2); ?> x <?php echo $item['quantity']; ?></p>
                <p>Total: R<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
            </div>
            <form method="post">
                <button class="remove-btn" type="submit" name="remove" value="<?php echo $id; ?>">Remove</button>
            </form>
        </div>
    <?php endforeach; ?>
    <div class="cart-summary">
        <p>Total Items: <?php echo $totalItems; ?></p>
        <p>Total Price: R<?php echo number_format($totalPrice, 2); ?></p>
    </div>
    <form method="post" action="checkout.php">
        <button class="proceed-btn" type="submit">Proceed to Payment</button>
    </form>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

</body>
</html>
