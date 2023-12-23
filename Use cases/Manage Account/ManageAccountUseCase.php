<?php
require_once '../DbConnection.php';


class ManageAccount
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function changePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error changing password: " . $e->getMessage();
            return false;
        }
    }

    public function deleteAccount($userId)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();


            return true;
        } catch (PDOException $e) {
            echo "Error deleting account: " . $e->getMessage();
            return false;
        }
    }
}
$dbConnection = new DbConnection();
$conn = $dbConnection->getConnection();


// Assuming you have a logged-in user with their ID stored in a session variable
$loggedInUserId = isset($_SESSION['user_id']); // Replace with your session variable

$manageAccount = new ManageAccount($conn);

// Example: Change password
$newPassword = "new_secure_password";
if ($manageAccount->changePassword($loggedInUserId, $newPassword)) {
    echo "Password changed successfully.<br>";
} else {
    echo "Error changing password.<br>";
}

// Example: Delete account
if ($manageAccount->deleteAccount($loggedInUserId)) {
    echo "Account deleted successfully.<br>";
} else {
    echo "Error deleting account.<br>";
}

// Close the database connection
$conn = null;
$dbConnection->closeConnection();
?>
