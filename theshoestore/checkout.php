<?php
// checkout.php: Save cart to database
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "Cart is empty.";
        exit;
    }

    $username = $_SESSION['username'] ?? 'guest';

    foreach ($_SESSION['cart'] as $cart_item) {
        $products = [
            1 => ['name' => 'EnduroFlex', 'price' => 4580.00],
            2 => ['name' => 'Trail Running Shoes', 'price' => 9820.00],
            3 => ['name' => 'Swift Striders', 'price' => 7200.00],
            4 => ['name' => 'TrailBlazers', 'price' => 6300.00],
            5 => ['name' => 'PaceMakers', 'price' => 8400.00],
            6 => ['name' => 'Regal Strides', 'price' => 6100.00],
            7 => ['name' => 'Heritage Brogues', 'price' => 4900.00],
            8 => ['name' => 'Prestige Walks', 'price' => 5190.00],
            9 => ['name' => 'Elegance Oxfords', 'price' => 4850.00],
            10 => ['name' => 'Noble Loafers', 'price' => 7860.00],
            11 => ['name' => 'Casual Sneakers ', 'price' => 6500.00],
            12 => ['name' => 'Leather Sneakers ', 'price' => 18000.00],
            13 => ['name' => 'Urban Strollers ', 'price' => 9000.00],
            14 => ['name' => 'StreetEase ', 'price' => 8900.00],
            15 => ['name' => 'LoungeWalks ', 'price' => 9200.00],
        ];

        $product = $products[$cart_item['id']];
        $product_name = $product['name'];
        $quantity = $cart_item['quantity'];
        $price = $product['price'];
        $total_price = $price * $quantity;

        $stmt = $conn->prepare("INSERT INTO cart_items (username, product_name, quantity, price, total_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssidd", $username, $product_name, $quantity, $price, $total_price);

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    }

    unset($_SESSION['cart']);
    header("Location: confirmation.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your purchase!</h1>
    <p>Your order has been placed successfully.</p>
    <a href="index.php">Continue Shopping</a>
</body>
</html>