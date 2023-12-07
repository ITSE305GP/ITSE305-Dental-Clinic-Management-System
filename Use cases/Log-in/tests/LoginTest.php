<?php
use PHPUnit\Framework\TestCase;

class LoginUseCaseTest extends TestCase
{
    private $loginUseCase;

    protected function setUp(): void
    {
        $this->loginUseCase = new LoginUseCase();
    }

    public function testCheckCredentialsWithValidCredentials()
    {
        $username = "valid_username";
        $password = "valid_password";

        $result = $this->loginUseCase->checkCredentials($username, $password);

        $this->assertTrue($result);
    }

    public function testCheckCredentialsWithInvalidCredentials()
    {
        $username = "invalid_username";
        $password = "invalid_password";

        $result = $this->loginUseCase->checkCredentials($username, $password);

        $this->assertFalse($result);
    }

    public function testLoginWithValidCredentials()
    {
        $username = "valid_username";
        $password = "valid_password";

        $result = $this->loginUseCase->login($username, $password);

        $this->assertEquals("Login successful!", $result);
    }

    public function testLoginWithInvalidCredentials()
    {
        $username = "invalid_username";
        $password = "invalid_password";

        $result = $this->loginUseCase->login($username, $password);

        $this->assertEquals("Invalid username or password!", $result);
    }
}