<?php
session_start(); // Start the session to access session variables like username
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
          content="width=device-width, initial-scale=1.0">
  
    <title>Contact us Page</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
/* Header styles */
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

/* banner section styles */
.banner {
    text-align: center;
    background-color: #ffffff;
    margin: 0 auto;
}

/* Contact form styles */
.contact-form {
    padding: 40px 0;
    margin: 0 10px;
}

.form-container {
    max-width: 40%;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.contact-form h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-container label {
    display:block;
    font-weight: bold;
}
.form-container input, textarea{
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 1rem;
    resize: vertical;
}
.submit-button {
    padding: 10px 20px;
    background-color: #0dac30;
    border: none;
    color: white;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
}


footer {
            background-color: #fff;
            color: #4F2E1E;
            text-align: center;
            padding: 20px 0;
            position:fixed;
            width:100%;
            bottom:0;
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
    <!-- Header section -->
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
    <!-- banner section  -->
    <section class="banner">
        <h1>Get in Touch With Us</h1>
        <p>
          We're here to answer any questions you may have.
          </p>
    </section>

    <!-- Contact form -->
    <section class="contact-form">
        <div class="form-container">
            <h2>Your Details</h2>
            <form action="#" method="POST">

                <label for="name">Name: </label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email: </label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone: </label>
                <input type="tel" id="phone" name="phone">

                <label for="message">Message: </label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    </section>

  

    <!-- Footer section -->
    <footer>
        <p>&copy; 2025 ShoeStore. All rights reserved.</p>
        <p>Follow us on:
            <a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">Twitter</a>
        </p>
    </footer>
</body>

</html>