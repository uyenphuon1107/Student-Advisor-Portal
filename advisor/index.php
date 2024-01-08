<?php
session_start();

include_once('database.php');

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}
// Logout
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();
    // Destroy the session 
    session_destroy();
    // Redirect to home page
    header("Location: login.php");
    exit;
}

// Advisor 
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['student_id'])) {
    $student_id = htmlentities($_POST['student_id']);

        // lookup advisor 
        $advisor = handleSearch($studentID);

        if (empty($advisor)) {
            echo "Advisor not found.";
        } else {
            $name = $advisor['name'];
            $phone = $advisor['telephone_number'];
            echo "<br>Your advisor is: $name <br> Email: $email <br> Phone: $phone <br>";
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title> 
    <script src="validate.js"></script>
</head>
<body>
    <h1>Main Page</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="student_name" placeholder="Student Name">
        <br>
        <br>
        <input type="number" name="student_id" placeholder="Student ID">
        <br>
        <br>
        <input type="submit" value="Search">
    </form>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="logout" hidden>
        <input type="submit" value="Logout">
    </form>

</body>
</html>
