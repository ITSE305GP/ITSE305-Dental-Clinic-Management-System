<?php
use PHPUnit\Framework\TestCase;
require_once "Use cases\Manage Account\ManageAccountUseCase.php";

class ManageAccountUseCaseTest extends TestCase
{
    private $pdo;
    private $manageAccount;

    public function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec('
            CREATE TABLE users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            )
        ');

        $this->manageAccount = new ManageAccount($this->pdo);
    }

    public function testChangePassword()
    {
        $userId = $this->createUser('john_doe', 'old_password');

        $newPassword = 'new_secure_password';
        $this->assertTrue($this->manageAccount->changePassword($userId, $newPassword));

        $stmt = $this->pdo->query('SELECT password FROM users WHERE id = ' . $userId);
        $hashedPassword = $stmt->fetchColumn();

        $this->assertTrue(password_verify($newPassword, $hashedPassword));
    }

    public function testDeleteAccount()
    {
        $userId = $this->createUser('john_doe', 'password_to_delete');

        $this->assertTrue($this->manageAccount->deleteAccount($userId));

        $stmt = $this->pdo->query('SELECT COUNT(*) FROM users WHERE id = ' . $userId);
        $count = $stmt->fetchColumn();

        $this->assertEquals(0, $count);
    }

    private function createUser($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $hashedPassword]);

        return $this->pdo->lastInsertId();
    }
}
