<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php";  // Your database connection file
    
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($password, $user["password"])) {
            // Start session and store user information
            $_SESSION["user"] = "yes";
            $_SESSION["username"] = $user["full_name"];  // Store username in session
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
        <h1>Customer Login</h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div><p>Not registered yet? <a href="registration.php">Register Here</a></p></div>
        <div><p>Are you Admin? <a href="adminlogin.php">Login Here</a></p></div>
    </div>
</body>
</html>
