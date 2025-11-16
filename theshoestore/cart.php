<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// cart.php: Cart page
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
    exit;
}

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - ShoeStore</title>

    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { padding: 20px; }
        h1, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td {
             border: 1px solid #ddd; 
            }
        th, td { 
            padding: 10px; 
            text-align: center;
         }
        button { 
            background-color: #624A2E; 
            color: white;
             padding: 10px 20px; 
             border-radius: 10px; 
             cursor: pointer;
             }
        button:hover { 
            background-color: #555; 
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
        footer {
            background-color: #fff;
            border-top:solid 2px #624A2E;
             /* linear-gradient(to right, #624A2E, #4F2E1E);; */
            color: #4F2E1E;
            text-align: center;
            padding: 20px 0;
            bottom:0;
            width:100%;
            position: fixed;
        }
        footer p {
            margin: 5px 0;
        }
        footer a {
            color: #624A2E;
            text-decoration: none;
            margin: 0 5px;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
        <div class="logo">
            <h1>theShoeStore</h1>
        </div>
        <nav>
        <ul>
       
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                
                <li><a href="cart.php">cart</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else:echo "You are not logged in."; ?>
                    <li><a href="logout.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

<div class="container">
    <h1>Your Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                <?php
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
                    $item_total = $product['price'] * $cart_item['quantity'];
                    $total_price += $item_total;
                ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $cart_item['quantity']; ?></td>
                    <td>Rs.<?php echo number_format($product['price'], 2); ?></td>
                    <td>Rs.<?php echo number_format($item_total, 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total Price: Rs.<?php echo number_format($total_price, 2); ?></h3>

    <form action="checkout.php" method="POST">
        <button type="submit">Proceed to Checkout</button>
    </form>
</div>

<footer>
        <p>&copy; 2025 ShoeStore. All rights reserved.</p>
        <p>Follow us on:
            <a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">Twitter</a>
        </p>
    </footer>

</body>
</html>