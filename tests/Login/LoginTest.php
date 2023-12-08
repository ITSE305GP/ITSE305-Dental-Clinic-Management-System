<?php


require_once "Use cases/Log-in/Login.php";

use PHPUnit\Framework\TestCase;



class LoginTest extends TestCase
{
    private $login;
    private $dbConnection;

    protected function setUp(): void
    {
        $this->dbConnection = new DbConnection();

        $this->login = new Login($this->dbConnection);
    }

    public function testCheckCredentialsValid()
    {
        $this->assertTrue(
            $this->login->checkCredentials('validUser', 'validPassword')
        );
    }

    public function testCheckCredentialsInvalid()
    {
        $this->assertFalse(
            $this->login->checkCredentials('invalidUser', 'invalidPassword')
        );
    }

    public function testLoginValid()
    {
        $this->assertEquals(
            "Login successful!",
            $this->login->login('validUser', 'validPassword')
        );
    }

    public function testLoginInvalid()
    {
        $this->assertEquals(
            "Invalid username or password!",
            $this->login->login('invalidUser', 'invalidPassword')
        );
    }
}