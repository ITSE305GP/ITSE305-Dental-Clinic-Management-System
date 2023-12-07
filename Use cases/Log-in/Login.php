<?php
class LoginUseCase
{
    private $servername = "localhost";
    private $dbUsername = "your_username";
    private $dbPassword = "your_password";
    private $dbName = "pr";
    private $conn;

    // Constructor to establish database connection
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->dbUsername, $this->dbPassword, $this->dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to check if the provided credentials are valid
    public function checkCredentials($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true; // Credentials are valid
        } else {
            return false; // Credentials are invalid
        }
    }

    // Method to handle the login process
    public function login($username, $password)
    {
        $isValid = $this->checkCredentials($username, $password);

        if ($isValid) {
            return "Login successful!";
            // Perform any additional actions or redirect the user to another page
        } else {
            return "Invalid username or password!";
        }
    }
}

// Example usage:
$loginUseCase = new LoginUseCase();
$username = $_POST["username"];
$password = $_POST["password"];
$result = $loginUseCase->login($username, $password);
echo $result;
?>