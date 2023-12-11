<?php
require_once 'Use cases/DbConnection.php';
class SignUp
{
    public function registerUser($username, $password, $email)
    {
        // Validate input data
        $username = $this->sanitizeInput($username);
        $password = $this->hashPassword($password);
        $email = $this->sanitizeInput($email);

        // Perform database operations to store user data
        // Example: Insert user data into the database

        // Return success message or error
        return "User registration successful!";
    }

    private function sanitizeInput($input)
    {
        // Sanitize and validate input data
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    private function hashPassword($password)
    {
        // Hash the password for secure storage
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

// Example usage
$signUp = new SignUp();
$username = "john123";
$password = "password123";
$email = "john@example.com";
$result = $signUp->registerUser($username, $password, $email);
echo $result;
?>