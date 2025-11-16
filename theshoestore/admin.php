<?php
session_start();
include('database.php'); // Include your database connection file

// Handle Create, Update, Delete for Users

// User Creation
if (isset($_POST['create_user'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
    if ($conn->query($sql)) {
        echo "<p>User created successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// User Update
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    // Check if the password field is filled
    $password = isset($_POST['password']) && !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Update query: if a new password is provided, update it as well
    if ($password) {
        $sql = "UPDATE users SET full_name='$full_name', email='$email', password='$password' WHERE id='$user_id'";
    } else {
        $sql = "UPDATE users SET full_name='$full_name', email='$email' WHERE id='$user_id'";
    }

    if ($conn->query($sql)) {
        echo "<p>User updated successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// User Deletion
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];

    $sql = "DELETE FROM users WHERE id='$user_id'";
    if ($conn->query($sql)) {
        echo "<p>User deleted successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Cart Item Deletion
if (isset($_GET['delete_cart_item'])) {
    $cart_item_id = $_GET['delete_cart_item'];

    $sql = "DELETE FROM cart_items WHERE id='$cart_item_id'";
    if ($conn->query($sql)) {
        echo "<p>Cart item deleted successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Fetch users from the database
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);

// Fetch cart items from the database
$sql_cart_items = "SELECT ci.*, u.full_name, u.email FROM cart_items ci LEFT JOIN users u ON ci.username = u.email";
$result_cart_items = $conn->query($sql_cart_items);

// Check if we are editing a user
if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];
    $sql_edit_user = "SELECT * FROM users WHERE id='$user_id'";
    $result_edit_user = $conn->query($sql_edit_user);
    $user_to_edit = $result_edit_user->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ShoeStore</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
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

        .container {
            padding: 40px;
            max-width: 1200px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 40px;
        }

        h1, h2 {
            color: #624A2E;
            text-align: center;
        }

        .table-container {
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #624A2E;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        .button {
            padding: 10px 20px;
            background-color: #624A2E;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #624A2E;
        }

        

        input[type="text"], input[type="email"], input[type="password"], button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        form {
            margin-bottom: 40px;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h3 {
            text-align: center;
            color: #333;
        }

        footer {
            background-color: #fff;
             /* linear-gradient(to right, #624A2E, #4F2E1E);; */
            color: #4F2E1E;
            text-align: center;
            padding: 20px 0;
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
       
              
                <?php if (isset($_SESSION['admin'])): ?>
                    <li><span>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?></span></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else:echo "You are not logged in."; ?>
                    <li><a href="logout.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
<div class="container">
    <h1>Admin Dashboard</h1>

    <!-- User Management -->
    <div class="table-container">
        <h2>User Details</h2>
        
        <!-- Display Edit User Form if editing -->
        <?php if (isset($user_to_edit)): ?>
            <div class="form-container">
                <h3>Edit User</h3>
                <form action="" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $user_to_edit['id']; ?>">
                    <input type="text" name="full_name" value="<?php echo $user_to_edit['full_name']; ?>" placeholder="Full Name" required>
                    <input type="email" name="email" value="<?php echo $user_to_edit['email']; ?>" placeholder="Email" required>
                    <input type="password" name="password" placeholder="New Password (Leave empty if not changing)">
                    <button type="submit" name="update_user" class="button">Update User</button>
                </form>
            </div>
        <?php else: ?>
            <div class="form-container">
                <h3>Create New User</h3>
                <form action="" method="POST">
                    <input type="text" name="full_name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="create_user" class="button">Create User</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- User List -->
        <table>
            <thead>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($result_users->num_rows > 0): ?>
                <?php while ($user = $result_users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <a href="admin.php?edit_user=<?php echo $user['id']; ?>" class="button">Edit</a> 
                            <a href="admin.php?delete_user=<?php echo $user['id']; ?>" class="button">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No users found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Cart Items Management -->
    <div class="table-container">
        <h2>Cart Items</h2>

        <table>
            <thead>
            <tr>
                <th>Cart Item ID</th>
                <th>User Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Added At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($result_cart_items->num_rows > 0): ?>
                <?php while ($cart_item = $result_cart_items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $cart_item['id']; ?></td>
                        <td><?php echo htmlspecialchars($cart_item['username']); ?></td>
                        <td><?php echo htmlspecialchars($cart_item['product_name']); ?></td>
                        <td><?php echo $cart_item['quantity']; ?></td>
                        <td>Rs.<?php echo number_format($cart_item['price'], 2); ?></td>
                        <td>Rs.<?php echo number_format($cart_item['total_price'], 2); ?></td>
                        <td><?php echo $cart_item['added_at']; ?></td>
                        <td>
                            <a href="admin.php?delete_cart_item=<?php echo $cart_item['id']; ?>" class="button">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No cart items found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
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
