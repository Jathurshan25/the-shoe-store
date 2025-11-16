<?php
session_start(); // Start the session to access session variables like username
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeStore - Home</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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


        /* ........................................................... */
       
.Slides {display:none;}
.slider{
    background:  linear-gradient(to right, #624A2E, #4F2E1E);
    height:700px;
    
    align-content:center;
}
.slide{
    align-content:center;
}
.slide img{
    max-width:1900px;
    max-height:650px;
}

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 10px;
            background-color: #624A2E;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            /* transition: background-color 0.3s; */
        }
        .btn:hover {
            background-color: #fff;
            
            color: #624A2E;
            border:solid 2px #624A2E;
        }

        /* ................................................. */
        .featured-products {
            padding: 40px;
            text-align: center;
            background-color: #f9f9f9;
            color:#624A2E;
        }
        .featured-products h2 {
            margin-bottom: 20px;
        }
        .product-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .product-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 300px;
            background-color: #fff;
        }
        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .product-item img {
            width: 100%;
            height: 400px;
        }
        .product-item h3 {
            margin: 10px 0;
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
        .newsletter {
            background: linear-gradient(to right, #624A2E, #4F2E1E);
            padding: 40px;
            text-align: center;
            color: #fff;
        }
        .newsletter h2 {
            margin-bottom: 20px;
        }
        .newsletter input[type="email"] {
            padding: 10px;
            width: 300px;
            max-width: 80%;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .newsletter button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: #624A2E;
            cursor: pointer;
        }
        .newsletter button:hover {
            background-color: #624A2E;
            color:#fff;
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

    <section class="slider  ">
   
    <div class="slide" >
  <img class="Slides" src="images/s1.jpg" style="width:100%">
  <img class="Slides" src="images/s2.jpg" style="width:100%">
  <img class="Slides" src="images/s3.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("Slides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000); // Change image every 3 seconds
}
</script>

    </section>

    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <div class="product-item">
                <img src="images/rs.jpg" alt="Shoe 1">
                <h3>Running Shoes</h3>
                <a href="running.php?id=1" class="btn">View Products</a>
            </div>
            <div class="product-item">
                <img src="images/cs.jpg" alt="Shoe 2">
                <h3>Casual Sneakers</h3>
                <a href="casual.php?id=2" class="btn">View Products</a>
            </div>
            <div class="product-item">
                <img src="images/fs.png" alt="Shoe 3">
                <h3>Formal Shoes</h3>
                <a href="formal.php?id=3" class="btn">View Products</a>
            </div>
        </div>
    </section>

    <section class="newsletter">
        <h2>Stay Updated</h2>
        <p>Subscribe to our newsletter for the latest updates and exclusive deals!</p>
        <form>
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 ShoeStore. All rights reserved.</p>
        <p>Follow us on:
            <a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">Twitter</a>
        </p>
    </footer>

    
</body>
</html>
