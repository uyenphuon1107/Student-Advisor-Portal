<?php
// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hw7';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Function to handle login
function handleLogin($email, $password) {
    global $conn;

    $sql = "SELECT * FROM credentials WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $row['password'])) {

            session_start();

            // Store user information
            $_SESSION['user_id'] = $row['student_id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];

            // Redirect to the main page
            header("Location: index.php");
            exit();
        } else {

            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Redirect to the login page with an error message 
        header("Location: login.php?error=1");
        exit();
    }
}


// Function to handle signup
function handleSignup($name, $id, $email, $password) {
    global $conn;

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM credentials WHERE email = ?";
    $checkStmt = $conn->prepare($checkEmailQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo " email already exists";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new credentials into the database
    $sql = "INSERT INTO credentials (name, student_id, email, password) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $id, $email, $hashedPassword);
    $stmt->execute();

    // Redirect to the main page after successful signup
    header("Location: index.php");
    exit();
}

function handleSearch($studentID) {
    global $conn;

    $sql = "SELECT name, telephone_number FROM advisors WHERE ? BETWEEN lower_bound_id AND upper_bound_id";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;  // Return advisor information
    } else {
        return false; // Return false if no advisor found
    }
}


?>
