<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once('database.php');

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
$errorMsg = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Check if email and password are not empty
        if (!empty($email) && !empty($password)) {
            handleLogin($email, $password);
        } else {
            // Handle invalid
            $errorMsg = "Error";
        }
    }
    
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $id = $_POST['id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Check if name, id, email, and password are not empty
        if (!empty($name) && !empty($id) && !empty($email) && !empty($password)) {
            handleSignup($name, $id, $email, $password);
        } else {
            // Handle invalid input
            $errorMsg = "Error";
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup Page</title>
    <script src="validate.js"></script> 
</head>
<body>
    <h1>Login/Signup Page</h1>

   
    <?php if (!empty($errorMsg)): ?>
        <p class="error"><?php echo $errorMsg; ?></p>
    <?php endif; ?>

    <h2>Login</h2>
    <form method="post" action="">
        <label for="login_email">Email:</label>
        <input type="email" id="login_email" name="email" required><br>

        <label for="login_password">Password:</label>
        <input type="password" id="login_password" name="password" required><br>

        <button type="submit" name="login">Login</button>
    </form>

    <h2>Signup</h2>
    <form method="post" action="">
        <label for="signup_name">Name:</label>
        <input type="text" id="signup_name" name="name" required><br>

        <label for="signup_id">Student ID:</label>
        <input type="text" id="signup_id" name="id" required><br>

        <label for="signup_email">Email:</label>
        <input type="email" id="signup_email" name="email" required><br>

        <label for="signup_password">Password:</label>
        <input type="password" id="signup_password" name="password" required><br>

        <button type="submit" name="signup">Signup</button>
    </form>
</body>
</html>
