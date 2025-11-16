<?php
session_start();

// Define products in an array
$running_shoes = [
    ['id' => 1, 'name' => 'EnduroFlex', 'price' => 4580.00, 'image' => 'r2.jpg'],
    ['id' => 2, 'name' => 'Trail Running Shoes', 'price' => 9820.00, 'image' => 'r1.jpeg'],
    ['id' => 3, 'name' => 'Swift Striders', 'price' => 7200.00, 'image' => 'r3.jpg'],
    ['id' => 4, 'name' => 'TrailBlazers', 'price' => 6300.00, 'image' => 'r4.jpg'],
    ['id' => 5, 'name' => 'PaceMakers', 'price' => 8400.00, 'image' => 'r5.jpg'],
    // You can add more products here
];

// Handle Add to Cart action
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the cart exists, if not create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product already exists in the cart
    $product_exists = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $product_id) {
            $cart_item['quantity'] += $quantity;
            $product_exists = true;
            break;
        }
    }

    // If the product doesn't exist, add it to the cart
    if (!$product_exists) {
        $_SESSION['cart'][] = ['id' => $product_id, 'quantity' => $quantity];
    }

    // Set a session variable to display a success message
    $_SESSION['cart_message'] = "Product added to cart!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running Shoes - ShoeStore</title>
    <link rel="stylesheet" href="styles.css">
    <style>
           body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            position: sticky;
            top: 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .logo h1 {
            margin: 0;
            color:  linear-gradient(to right, #624A2E, #4F2E1E);;
        }
        nav ul {
            list-style: none;
            display: flex;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .container nav ul {
            list-style: none;
            /* border:solid 2px black; */
            width:fit-content;
            height:30px;
            align-items:center;
            display: flex;
            padding: 0;
            margin: 0;
        }
        .container nav ul li {
            text-align:center;
            width:auto;
            
            /* border:solid 2px black; */
        }
      
        .container nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .container {
            width: 80%;
            margin:  auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin: 30px 0;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom:50px;
        }
        .product-item {
            width: 400px;
            height:400px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-right:40px;
            margin-bottom: 50px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .product-item img {
            width: 100%;
            height: 250px;
            border-bottom: 1px solid #ddd;
        }
        .product-item h3 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .product-item p {
            font-size: 1.1em;
            color: #624A2E;
        }
        .product-item form {
            margin-top: 10px;
        }
        .product-item input {
            padding: 5px 10px;
            font-size: 1em;
            margin-right: 10px;
            width: 50px;
            text-align: center;
        }
        .product-item button {
            padding: 10px 20px;
            background-color: #624A2E;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .product-item button:hover {
            background-color: #555;
        }
        footer {
          
            background-color: #624A2E;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        footer p {
            margin: 5px 0;
        }
        footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 5px;
        }
        footer a:hover {
            text-decoration: underline;
        }
        /* Success message style */
        .success-message {
            background-color: #28a745;
            color: white;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="logo">
            <h1>theShoeStore</h1>
        </div>
        <nav>
        <ul>
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php">Cart</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
        </nav>
    </header>

    <!-- Running Shoes Page Content -->
    <div class="container">
    <nav>
        <ul>
            <li><a href="running.php">Runnig Shoes</a></li>
            <li><a href="formal.php">Formal Shoes</a></li>
            <li><a href="casual.php">Casual Shoes</a></li>
          
        </ul>
        </nav>
        <h1>Running Shoes</h1>

        <!-- Success Message -->
        <?php if (isset($_SESSION['cart_message'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['cart_message']; ?>
            </div>
            <?php unset($_SESSION['cart_message']); ?>
        <?php endif; ?>

        <div class="product-grid">
            <?php foreach ($running_shoes as $product): ?>
                <div class="product-item">
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Rs.<?php echo number_format($product['price'], 2); ?></p>
                    <form method="POST" action="running.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" value="1" min="1" required>
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 ShoeStore. All rights reserved.</p>
        <p>Follow us on:
            <a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">Twitter</a>
        </p>
    </footer>
</body>
</html>
