<?php

// Import the necessary classes
require_once 'Use cases/DbConnection.php';


// Define the Login class
class Login
{

    private $dbConnection;

    // Constructor to initialize the Login class with a DbConnection object
    public function __construct(DbConnection $dbConnection)
    {

        $this->dbConnection = $dbConnection;

    }


    // Method to check the validity of credentials
    public function checkCredentials($username, $password)
    {

        $conn = $this->dbConnection->getConnection();


        // Perform the necessary logic to check the credentials using the database connection
        // For simplicity, this example always returns false for invalid credentials
        return ($username === 'validUser' && $password === 'validPassword');

    }

    // Method to perform the login action
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

// End of file