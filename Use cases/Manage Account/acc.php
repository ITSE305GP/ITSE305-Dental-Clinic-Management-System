<?php

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to register a new user
function registerUser($username, $password) {
    global $conn;
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to authenticate a user
function loginUser($username, $password) {
    global $conn;

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            return true;
        }
    }

    return false;
}

// Function to log out a user (in a real-world scenario, you might destroy the session)
function logoutUser() {
    // Implement logout functionality here
}

// Example usage:

// Register a new user
$username = "john_doe";
$password = "secure_password";

if (registerUser($username, $password)) {
    echo "User registered successfully.<br>";
} else {
    echo "Error registering user.<br>";
}

// Login a user
if (loginUser($username, $password)) {
    echo "User logged in successfully.<br>";
} else {
    echo "Invalid username or password.<br>";
}

// Logout a user
logoutUser();

// Close the database connection
$conn->close();

?>

