<?php
require_once 'Use cases\Sign-up\SignUp.php';
use PHPUnit\Framework\TestCase;

class SignUpTest extends TestCase
{
    public function testFormSubmissionWithInvalidData()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        
        $_POST['username'] = '';

        ob_start();
        include 'signup.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('All fields are required.', $output);
    }

    public function testFormSubmissionWithMismatchedPasswords()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['username'] = 'test';
        $_POST['password'] = 'pass';
        $_POST['confirm_password'] = 'pass1';

        ob_start();
        include 'signup.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Passwords do not match.', $output);
    }

    public function testFormSubmissionWithValidData()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['username'] = 'test';
        $_POST['password'] = 'pass';
        $_POST['confirm_password'] = 'pass';

        ob_start();
        include 'signup.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Sign up successful!', $output);
    }
}