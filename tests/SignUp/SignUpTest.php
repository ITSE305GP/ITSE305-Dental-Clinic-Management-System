<?php

require_once 'Use cases/Sign-up/SignUp.php';

use PHPUnit\Framework\TestCase;

class SignUpTest extends TestCase
{
    public function testRegisterUser()
    {
        // Create an instance of the SignUp class
        $signUp = new SignUp();

        // Test input values
        $username = 'john123';
        $password = 'password123';
        $email = 'john@example.com';

        // Call the registerUser method
        $result = $signUp->registerUser($username, $password, $email);

        // Assert that the result is the expected success message
        $this->assertEquals('User registration successful!', $result);
    }

    public function testSanitizeInput()
    {
        // Create an instance of the SignUp class
        $signUp = new SignUp();

        // Use reflection to access the private method
        $sanitizeInputMethod = new \ReflectionMethod(SignUp::class, 'sanitizeInput');
        $sanitizeInputMethod->setAccessible(true);

        // Test input value
        $input = '  input value  ';

        // Call the sanitizedInput method using reflection
        $result = $sanitizeInputMethod->invoke($signUp, $input);

        // Assert that the result is the sanitized input value
        $this->assertEquals('input value', $result);
    }
    public function testHashPassword()
    {
        // Create an instance of the SignUp class
        $signUp = new SignUp();

        // Use reflection to access the private method
        $hashPasswordMethod = new \ReflectionMethod(SignUp::class, 'hashPassword');
        $hashPasswordMethod->setAccessible(true);

        // Test input value
        $password = 'password123';

        // Call the hashPassword method using reflection
        $result = $hashPasswordMethod->invoke($signUp, $password);

        // Assert that the result is a hashed password
        $this->assertNotNull($result);
        $this->assertTrue(password_verify($password, $result));
    }
}
