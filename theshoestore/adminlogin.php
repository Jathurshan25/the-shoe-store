<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit();
}

if (isset($_POST["login"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    require_once "database.php";  // Your database connection file
    
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE name = ? AND password = ?");
    $stmt->bind_param("ss", $name, $password);  // Bind the plaintext password
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin) {
        // Start session and store user information
        $_SESSION["admin"] = $admin["name"];// Store username in session
        header("Location: admin.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Invalid username or password</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  
    <style>
body{
    padding:50px;
        background-image: url("images/bg.jpg");
        /* background-position: center; */
  background-repeat: no-repeat;
  background-size: cover;
        background-color: #cccccc;
       
}

.container{
    margin-left:150px;
    text-align:center;
    margin-top:400px;
    max-width: 600px;
    /* margin:0 auto; */
    padding:50px;
    background-color: rgba(250, 250, 252, 0.74);
}
.form-group{
    margin-bottom:30px;
}

        </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="adminlogin.php" method="post">
            <div class="form-group">
                <input type="text" placeholder="Enter Username" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div><p>Are you Customer? <a href="login.php">Login Here</a></p></div>
    </div>
</body>
</html>
